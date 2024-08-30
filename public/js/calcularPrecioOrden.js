const menuSelecc = document.getElementById("menu");
const unidades = document.getElementById('unidades');
const divPrincipal = document.getElementById("total");
    
function calcularTotal() {
    let precioMenu = "";

    if(menuSelecc.value == "Hamburguesa Mixta"){
        precioMenu = 10;
    }
    if(menuSelecc.value == "Pizza Margarita"){
        precioMenu = 30;
    }
    if(menuSelecc.value == "Ensalada César"){
        precioMenu = 15;
    }
    if(menuSelecc.value == "Tacos de Pollo"){
        precioMenu = 10;
    }
    if(menuSelecc.value == "Sopa de Lentejas"){
        precioMenu = 20;
    }

    const totalPrecio = precioMenu * parseInt(unidades.value) || 0; 
    divPrincipal.textContent = `${totalPrecio}$`;
}

unidades.addEventListener('input', calcularTotal);
menuSelecc.addEventListener('change', calcularTotal);