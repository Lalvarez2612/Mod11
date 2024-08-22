{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Ordenes Resumen")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="d-flex justify-content-between align-items-center container mb-5">
        <h4 class="text-danger">¿Estas Seguro de Eliminar la Siguiente Orden del Sistema?</h4>

        <form action="{{ route("ordenes.destroy", $ordenDelete->id_orden) }}" 
            method="POST">
            @csrf
            @method("DELETE")

            {{-- BOTONES DEL FORMULARIO --}}
            <div class="d-flex justify-content-end nav-links">
                <a class="btn btn-outline-warning mx-3" href="{{ route('ordenes.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-outline-danger">Si, estoy Seguro</button>
            </div>
        </form>
    </div>

    {{-- MOSTRANDO LA ORDEN EN UNA CARD --}}

    <div class="cajaCards text-center mt-2">

    <div class="cards mb-3">
        <div class="d-flex justify-content-between mb-2">
            <h4 class="text-info">{{ $ordenDelete->orden_codigo }}</h4>
            <h4 class="text-info">{{ $ordenDelete->nombre_menu }}</h4>
        </div>
        <hr class="text-white">

        <div class="text-start mb-2">
            <h5 class="text-info"><b>Descripción del Plato:</b></h5>
            <p>{{ $ordenDelete->descripcion_menu }}</p>

            <h5 class="text-info"><b>Comentario Adicional del Cliente:</b></h5>
            <p>{{ $ordenDelete->comentario_adicional }}</p>

            <p><b class="text-info">Cantidad a Preparar:</b> {{ $ordenDelete->orden_cantidad }} Unidades</p>
            <p><b class="text-info">Orden creada el Día:</b> {{ $ordenDelete->fechaCreacion_orden->format("d/m/Y") }}</p>
            <p><b class="text-info">Estatus de la Orden:</b> {{ $ordenDelete->orden_estatus }}</p>
            
        </div>
        <hr class="text-white">

        <div class="text-start mb-2">
            <h5 class="text-info"><b>Datos del Cliente a Entregar la Orden:</b></h5>
            <p><b class="text-info">Cédula:</b> {{ $ordenDelete->cedula }}</p>
            <p><b class="text-info">Nombre y Apellido:</b> {{ $ordenDelete->nombre_apellido }}</p>
            <p><b class="text-info">Teléfono:</b> {{ $ordenDelete->telefono }}</p>
            <p><b class="text-info">Dirección:</b> {{ $ordenDelete->direccion }}</p>
            <p><b class="text-info">Metodo de Pago:</b> {{ $ordenDelete->nombre_metodo }}</p>
        </div>
        <hr class="text-white">
    </div>

@endsection    



