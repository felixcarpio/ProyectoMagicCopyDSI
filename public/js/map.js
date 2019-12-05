
document.addEventListener('DOMContentLoaded', function(){
    var map = L.map('mapa').setView([13.676060, -89.259612], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    L.marker([13.676060, -89.259612]).addTo(map)
        .bindPopup('Magic Copy')
        .openPopup()
        .bindTooltip ('Estamos aqui')
        .openTooltip();
})