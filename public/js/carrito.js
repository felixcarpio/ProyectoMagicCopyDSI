class Carrito {

  // Aniadir el producto al Carrito
  comprarProducto(e) {
    e.preventDefault();
    if (e.target.classList.contains('agregar-carrito')) {
      const producto = e.target.parentElement.parentElement;
      this.leerDatosProducto(producto);
    }
  }

  leerDatosProducto(producto) {
    const infoProducto = {
      imagen: producto.querySelector('img.imagenPublicidad').src,
      titulo: producto.querySelector('h2').textContent,
      precio: producto.querySelector('label.precio').textContent,
      // precioConDescuento : producto.querySelector('label.precioDescuento').textContent,
      id: producto.querySelector('a').getAttribute('data-id'),
      cantidad: 1
    }

    let productosLS;
    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function(productoLS){
      if(productoLS.id === infoProducto.id){
        productosLS = productoLS.id;
      }
    });
    if(productosLS === infoProducto.id){
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Producto ya agregado, eliminelo del carrito y seleccione de nuevo la cantidad a reservar',
        timer: 3000
      })
    }
    else{
      this.insertarCarrito(infoProducto);
    }
  }

  insertarCarrito(producto) {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>
        <img src="${producto.imagen}" width=90>
      </td>
      <td>${producto.titulo}</td>
      <td>${producto.precio}</td>
      <td>
        <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
      </td>
    `;
    listaProductos.appendChild(row);
    this.guardarProductosLocalStorage(producto);
  }

  eliminarProducto(e) {
    console.log("entre a eliminar");

    e.preventDefault();
    let producto, productoID;
    if (e.target.classList.contains('borrar-producto')) {
      e.target.parentElement.parentElement.remove();
      console.log("entre a if");

      producto = e.target.parentElement.parentElement;
      productoID = producto.querySelector('a').getAttribute('data-id');
    }
    this.eliminarProductoLocalStorage(productoID);
    this.calcularTotal();
  }

  vaciarCarrito(e) {
    e.preventDefault();
    while (listaProductos.firstChild) {
      listaProductos.removeChild(listaProductos.firstChild);
    }
    this.vaciarLocalStorage();
    return false
  }

  guardarProductosLocalStorage(producto) {
    let productos;
    productos = this.obtenerProductosLocalStorage();
    productos.push(producto);
    localStorage.setItem('productos', JSON.stringify(productos));
  }

  obtenerProductosLocalStorage() {
    let productoLS;

    if (localStorage.getItem('productos') === null) {
      productoLS = [];
    } else {
      productoLS = JSON.parse(localStorage.getItem('productos'));
    }
    return productoLS;
  }

  eliminarProductoLocalStorage(productoID) {
    let productosLS;

    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function (productoLS, index) {
      if (productoLS.id === productoID) {
        productosLS.splice(index, 1);
      }
    });

    localStorage.setItem('productos', JSON.stringify(productosLS));
  }

  leerLocalStorage() {
    let productosLS;
    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function (producto) {
      const row = document.createElement('tr');
      row.innerHTML = `
      <td>
        <img src="${producto.imagen}" width=90>
      </td>
      <td>${producto.titulo}</td>
      <td>${producto.precio}</td>
      <td>
        <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
      </td>
    `;
      listaProductos.appendChild(row);
    });
  }

  vaciarLocalStorage(){
    localStorage.clear();
  }

  procesarPedido(e){
    e.preventDefault();
    if(this.obtenerProductosLocalStorage().length === 0){
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'No hay productos en el carrito',
        timer: 2000
      })
    }else{
      location.href = "/reserva/reservaConfirmacion";

    }
  }

  leerLocalStorageCompra() {
    let productosLS;
    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function (producto) {
      const row = document.createElement('tr');
      row.innerHTML = `
      <td style="display:none">
      <input type="number" name="producto" id="producto" value="${producto.id}" disabled>
      </td>
      <td>
        <img src="${producto.imagen}" width=90>
      </td>
      <td>${producto.titulo}</td>
      <td>${producto.precio}</td>
      <td>
        <input type="number" name="cantidad" class="form-control cantidad" min="1" value=${producto.cantidad} disabled>
        <input type="number" name="cantidadInput[]" style="display:none" value="${producto.cantidad}">
      </td>
      <td>${producto.precio * producto.cantidad}</td>
      <td>
        <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
        <input type="number" name="productoInput[]" style="display:none" value="${producto.id}">
      </td>
    `;
      listaCompra.appendChild(row);
    });
  }

  //Calcular montos
  calcularTotal(){
    let productosLS;
    let total = 0, igv = 0, subtotal = 0;
    productosLS = this.obtenerProductosLocalStorage();
    for(let i = 0; i < productosLS.length; i++){
        let element = Number(productosLS[i].precio * productosLS[i].cantidad);
        subtotal = subtotal + element;

    }

    igv = parseFloat(subtotal * 0.13);
    console.log(igv);
    console.log(subtotal);
    total = subtotal;
    console.log(total);
    document.getElementById('subtotal').innerHTML = "$ " + subtotal.toFixed(2);
    document.getElementById('igv').innerHTML = "$ " + igv.toFixed(2);
    document.getElementById('total').innerHTML = subtotal.toFixed(2);
    document.getElementById('inputTotal').value = subtotal.toFixed(2);
}
}
