{{-- VISTA INDEX --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Binevenido")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

<div class="container text-white text-center rounded-3 w-50 p-5 mt-5">

    <h1 class="fs-2 font-bold text-info">Bienvenido al Módulo de Delivery</h1>
    <div>
        <img src="{{ asset('img/deliveryLogo.png') }}" alt="Logo de la marca" class="img mt-3">
    </div>
</div>

@endsection    

{{-- ESTILOS PARA LA IMAGEN --}}
<style>
    .container{
        display: flex;
        flex-direction: column;
        background: rgb(5, 12, 71);
    }
    .container img{
        margin: 0% 20%;
    }
    .img{
        width: 50%;
        
    }
</style>


