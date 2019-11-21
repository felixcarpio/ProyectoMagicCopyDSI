const inputBuscador = document.querySelector('#buscar');

eventListeners();

function eventListeners(){

  //buscador
  inputBuscador.addEventListener('input', buscarProductos);

}

function buscarProductos(e) {
    const expresion = new RegExp(e.target.value, "i");
            registros = document.querySelectorAll('tbody tr');

            registros.forEach(registro => {
                registro.style.display = 'none';

                if(registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1 ){
                    registro.style.display = 'table-row';
                }
            })
}
