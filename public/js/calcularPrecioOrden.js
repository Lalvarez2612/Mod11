
// // document.getElementById('seleccion').addEventListener('change', function() {
// //     id = this.value;

// //     // Crear la solicitud AJAX 
// //     var ajax = new XMLHttpRequest();
// //     ajax.open('GET', '/ordenes/create/'+id, true);
// //     ajax.onload = function() {
// //         if (ajax.status === 200) {
// //             response = JSON.parse(ajax.responseText);

            

            
// //             // Actualizar el DOM con los datos recibidos
// //             document.getElementById('precioU').textContent = 
// //                 response.precio_menu+'$';

            
// //                 precio=document.getElementById('precioU').innerText;
// //     cant=document.getElementById('unidades').value;
// //     console.log(cant);
// //     total=cant*parseFloat(precio.replace('$','')) ||0;
// //     console.log(total);
// //     document.getElementById('total').textContent =
// //         total+'$';
            
            
// //         }
// //         else{
// //             alert('no se pudo hacer la solicitud')
// //         }
// //     };
// //     ajax.send();
// // });

// document.getElementById('addSelectBtn').addEventListener('click', empezar);


//     function empezar(){
//         let platillos = document.getElementsByName('platillos[]');
//         console.log(platillos)

//     platillos.forEach((platillo, index) => {
//         platillo.addEventListener('change', function() {
        
//             const precio = platillo.selectedOptions[0].dataset.precio;
            
//             // Obtener el input de cantidad relacionado usando el índice
//             const cant = document.getElementsByName('orden_cantidad[]')[index].value;
    
//             console.log(cant);
    
//             const total = cant * parseFloat(precio) || 0;
//             console.log(total);
    
//             document.getElementById('total').textContent = total + '$';
//         });
//     });
// };
// document.addEventListener("DOMContentLoaded", empezar());


// // document.getElementsByName('platillos[]').addEventListener('change', function() {
    
    
// //     const precio = document.getElementById('seleccion').selectedOptions[0].dataset.precio;
// //     document.getElementById('precioU').textContent = precio+'$';

// //     const cant=document.getElementById('unidades').value;
// //     console.log(cant);
// //     const total=cant*parseFloat(precio) ||0;
// //     console.log(total);
// //     document.getElementById('total').textContent = total+'$';
// // });



// function calcularPrecio() {
//     const precio=document.getElementById('precioU').innerText;
//     const cant=document.getElementById('unidades').value;
//     console.log(cant);
//     const total=cant*parseFloat(precio.replace('$','')) ||0;
//     console.log(total);
//     document.getElementById('total').textContent =
//         total+'$';
// };


// document.addEventListener("DOMContentLoaded", function () {
//     const pr =document.getElementById('seleccion').selectedOptions[0].dataset.precio;
//         if (pr != undefined){
//         document.getElementById('precioU').textContent = 
//                 pr+'$';
//         }
//         const can=document.getElementById('unidades').value;
//         const tota=can*parseFloat(pr) ||0;
//         document.getElementById('total').textContent =
//         tota+'$';
// })

// // prec=document.getElementById('precioU');
// // prec.addEventListener('change', calcularPrecio);
// // unidad=document.getElementById('unidades');
// // unidad.addEventListener('input', calcularPrecio);
// // total=null;