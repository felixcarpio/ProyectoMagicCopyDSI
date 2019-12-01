const compra = new Carrito();
const listaCompra = document.querySelector('#lista-compra tbody');
const carrito = document.getElementById('carrito');
const procesarCompraBtn = document.getElementById('procesar-compra');
const cliente = document.getElementById('cliente');
const correo = document.getElementById('correo');

cargarEventos();


function cargarEventos(){

    document.addEventListener('DOMContentLoaded', compra.leerLocalStorageCompra());
    
    carrito.addEventListener('click', (e)=>{compra.eliminarProducto(e)});

    compra.calcularTotal();

    procesarCompraBtn.addEventListener('click', procesarReserva);
}

function procesarReserva(e){
    e.preventDefault();

    if(compra.obtenerProductosLocalStorage().length === 0){
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: "No hay productos, selecciona alguno",
            timer: 2000
          }).then(function(){
            location.href = "/reserva/categoria";
          });
    }
    else if(cliente.value === "" || correo.value === ""){
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: "Ingrese su nombre y correo",
            timer: 2000
          })
    }else{
        const cargandoGif = document.querySelector('#cargando');
        cargandoGif.style.display = "block";

        const enviado = document.createElement('img');
        enviado.src = '/images/mail.gif';
        enviado.style.display = 'block';
        enviado.width = '150';

        setTimeout(()=>{
            cargandoGif.style.display = 'none';
            document.querySelector('#loaders').appendChild(enviado);
            setTimeout(() => {
                //
                document.getElementById('procesar-pago').submit();
                enviado.remove();
                compra.vaciarLocalStorage();
            },2000);
        }, 3000);
    }
}
