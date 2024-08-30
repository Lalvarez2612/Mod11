import getLatLon from './getLatLon.js';

const buscarCoord = async () => {
    const latLon = await getLatLon('Chapinero, Bogotá, Colombia');
    console.log(latLon);
}

document.addEventListener('DOMContentLoaded', () => {
    const boton = document.getElementById('miBoton'); 
    if (boton) {
        boton.addEventListener('click', buscarCoord);
    }
});