{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Visualizar Ruta")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

  {{-- ALERTA DE VALIDACION DEL FORM --}}

  @if ($errors->any())
    <div class="container alert alert-danger text-center w-25" role="alert">
      @foreach ($errors->all() as $error)
          {{ $error }} <br>
      @endforeach
    </div>
  @endif

  {{--  ESTRCUTURA DE LA VISTA --}}
  <div class="container d-flex align-items-center flex-column w-100">

    <div class="w-100">
      @if ($bolean == TRUE)
        <div class="d-flex">
            <div>
            <a href="{{route('asignacion.create',$id_orden,$id_repartidor)}}" class="btn btn-outline-primary" title="Resumen Rutas">
                <i class='bx bx-arrow-back'></i>
            </a>
            </div>

            <div class="flex-grow-1">
                <h4 class="text-center text-info">Visualiza la Ruta a Recorrer</h4>
            </div>
        </div>  
      @else
        <div class="d-flex">
            <div>
            <a href="{{route('rutas.index')}}" class="btn btn-outline-primary" title="Resumen Rutas">
                <i class='bx bx-arrow-back'></i>
            </a>
            </div>

            <div class="flex-grow-1">
                <h4 class="text-center text-info">¡Visualiza la Ruta Guardada!</h4>
            </div>
        </div>  
      @endif
    </div>

    {{-- ESTRCUTURA DEL MAPA Y FORMULARIO --}}
    <div class="w-100 text-center text-black mt-4">
      @if ($bolean == TRUE)
        <form action="{{route("asignacion.store", ['id_repartidor'=>$id_repartidor,'id_orden'=>$id_orden])}}" method="POST">
          @csrf
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-info">Orden Seleccionada: <b class="text-danger">{{ $ordenRuta->orden_codigo }}</b></h4>
                <button type="submit" class="btn btn btn-outline-primary mb-3" title="Guardar y Asignar Ruta">
                    Guardar y Asignar Ruta
                </button>
            </div>
            {{-- BUSCADOR DE UBICACIONES --}}
            <div class="d-flex justify-content-start mb-3 selectRuta">
                <div class="form-control text-start bg-transparent text-info" id="coord1" style="margin-right: 10px;">Punto de Origen: Instituto Universitario Jesús Obrero (IUJO)</div>
                <select class="form-select text-info" id="coord2" name="punto_entrega">
                    <option value="Selecciona el Punto de Entrega">Selecciona el Punto de Entrega</option>
                    <option value="10.4866465,-66.9424115">Urbanización Los Verdes/Paraíso</option>
                    <option value="10.5,-66.9192749">Plaza Venezuela/Torre Previsora</option>
                    <option value="10.5066887,-66.8519878">Centro Comercial Millenuim</option>
                </select>
            </div>
        </form>
      @else
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="text-info">Código de la Orden: <b class="text-danger">{{ $rutaBuscar->orden_codigo }}</b></h4>
        </div>
        {{-- UBICACIONES POR COORDENADAS --}}
        <div class="d-flex justify-content-start mb-3 selectRuta">
            <div class="form-control text-start bg-transparent text-info" id="coord1" style="margin-right: 10px;">Punto de Origen: Instituto Universitario Jesús Obrero (IUJO)</div>
            <select class="form-select text-info" id="coord2" name="punto_entrega">
              @if ($rutaBuscar->coordenadas_ruta == '10.4866465,-66.9424115')
                <option value="10.4866465,-66.9424115">Punto de Entrega: Urbanización Los Verdes/Paraíso</option>
              @elseif($rutaBuscar->coordenadas_ruta == '10.5,-66.9192749')
                <option value="10.5,-66.9192749">Punto de Entrega: Plaza Venezuela/Torre Previsora</option>
              @else
                <option value="10.5066887,-66.8519878">Punto de Entrega: Centro Comercial Millenuim</option>   
              @endif
            </select>
        </div>
      @endif
        {{-- PARA MOSTRAR EL MAPA CON LA RUTA --}}
		<div class="w-100 my-3 rounded" style="height: 460px;" id="map"></div>
	</div>

@endsection  





