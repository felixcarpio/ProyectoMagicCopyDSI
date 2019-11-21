<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Promocion;
use App\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = DB::table('promociones')
            ->select('promociones.id', 'promociones.nombre', 'promociones.fecha_inicio', 'promociones.fecha_fin', 'promociones.precio_con_descuento')->get();

        return view('promociones.promocion', compact('promociones'));
    }

    public function ingresar()
    {
        $productos = Producto::all();

        return view('promociones.ingresar', compact('productos'));
    }

    public function validarFechaFin($fechaInicio, $fechaFin)
    {
        $fechaMenor = False;

        $stringFechaInicio = explode("/", $fechaInicio);
        $diaFechaInicio = (int) $stringFechaInicio[0];
        $mesFechaInicio = (int) $stringFechaInicio[1];
        $anioFechaInicio = (int) $stringFechaInicio[2];

        $stringFechaFin = explode("/", $fechaFin);
        $diaFechaFin = (int) $stringFechaFin[0];
        $mesFechaFin = (int) $stringFechaFin[1];
        $anioFechaFin = (int) $stringFechaFin[2];

        $nuevaFechaInicio = Carbon::create($anioFechaInicio, $mesFechaInicio, $diaFechaInicio, 0, 0, 0);

        $nuevaFechaFin = Carbon::create($anioFechaFin, $mesFechaFin, $diaFechaFin, 0, 0, 0);

        if ($nuevaFechaFin->greaterThan($nuevaFechaInicio) || $nuevaFechaFin == $nuevaFechaInicio) {
            $fechaMenor = True;
        }

        return $fechaMenor;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required | unique:promociones',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);

        $promocion = new Promocion;

        $fechaMenor = self::validarFechaFin($request->fecha_inicio, $request->fecha_fin);
        if (!$fechaMenor) {
            return redirect('/promo/ingresar')->with('error', 'La fecha de fin debe ser mayor a la fecha de inicio');
        }

        //Manejo de imagenes
        if ($request->hasFile('imagen')) {
            // Obtiene el nombre de la imagen junto a su extension
            $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
            // Obtiene el nombre de la imagen (sin su extension)
            $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
            // Obtiene solo la extension de la imagen
            $extension = $request->file('imagen')->getClientOriginalExtension();
            // Nombre con el que se guardara la imagen: nombreImagen+Fecha+.extension
            $nombreDeArchivoAlmacenar = $nombreDeArchivo . '_' . time() . '.' . $extension; //concatenates with timestamp
            // Subida de la imagen
            $path = $request->file('imagen')->move(public_path() . '/images/promociones/', $nombreDeArchivoAlmacenar);   // public/storage  storage/app/public
        } else {
            $nombreDeArchivoAlmacenar = 'noimage.jpg';
        }

        $promocion->nombre = $request->input(('nombre'));
        $promocion->fecha_inicio = $request->input(('fecha_inicio'));
        $promocion->fecha_fin = $request->input(('fecha_fin'));
        $promocion->precio_con_descuento = $request->input('precio_con_descuento');
        $promocion->imagen = $nombreDeArchivoAlmacenar;
        $promocion->save();

        foreach ($request->producto as $iteracion => $v) {
            $datos = array(
                $request->producto[$iteracion] => [
                    'cantidad' => $request->cantidad[$iteracion],
                    'precio_unitario' => $request->precio_unitario[$iteracion],
                ]
            );
            $promocion->productos()->attach($datos);
        }

        $preciosOriginales = DB::table('productos')
            ->join('producto_promocion', 'productos.id', 'producto_promocion.producto_id')
            ->join('promociones', 'promociones.id', 'producto_promocion.promocion_id')
            ->select('producto_promocion.producto_id', 'productos.precio', 'producto_promocion.cantidad')
            ->groupBy('producto_promocion.producto_id', 'productos.precio', 'producto_promocion.cantidad')
            ->where('promociones.nombre', $request->nombre)
            ->get();

        $precioOriginal = 0;
        for ($i = 0; $i < sizeof($preciosOriginales); $i++) {
            $precio = floatval($preciosOriginales[$i]->precio);
            $cantidad = floatval($preciosOriginales[$i]->cantidad);
            $precioOriginal += $precio * $cantidad;
        }

        $promocion->precio_sin_descuento = $precioOriginal;
        $promocion->save();

        return redirect('/promo/ingresar')->with('success', 'La Promocion se guardó exitosamente');
    }

    public function show($id)
    {
        $productos = DB::table('promociones')
            ->join('producto_promocion', 'promociones.id', 'producto_promocion.promocion_id')
            ->join('productos', 'productos.id', 'producto_promocion.producto_id')
            ->select('productos.nombre', 'producto_promocion.cantidad')
            ->where('producto_promocion.promocion_id', $id)
            ->groupBy('productos.nombre', 'producto_promocion.cantidad')
            ->get()->toArray();

        $promocion = Promocion::find($id);

        return view('promociones.ver', compact('promocion', 'productos'));
    }

    public function actualizar($id)
    {
        $productos = Producto::all();

        $promo = Promocion::find($id);

        $productosPromocion = DB::table('productos')
            ->join('producto_promocion', 'productos.id', 'producto_promocion.producto_id')
            ->where('producto_promocion.promocion_id', $id)
            ->get();

        $promocion = DB::table('promociones')
            ->join('producto_promocion', 'promociones.id', 'producto_promocion.promocion_id')
            ->where('promociones.id', $id)
            ->get();

        return view('promociones.actualizar', compact('productosPromocion', 'promocion', 'productos', 'promo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);

        $promocion = Promocion::find($id);

        if ($request->hasFile('imagen')) {
            $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
            $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreDeArchivoAlmacenar = $nombreDeArchivo . ' ' . time() . '.' . $extension;
            $path = $request->file('imagen')->move(public_path() . '/images/promociones/', $nombreDeArchivoAlmacenar);
            Storage::delete('MagicCopy/public/images/promociones' . $promocion->imagen.'');
            $promocion->imagen = $nombreDeArchivoAlmacenar;
        }

        $nombreOriginal = DB::table('promociones')
            ->select('promociones.nombre')
            ->where('promociones.id', $id)
            ->get()->toArray();

        if ($nombreOriginal[0]->nombre != $request->nombre) {
            $promocion->fecha_inicio = $request->input(('nombre'));
        }

        $promocion->fecha_inicio = $request->input(('fecha_inicio'));
        $promocion->fecha_fin = $request->input(('fecha_fin'));
        $promocion->save();

        $products = DB::table('producto_promocion')
            ->where('producto_promocion.promocion_id', $id)
            ->get();


        if ($request->cantidad) {
            foreach ($request->producto as $iteracion => $v) {
                $datos = array(
                    $request->producto[$iteracion] => [
                        'cantidad' => $request->cantidad[$iteracion],
                        'precio_unitario' => $request->precio_unitario[$iteracion],
                    ]
                );
                $promocion->productos()->attach($datos);
            }

            $preciosOriginales = DB::table('productos')
                ->join('producto_promocion', 'productos.id', 'producto_promocion.producto_id')
                ->join('promociones', 'promociones.id', 'producto_promocion.promocion_id')
                ->select('producto_promocion.producto_id', 'productos.precio', 'producto_promocion.cantidad')
                ->groupBy('producto_promocion.producto_id', 'productos.precio', 'producto_promocion.cantidad')
                ->where('promociones.nombre', $request->nombre)
                ->get();

            $precioOriginal = 0;
            for ($i = 0; $i < sizeof($preciosOriginales); $i++) {
                $precio = floatval($preciosOriginales[$i]->precio);
                $cantidad = floatval($preciosOriginales[$i]->cantidad);
                $precioOriginal += $precio * $cantidad;
            }

            $promocion->precio_sin_descuento = $precioOriginal;
            $promocion->precio_con_descuento = $request->input('precio_con_descuento');
            $promocion->save();
        }

        return redirect('/promocion/editar/' . $id . '')->with('success', 'La Promocion se actualizó exitosamente');
    }

    public function destroy($id)
    {
        $promocion = Promocion::find($id);
        if ($promocion->imagen != 'noimage.jpg') {
            //Delete image
            Storage::delete('MagicCopy/public/images/promociones/' . $promocion->imagen);
        }
        $promocion->delete();

        return redirect('promocion')->with('success', 'Promoción eliminada');
    }
    public function mostrar()
    {
        $promociones = DB::table('promociones')
        ->select('promociones.id', 'promociones.nombre', 'promociones.fecha_inicio', 'promociones.fecha_fin', 'promociones.precio_con_descuento', 'promociones.imagen')
        ->get();
        $productos = Producto::all();
        return view('cotizaciones.crearCotizacion', compact('promociones', 'productos'));
    }

}
