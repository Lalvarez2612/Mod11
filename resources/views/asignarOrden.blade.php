{{-- VISTA PEDIDOS RESUMEN --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Asignar Orden")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

  <div class="d-flex justify-content-between align-items-center px-5 mb-3">
    <div style="margin-right: 20px;">
        <a href="{{route('ordenes.index')}}" class="btn btn-outline-primary my-1" title="Resumen Ordenes">
            <i class='bx bx-arrow-back'></i>
        </a>
    </div>
    <div class="w-100 text-center text-info">
        <h4>¡Seleciona un Repartidor para Crear una Ruta y Asignar la Orden!</h4>
    </div>
  </div>
  <hr class="text-white mx-3">

  {{-- MOSTRAMOS LA ORDEN SELECCIONADA --}}
  <div class="d-flex align-items-center flex-column w-100 px-5">
    <div class="text-center text-info">
        <h5>Orden Seleccionada: <b class="text-danger">{{ $ordenAsignar->orden_codigo }}</b></h5>
         <h5>Cliente: <b class="text-danger">{{ $ordenAsignar->nombre }}</b></h5> 
    </div>

    {{-- MOSTRAMOS LOS REPARTIDORES DISPONIBLES --}}
    <div class="w-100 mt-3 mx-2">
        <table class="tabla">
            <thead class="text-danger">
                <tr>
                    <th>Cédula</th>
                    <th>Nombre y Apellido</th>
                    <th>Género</th>
                    <th>Estatus</th>
                    <th>Descripción del Vehículo</th>
                    <th>Crear Ruta</th>
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
                            <a href="{{route("asignacion.crearRuta", ['id_repartidor' => $item->id_repartidor, 'id_orden' => $ordenAsignar->id_orden])}}" 
                                class="btn btn btn-outline-info" title="Crear Ruta">
                                <i class='bx bxs-location-plus'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  </div>

@endsection    


