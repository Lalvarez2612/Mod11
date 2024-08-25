let coord1 = {lat: 10.5107281, lng: -66.9396933};
let coord2Select = document.getElementById("coord2");

let map = L.map('map').setView([coord1.lat, coord1.lng], 18);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Marcador para el primer punto
let marker1 = L.marker([coord1.lat, coord1.lng]).addTo(map).bindPopup("<b>Instituto Jesus Obrero (IUJO)!</b><br>Punto de Origen.").openPopup();

let marker2; 
let routingControl;

function calcularRuta(){
    const textoSeleccionado = coord2Select.options[coord2Select.selectedIndex].text; 
    let coord2Array = coord2Select.value.split(","); 
    let coord2 = {lat: parseFloat(coord2Array[0]), lng: parseFloat(coord2Array[1])};

    // ELIMINAR SEGUNDA MARCA SI YA EXISTE
    if (marker2) {
        map.removeLayer(marker2);
    }

    // Marcador para el segundo punto
    marker2 = L.marker([coord2.lat, coord2.lng]).addTo(map)
        .bindPopup(`<b>${textoSeleccionado}</b><br>Punto de Entrega.`).openPopup();

    // ELIMINAR SEGUNDA RUTA SI YA EXISTE
    if (routingControl) {
        map.removeControl(routingControl);
    }

    // DIBUJAR RUTA EN EL MAPA
    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(coord1.lat, coord1.lng),
            L.latLng(coord2.lat, coord2.lng)
        ],
        routeWhileDragging: true,
        language: 'es' 
    }).addTo(map);
}

// INVOCAR LA FUNCION MEDIANTE EVENTOS
coord2Select.addEventListener("change",calcularRuta);
calcularRuta();
