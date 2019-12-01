var enero = document.getElementById("enero").innerText
var febrero = document.getElementById("febrero").innerText
var marzo = document.getElementById("marzo").innerText
var abril = document.getElementById("abril").innerText
var mayo = document.getElementById("mayo").innerText
var junio = document.getElementById("junio").innerText
var julio = document.getElementById("julio").innerText
var agosto = document.getElementById("agosto").innerText
var septiembre = document.getElementById("septiembre").innerText
var octubre = document.getElementById("octubre").innerText
var noviembre = document.getElementById("noviembre").innerText
var diciembre = document.getElementById("diciembre").innerText

new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      datasets: [
        {
          label: "Ventas del mes (en dolares)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2","#3cba9f","#33ffaf","#3399ff","#e8c3b9","#c45850"],
          data: [enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Total de Ventas en el Año Actual'
      }
    }
});