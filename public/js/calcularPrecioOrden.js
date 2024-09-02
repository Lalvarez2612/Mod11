
document.getElementById('seleccion').addEventListener('change', function() {
    id = this.value;

    // Crear la solicitud AJAX 
    var ajax = new XMLHttpRequest();
    ajax.open('GET', '/ordenes/create/'+id, true);
    ajax.onload = function() {
        if (ajax.status === 200) {
            response = JSON.parse(ajax.responseText);

            

            
            // Actualizar el DOM con los datos recibidos
            document.getElementById('precioU').textContent = 
                response.precio_menu+'$';
        }
        else{
            alert('no se pudo hacer la solicitud')
        }
    };
    ajax.send();
});



function calcularPrecio() {
    precio=response.precio_menu;
    cant=document.getElementById('unidades').value;
    console.log(cant);
    total=cant*precio ||0;
    document.getElementById('total').textContent =
        total+'$';
}
prec=document.getElementById('precioU');
prec.addEventListener('change', calcularPrecio);
unidad=document.getElementById('unidades');
unidad.addEventListener('input', calcularPrecio);