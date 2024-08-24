{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Ordenes Resumen")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

  {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}
  @if ($mensaje = Session::get('success'))
      <div class="alert alert-info text-center container w-25" role="alert">
          {{$mensaje}}
      </div>
  @endif

  {{-- ALERTA PARA ERRORES DE VALIDACION AL BUSCAR POR CODIGO--}}

  @error('buscarCodigo')
      <div class="alert alert-danger text-center container w-50">{{ $message }}</div>
  @enderror

  <div class="w-100 container">
    @if ($bolean == FALSE)
      <div class="d-flex">
        <div>
          <a href="{{route('ordenes.index')}}" class="btn btn-outline-primary" title="Resumen Ordenes">
              <i class='bx bx-arrow-back'></i>
          </a>
        </div>

        <div class="flex-grow-1">
          <h4 class="text-center text-info mb-5">¡Orden Encontrada con Éxito!</h4>
        </div>
      </div>
    @else
      <h4 class="text-center text-info mb-5">Resumen de Odenes</h4>

      <div class="row">
        <div class="col">
          <a class="btn btn-outline-primary mb-3" href="{{ route("ordenes.create") }}">Crear una Orden</a>
        </div>
  
        <div class="col mx-3">
          <form class="d-flex formBuscar mb-3" action="{{ route("ordenes.show") }}" method="POST">
              @csrf
              <input type="text" class="form-control bg-transparent text-white me-2"
                  placeholder="Buscar por Código" name="buscarCodigo" value="{{ old('buscarCodigo') }}">
              <button class="btn btn-outline-primary" type="submit">
                  <i class='bx bx-search-alt-2'></i>
              </button>
          </form>
        </div>
      </div>
    @endif
  </div>

  {{-- MOSTRANDO LAS ORDENES EN CARDS --}}

  <div class="cajaCards text-center mt-2">

    @if ($bolean == TRUE)

      @foreach ($ordenes as $item)

      <div class="cards mb-3">
        <div class="d-flex justify-content-between mb-2">
          <h4 class="text-info">{{ $item->orden_codigo }}</h4>
          <h4 class="text-info">{{ $item->nombre_menu }}</h4>
        </div>
        <hr class="text-white">
  
        <div class="text-start mb-2">
          <h5 class="text-info"><b>Descripción del Plato:</b></h5>
          <p>{{ $item->descripcion_menu }}</p>
  
          <h5 class="text-info"><b>Comentario Adicional del Cliente:</b></h5>
          <p>{{ $item->comentario_adicional }}</p>
  
          <p><b class="text-info">Cantidad a Preparar:</b> {{ $item->orden_cantidad }} Unidades</p>
          <p><b class="text-info">Orden creada el Día:</b> {{ $item->fechaCreacion_orden->format("d/m/Y") }}</p>
          <p><b class="text-info">Estatus de la Orden:</b> {{ $item->orden_estatus }}</p>
          
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
        <hr class="text-white">

        @if ($item->orden_estatus == "Asignada")
          <div class="text-center">
            <a href="{{ route("ordenes.edit", $item->id_orden ) }}" 
                class="btn btn-outline-info mx-1 my-1" title="Editar">
                <i class='bx bx-edit'></i>
            </a>
          </div>
        @else
          <div class="text-center">
            <a href="{{ route("asignacion.create", $item->id_orden) }}" 
              class="btn btn-outline-success mx-1 my-1" title="Asignar a un Repartidor">
              <i class='bx bxs-user-plus' ></i>
            </a>
            <a href="{{ route("ordenes.edit", $item->id_orden ) }}" 
                class="btn btn-outline-info mx-1 my-1" title="Editar">
                <i class='bx bx-edit'></i>
            </a>
            <a href="{{ route("ordenes.delete", $item->id_orden ) }}"
                class="btn btn-outline-danger mx-1" title="Eliminar">
                <i class='bx bx-trash'></i>
            </a>
          </div> 
        @endif
      </div>
          
      @endforeach
        
    @else

      <div class="cards mb-3">
        <div class="d-flex justify-content-between mb-2">
          <h4 class="text-info">{{ $ordenes->orden_codigo }}</h4>
          <h4 class="text-info">{{ $ordenes->nombre_menu }}</h4>
        </div>
        <hr class="text-white">
  
        <div class="text-start mb-2">
          <h5 class="text-info"><b>Descripción del Plato:</b></h5>
          <p>{{ $ordenes->descripcion_menu }}</p>
  
          <h5 class="text-info"><b>Comentario Adicional del Cliente:</b></h5>
          <p>{{ $ordenes->comentario_adicional }}</p>
  
          <p><b class="text-info">Cantidad a Preparar:</b> {{ $ordenes->orden_cantidad }} Unidades</p>
          <p><b class="text-info">Orden creada el Día:</b> {{ $ordenes->fechaCreacion_orden->format("d/m/Y") }}</p>
          <p><b class="text-info">Estatus de la Orden:</b> {{ $ordenes->orden_estatus }}</p>
          
        </div>
        <hr class="text-white">
  
        <div class="text-start mb-2">
          <h5 class="text-info"><b>Datos del Cliente a Entregar la Orden:</b></h5>
          <p><b class="text-info">Cédula:</b> {{ $ordenes->cedula }}</p>
          <p><b class="text-info">Nombre y Apellido:</b> {{ $ordenes->nombre_apellido }}</p>
          <p><b class="text-info">Teléfono:</b> {{ $ordenes->telefono }}</p>
          <p><b class="text-info">Dirección:</b> {{ $ordenes->direccion }}</p>
          <p><b class="text-info">Metodo de Pago:</b> {{ $ordenes->nombre_metodo }}</p>
        </div>
        <hr class="text-white">

        @if ($ordenes->orden_estatus == "Entregada")
          <div class="text-center text-info">
            <h4 class="mt-4">¡Esta Orden ya Fue Entregada!</h4>
          </div> 
        @elseif($ordenes->orden_estatus == "Asignada")
          <div class="text-center">
            <a href="{{ route("ordenes.edit", $ordenes->id_orden ) }}" 
                class="btn btn-outline-info mx-1 my-1" title="Editar">
                <i class='bx bx-edit'></i>
            </a>
          </div>
        @else
          <div class="text-center">
            <a href="{{ route("asignacion.create", $ordenes->id_orden) }}" 
              class="btn btn-outline-success mx-1 my-1" title="Asignar a un Repartidor">
              <i class='bx bxs-user-plus' ></i>
            </a>
            <a href="{{ route("ordenes.edit", $ordenes->id_orden ) }}" 
                class="btn btn-outline-info mx-1 my-1" title="Editar">
                <i class='bx bx-edit'></i>
            </a>
            <a href="{{ route("ordenes.delete", $ordenes->id_orden ) }}"
                class="btn btn-outline-danger mx-1" title="Eliminar">
                <i class='bx bx-trash'></i>
            </a>
          </div> 
        @endif
      </div>  
    @endif

  </div>

@endsection    



