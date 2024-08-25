{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Rutas Asignadas")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

  {{-- ALERTA CUANDO HAY UN REGISTRO EXITOSO --}}
  @if ($mensaje = Session::get('success'))
      <div class="alert alert-info text-center container w-50" role="alert">
          {{$mensaje}}
      </div>
  @endif

  {{-- ALERTA PARA ERRORES AL MOMENTO DE INGRESAR EL CODIGO DE LA ORDEN O LA FECHA DE ASIGNACION--}}

  @if ($errors->any())
    <div class="container alert alert-danger text-center w-50" role="alert">
      @foreach ($errors->all() as $error)
          {{ $error }} <br>
      @endforeach
    </div>
  @endif

  {{--  ESTRCUTURA DE LA VISTA --}}
  <div class="d-flex align-items-center flex-column w-100 px-5">

    <div class="w-100">
      @if ($bolean == TRUE)
        <h4 class="text-center text-info mb-3">Ordenes Asignadas y Sus Rutas</h4>
      @else
        <div class="d-flex">
          <div>
            <a href="{{route('rutas.index')}}" class="btn btn-outline-primary" title="Resumen Rutas">
                <i class='bx bx-arrow-back'></i>
            </a>
          </div>

          <div class="flex-grow-1">
            <h4 class="text-center text-info mb-5">¡Ruta Encontrada con Éxito!</h4>
          </div>
        </div>     
      @endif
      <button class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal_3">Finalizar una Ruta y Registrar la Entrega</button>

      {{-- FORMULARIO PARA BUSCAR POR CODIGO O POR FECHA DE ASIGNACION --}}
      <form class="d-flex formBuscar mb-3" action="{{ route("asignacion.findCodigo") }}" method="POST">
          @csrf
          <input type="text" class="form-control bg-transparent text-info me-2"
              placeholder="Buscar por Ruta por Código de la Orden" name="buscarCodigo" value="{{ old('buscarCodigo') }}">
          <input type="date" class="form-control bg-transparent text-info me-2" name="fecha_asignacion" value="{{ old('fecha_asignacion') }}">
          <button class="btn btn-outline-primary" type="submit">
              <i class='bx bx-search-alt-2'></i>
          </button>
      </form>

    </div>
  
    {{-- MOSTRAMOS LAS ORDENES ASIGNADAS --}}
  
    <div class="w-100 mx-2">
      <table class="tabla mb-4">
          <thead class="text-danger">
              <tr>
                  <th>Cédula del Repartidor</th>
                  <th>Nombre y Apellido</th>
                  <th>Descripción del Vehículo</th>
                  <th>Código de la Orden</th>
                  <th>Destino de la Orden</th>
                  <th>Fecha de Asignación</th>
                  <th>Inicio de la Ruta</th>
                  <th>Fin de la Ruta</th>
                  <th>Ver Ruta</th>
              </tr>
          </thead>
          <tbody class="text-info">
            @if ($bolean == TRUE)
              @foreach ($rutaRepartidor as $item)
                <tr>
                  <td>{{ $item->cedula }}</td>
                  <td>{{ $item->nombre_apellido }}</td>
                  <td>{{ $item->vehiculo_descripcion }}</td>
                  <td>{{ $item->orden_codigo }}</td>
                  <td>{{ $item->direccion }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->fecha_asignacion)->format('d/m/Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tiempo_inicio)->format('h:i A') }}</td>
                  @if ($item->tiempo_final == NULL)
                    <td>Por Definir</td>
                  @else
                    <td>{{ \Carbon\Carbon::parse($item->tiempo_final)->format('h:i A') }}</td>
                  @endif
                  <td>
                    <a href="{{route("asignacion.findRuta",$item->id_ruta)}}" class="btn btn-outline-info" title="Ver Ruta">
                      <i class='bx bx-current-location'></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            @else
              @foreach ($rutaRepartidor as $item)
                <tr>
                  <td>{{ $item->cedula }}</td>
                  <td>{{ $item->nombre_apellido }}</td>
                  <td>{{ $item->vehiculo_descripcion }}</td>
                  <td>{{ $item->orden_codigo }}</td>
                  <td>{{ $item->direccion }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->fecha_asignacion)->format('d/m/Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tiempo_inicio)->format('h:i A') }}</td>
                  @if ($item->tiempo_final == NULL)
                    <td>Por Definir</td>
                  @else
                    <td>{{ \Carbon\Carbon::parse($item->tiempo_final)->format('h:i A') }}</td>
                  @endif
                  <td>
                    <a href="{{route("asignacion.findRuta",$item->id_ruta)}}" class="btn btn-outline-info" title="Ver Ruta">
                      <i class='bx bx-current-location'></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
      </table>
    </div>

  </div>

  {{-- MODAL PARA FINALIZAR LA RUTA DE LA ORDEN --}}
  <x-ModalFinRuta/>
@endsection    



