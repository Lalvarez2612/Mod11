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

  <div class="d-flex container text-info text-center mb-5">
    <div>
        <a href="{{route('ordenes.index')}}" class="btn btn-outline-primary my-1" title="Resumen Ordenes">
            <i class='bx bx-arrow-back'></i>
        </a>
    </div>

    <div class="flex-grow-1">
        <h3>¡Seleciona el Repartidor al que deseas Asignar la Orden!</h3>
    </div>
  </div>

  {{-- MOSTRAMOS LA ORDEN SELECCIONADA --}}

  <div class="d-flex align-items-center flex-column w-100 px-5">

    <div class="cards d-flex align-items-center flex-column text-info w-25">
        <h5>Orden Seleccionada: <b class="text-danger">{{ $ordenAsignar->orden_codigo }}</b></h5>
        <h5>Título: <b class="text-danger">{{ $ordenAsignar->nombre_menu }}</b></h5>
    </div>

    {{-- MOSTRAMOS LOS REPARTIDORES DISPONIBLES --}}

    <div class="w-100 mt-5 mx-2">
        <table class="tabla">
            <thead class="text-danger">
                <tr>
                    <th>Cédula</th>
                    <th>Nombre y Apellido</th>
                    <th>Género</th>
                    <th>Estatus</th>
                    <th>Descripción del Vehículo</th>
                    <th>Asignar</th>
                </tr>
            </thead>
            <tbody class="text-info">
                @foreach ($repartidores as $item)
                    <tr>
                        <td>{{ $item->cedula }}</td>
                        <td>{{ $item->nombre_apellido }}</td>
                        <td>{{ $item->genero }}</td>
                        <td>{{ $item->estatus_repartidor }}</td>
                        <td>{{ $item->vehiculo_descripcion }}</td>
                        <td>
                            <a href="{{route("asignacion.store", 
                                ['id_repartidor' => $item->id_repartidor, 
                                'id_orden' => $ordenAsignar->id_orden])}}" 
                                class="btn btn btn-outline-info" title="Asignar">
                                <i class='bx bxs-user-check' ></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  </div>

@endsection    


