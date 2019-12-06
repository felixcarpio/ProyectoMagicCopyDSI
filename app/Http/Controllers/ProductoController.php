<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Marca;
use App\Proveedor;
use App\CategoriaProducto;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Session;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $articulo = Producto::all();

      $marcas = Marca::all();

      $categorias = CategoriaProducto::all();

      $proveedores = Proveedor::all();

     return view('productos.producto')->with('marcas',$marcas)->with('articulo',$articulo)->with('proveedores',$proveedores)->with('categorias',$categorias);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'nombre' => 'required',
        // 'descripcion' => 'required',
        'precio' => 'required',
        // 'existencias' => 'required',
        'marcas_id' => 'required',
        'marcas_id' => 'required',
        // 'imagen' => 'required',
      ]);

      $ProductosNormales = DB::table('productos')
      ->select('productos.codigo')
      ->get();
      $ProductosNormal = DB::table('productos')
      ->select('productos.codigo')
      ->get();

      $codigoProducto = 100000;
      $diferente = False;

        while($diferente == False){
          if ($codigoProducto == 100000) {
            $diferente = True;
          }
          foreach ($ProductosNormales as $producto) {
            while ($producto->codigo == $codigoProducto) {
              $codigoC = mt_rand(0,9);
              $codigo1 = mt_rand(0,9);
              $codigo2 = mt_rand(0,9);
              $codigo3 = mt_rand(0,9);
              $codigo4 = mt_rand(0,9);
              $codigo5 = mt_rand(0,9);
              $codigoProducto = $codigoC."".$codigo1."".$codigo2."".$codigo3."".$codigo4."".$codigo5;
              $diferente = True;
            }
          }
          foreach ($ProductosNormal as $producto) {
            if($producto->codigo == $codigoProducto) {
              $diferente = False;
            }
          }
        }

      //Manejo de imagenes
      if($request->hasFile('imagen')){
        // Obtiene el nombre de la imagen junto a su extension
        $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
        // Obtiene el nombre de la imagen (sin su extension)
        $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
        // Obtiene solo la extension de la imagen
        $extension = $request->file('imagen')->getClientOriginalExtension();
        // Nombre con el que se guardara la imagen: nombreImagen+Fecha+.extension
        $nombreDeArchivoAlmacenar = $nombreDeArchivo.'_'.time().'.'.$extension; //concatenates with timestamp
        // Subida de la imagen
        $path = $request->file('imagen')->move(public_path().'/images/', $nombreDeArchivoAlmacenar);   // public/storage  storage/app/public
      }
      else {
        $nombreDeArchivoAlmacenar = 'noimage.jpg';
      }
      $articulo = new Producto;
      $proveedor = new Proveedor;
      $articulo->codigo = $codigoProducto;
      $articulo->nombre = $request->input('nombre');
      $articulo->descripcion = $request->input('descripcion');
      $articulo->precio = $request->input('precio');
      $articulo->precio_con_descuento = $request->input('precioConDescuento');
      $articulo->existencias = 0;
      $articulo->marcas_id = $request->input('marcas_id');
      $articulo->categorias_id = $request->input('categorias_id');
      // $articulo->proveedor_id = $request->input('proveedor_id');

      $articulo->imagen = $nombreDeArchivoAlmacenar;

      $articulo->save();
      $articulo->proveedores()->sync($request->get('proveedor_id'));

      return redirect('producto')->with('success', 'El nuevo Producto se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $productoProveedor = DB::table('proveedores')
      ->join('producto_proveedor','proveedores.id','producto_proveedor.proveedor_id')
      ->join('productos', 'producto_proveedor.producto_id', 'productos.id')
      ->select('proveedores.nombre')
      ->where('productos.id', $id)
      ->groupBy('proveedores.nombre')
      ->get()->toArray();

      $producto = Producto::find($id);
      $marcas = Marca::all();
      $categorias = CategoriaProducto::all();
      return view('productos.ver', compact('productoProveedor', 'producto', 'marcas', 'categorias'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'nombre' => 'required',
        'precio' => '|required|numeric',
        'marcas_id' => 'required',
        'categorias_id' => 'required',
      ]);
      if($request->hasFile('imagen')){
          $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
          $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
          $extension = $request->file('imagen')->getClientOriginalExtension();
          $nombreDeArchivoAlmacenar = $nombreDeArchivo.' '.time().'.'.$extension;
          $path = $request->file('imagen')->move(public_path().'/images/', $nombreDeArchivoAlmacenar);
      }



      $articulo = Producto::find($id);

      $articulo->nombre = $request->input('nombre');
      $articulo->descripcion = $request->input('descripcion');
      $articulo->precio = $request->input('precio');
      $articulo->precio_con_descuento = $request->input('precioConDescuento');
      $articulo->marcas_id = $request->input('marcas_id');
      $articulo->categorias_id = $request->input('categorias_id');
      // $articulo->proveedor_id = $request->input('proveedor_id');
      if($request->hasFile('imagen')){
        Storage::delete('MagicCopy/public/images/' . $articulo->imagen);
        $articulo->imagen = $nombreDeArchivoAlmacenar;
      }
      $articulo->save();
      $articulo->proveedores()->sync($request->get('proveedor_id'));
      return redirect('producto')->with('success', 'El nuevo Producto se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $articulo = Producto::find($id);
      if($articulo->imagen != 'noimage.jpg'){
         //Delete image
         Storage::delete('MagicCopy/public/images/' . $articulo->imagen);
       }
      $articulo->delete();

      return redirect('producto')->with('success', 'Producto Eliminado');
    }

}
