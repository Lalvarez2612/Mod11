{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Eliminar una Orden")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    <div class="d-flex justify-content-between align-items-center container mb-4">
        <h4 class="text-danger">¿Estas Seguro de Eliminar la Siguiente Orden del Sistema?</h4>

        <form action="{{ route("ordenes.destroy", $item->id_orden) }}" 
            method="POST">
            @csrf
            @method("DELETE")

            {{-- BOTONES DEL FORMULARIO --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-warning mx-3" href="{{ route('ordenes.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-outline-danger">Si, estoy Seguro</button>
            </div>
        </form>
    </div>
    <hr class="text-white mx-3">

    {{-- MOSTRANDO LA ORDEN EN UNA CARD --}}

    <div class="cajaCards text-center mt-2">
        <div class="cards mb-3">
          <div class="d-flex justify-content-center mb-2">
            <h2 class="text-info">{{ $item->orden_codigo }}</h2>
          </div>
          <hr class="text-white">
  
          <div class="text-start mb-2">
  
            @foreach ($platillos as $platillo)
              @if ($platillo->id_orden == $item->id_orden)
                <h3 class="text-info"><b>Plato:</b> {{$platillo->nombre_menu}}</h3>
                <h5 class="text-info"><b>Descripción del Plato:</b></h5>
                <p>{{ $platillo->descripcion_menu }}</p>
                <h5 class="text-info">Canidad pedida</h5>
                <p>{{$platillo->cantidad}} Unidades</p>
              @endif    
            @endforeach
  
            <h5 class="text-info"><b>Comentario Adicional del Cliente:</b></h5>
            <p>{{ $item->comentario_adicional }}</p>
  
            <p><b class="text-info">Orden creada el Día:</b> {{ $item->fechaCreacion_orden->format("d/m/Y") }}</p>
              <p class="estaTime"><b class="text-info">Estatus de la Orden:</b> {{ $item->orden_estatus }}</p>
              
          </div>
          <hr class="text-white">
  
          <div class="text-start mb-2">
            <h5 class="text-info"><b>Datos del Cliente a Entregar la Orden:</b></h5>
            <p><b class="text-info">Cédula:</b> {{ $item->cedula }}</p>
            <p><b class="text-info">Nombre y Apellido:</b> {{ $item->nombre_apellido }}</p>
            <p><b class="text-info">Teléfono:</b> {{ $item->telefono }}</p>
            <p><b class="text-info">Dirección:</b> {{ $item->direccion }}</p>
            <p><b class="text-info">Metodo de Pago:</b> {{ $item->nombre_metodo }}</p>
          </div>
        </div>
      

@endsection    



