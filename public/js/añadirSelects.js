function updateSelectOptions() {
    // Obtener todos los selects dinámicos
    const selects = document.querySelectorAll('.dynamic-select');

    // Crear un conjunto (set) para almacenar los valores seleccionados
    const selectedValues = new Set();

    // Recorrer cada select y agregar su valor seleccionado al conjunto
    selects.forEach(select => {
        if (select.value) {
            selectedValues.add(select.value);
        }
    });

    // Recorrer los selects de nuevo para actualizar sus opciones
    selects.forEach(select => {
        // Obtener todas las opciones del select
        const options = select.querySelectorAll('.option');

        // Hacer visible todas las opciones antes de ocultar las seleccionadas
        options.forEach(option => {
            option.disabled = false; // Habilitar todas las opciones primero
        });

        // Deshabilitar las opciones que ya están seleccionadas en otros selects
        options.forEach(option => {
            if (selectedValues.has(option.value) && option.value !== select.value) {
                option.disabled = true; // Deshabilitar la opción si ya está seleccionada en otro select
            }
        });
    });
}

// Agregar eventos a todos los selects dinámicos
function addSelectEvents(select) {
    select.addEventListener('change', function() {
        updateSelectOptions(); // Actualizar las opciones cuando cambia el valor
    });
}


let aux=0;
// JavaScript para agregar más selects dinámicamente
document.getElementById('addSelectBtn').addEventListener('click', function() {

    const todos = document.querySelectorAll('.dynamic-select');
    const options = todos[0].querySelectorAll('.option');
    if (todos.length < options.length-1) {
        
    
    // Obtener el contenedor donde están los selects
    const selectContainer = document.getElementById('selectContainer');

    // Crear un nuevo div para el nuevo select

    let rem='rem-'+aux;
    console.log(rem)
    const newDiv = document.createElement('div');
    newDiv.classList.add('mb-5',rem); // Clase para el margen

    //crear label
    const newLabel = document.createElement('label');
    newLabel.classList.add('form-label','block');
    const newH5 = document.createElement('h5');
    newH5.textContent='Plato:';
    newLabel.appendChild(newH5);

    // Crear un nuevo select
    const newSelect = document.createElement('select');
    newSelect.name = "platillo[]"; // Importante para que se envíe como array
    newSelect.classList.add('border','block', 'form-select', 'mb-3', 'dynamic-select'); // Estilo y clase para referenciarlo
    newSelect.addEventListener('change', updateTotal);

    // Añadir las opciones del select

    options.forEach(option => {
        const opt = document.createElement('option');
        opt.value = option.value;
        opt.textContent = option.text;
        opt.classList.add('option');
        opt.setAttribute('data-precio', option.getAttribute('data-precio'));
        newSelect.appendChild(opt);
    });

    // Agregar el select al div y el div al contenedor
    newDiv.appendChild(newLabel);
    newDiv.appendChild(newSelect);
    selectContainer.appendChild(newDiv);

    // crear cantidad
    const newDiv1 = document.createElement('div');
    newDiv1.classList.add('text-info','mb-3');
    const newLabel1 = document.createElement('label');
    newLabel1.classList.add('form-label','block');
    const newB = document.createElement('b');
    newB.textContent='Cantidad';

    // añadir cantidad a div

    const newInput = document.createElement('input');
    newInput.classList.add('unidades', 'form-control', 'bg-transparent', 'text-white')
    newInput.name = 'orden_cantidad[]';
    newInput.placeholder= 'Cantidad'
    newInput.type='number';
    newInput.addEventListener('input', updateTotal);

    newLabel1.appendChild(newB);
    newDiv1.appendChild(newLabel1);
    newDiv1.appendChild(newInput);

    newDiv.appendChild(newDiv1);

    // agregar precioU

    const newDiv2 = document.createElement('div');
    newDiv2.classList.add('text-info','mb-3');
    const newLabel2 = document.createElement('label');
    newLabel2.classList.add('form-label','block');
    const newB1 = document.createElement('b');
    newB1.textContent='Precio unitario';
    const newSubDiv = document.createElement('div');
    newSubDiv.classList.add('precioU', 'form-control','bg-transparent', 'text-white');
    newSubDiv.textContent='0$';

    // añadir

    newLabel2.appendChild(newB1);
    newDiv2.appendChild(newLabel2);
    newDiv2.appendChild(newSubDiv);
    newDiv.appendChild(newDiv2);


    // boton

    newboton=document.createElement('button');
    newboton.id=rem;
    newboton.type='button';
    newboton.onclick= function() {
        const remover = document.getElementsByClassName(this.id);
        
        if (remover.length > 0) {
        remover[0].remove();
        updateTotal();
        updateSelectOptions();
        }
    };
    newboton.classList.add('removeSelectBtn', 'btn', 'btn-outline-primary', 'remo', 'mb-4');
    newboton.textContent='quitar plato';

    newDiv.appendChild(newboton);

    const newHr=document.createElement('hr');
    newHr.classList.add('blanco');

    newDiv.appendChild(newHr);



    // Agregar el evento al nuevo select
    addSelectEvents(newSelect);

    // Actualizar las opciones cuando se añade un nuevo select
    updateSelectOptions();

    aux++;
    console.log(aux)
    }
    else{
        alert('no se pueden agregar mas platos')
    }
});

function updateTotal() {
    let total = 0;
    const selects = document.querySelectorAll('.dynamic-select');
    selects.forEach(select => {
        const selectedOption = select.options[select.selectedIndex];
        const precio = parseFloat(selectedOption.getAttribute('data-precio')) || 0;

        // Obtener la cantidad correspondiente
        const inputCantidad = select.parentElement.querySelector('input[name="orden_cantidad[]"]');
        const cantidad = parseFloat(inputCantidad.value) || 0;

        // Actualizar el subtotal
        const subtotalDiv = select.parentElement.querySelector('.precioU');
        const subtotal = precio * cantidad;
        subtotalDiv.textContent = `${subtotal.toFixed(2)}$`;

        total += subtotal;
    });

    // Actualizar el total en el div correspondiente
    const totalDiv = document.getElementById('total');
    totalDiv.textContent = `${total.toFixed(2)}$`;
};

sel=document.getElementById('selP');
sel.addEventListener('change',updateTotal);
uni=document.getElementById('unidadesP');
uni.addEventListener('input', updateTotal);


// Inicializar el primer select con eventos y lógica
document.querySelectorAll('.dynamic-select').forEach(select => {
    addSelectEvents(select); // Añadir el evento de cambio
});