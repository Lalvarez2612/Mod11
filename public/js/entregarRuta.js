

document.addEventListener('DOMContentLoaded', function() {
    let btns = document.getElementsByClassName('btn-fin');
    let modal = document.getElementById('exampleModal_3');
    let input = document.getElementById('codigo');
    let botonID = null; // Variable para almacenar el ID del botón clickeado

    // Añade el evento para capturar el ID cuando se hace clic en cualquier botón
    Array.from(btns).forEach(btn => {
        btn.addEventListener('click', function() {
            // Capturamos el ID del botón clickeado
            botonID = this.id;
            console.log("Botón clickeado, ID del botón: ", botonID);
        });
    });

    // Evento que se dispara cuando el modal se abre
    modal.addEventListener('shown.bs.modal', function() {
        console.log("Modal abierto, ID del botón: ", botonID);
        // Asegúrate de que el input se encuentre correctamente dentro del modal
        let input = modal.querySelector('#codigo');
        console.log("Input seleccionado: ", input);
        if (input && botonID) {
            input.value = botonID;
        }
    });
});