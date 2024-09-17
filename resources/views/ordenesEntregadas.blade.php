{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Ordenes Entregadas")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

  {{-- ALERTA PARA ERRORES DE VALIDACION AL BUSCAR POR CODIGO--}}

  @error('buscarCodigo')
      <div class="alert alert-danger text-center container w-50">{{ $message }}</div>
  @enderror

  <div class="w-100 container">
    @if ($bolean == TRUE)
      <h4 class="text-center text-info mb-4">Odenes Entregadas</h4>
      <div class="w-100">
        <form class="d-flex formBuscar" action="{{ route("entregas.show") }}" method="POST">
            @csrf
            <input type="text" class="form-control bg-transparent text-white me-2"
                placeholder="Buscar por Código una Orden Entregada" name="buscarCodigo" value="{{ old('buscarCodigo') }}">
            <button class="btn btn-outline-primary" type="submit">
                <i class='bx bx-search-alt-2'></i>
            </button>
        </form>
      </div>
    @else
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div style="margin-right: 20px;">
          <a href="{{route('entregas.index')}}" class="btn btn-outline-primary" title="Resumen Ordenes">
              <i class='bx bx-arrow-back'></i>
          </a>
        </div>
        <div class="w-100 text-center text-info">
          <h4 class="text-center text-info">¡Orden Encontrada con Éxito!</h4>
        </div>
      </div>
    @endif
  </div>
  <hr class="text-white mx-4 mb-4">

  {{-- MOSTRANDO LAS ORDENES EN CARDS --}}
  <div class="cajaCards text-center mt-2">
    @foreach ($ordenes as $item)
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
          <p class="estaTime"><b class="text-info">Tiempo Total de la Entrega:</b> {{\Carbon\Carbon::parse($item->tiempo_total)->format('h:i:s')}}</p>
        </div>
        <hr class="text-white">

        <div class="text-start mb-2">
          <h5 class="text-info"><b>Datos del Cliente:</b></h5>
          <p><b class="text-info">Cédula:</b> {{ $item->cedula }}</p>
          <p><b class="text-info">Nombre y Apellido:</b> {{ $item->nombre_apellido }}</p>
          <p><b class="text-info">Teléfono:</b> {{ $item->telefono }}</p>
          <p><b class="text-info">Dirección:</b> {{ $item->direccion }}</p>
          <p><b class="text-info">Metodo de Pago:</b> {{ $item->nombre_metodo }}</p>
        </div>
      </div>
    @endforeach
  </div>

@endsection    




