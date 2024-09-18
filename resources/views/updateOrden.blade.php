{{-- VISTA CREAR ORDENES --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Actualizar una Orden")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    {{-- FOMRULARIO PARA CREAR ORDEN--}}

    <form class="container formCrearOrden rounded mb-5 p-5" action="{{ route("ordenes.update", $updateOrden->id_orden) }}" 
        method="POST">
        @csrf
        @method("PUT")

        <div class="d-flex justify-content-between align-items-center container">
            <h4 class="text-info">Actualización de la Orden: <b class="text-danger">{{$updateOrden->orden_codigo}}</b></h4>

            

        </div>
        <hr class="text-white">

        {{-- INPUTS DEL FORMULARIO --}}

        <div class="d-flex container">

            <div class="w-100 my-2">

                <div class="mb-3">
                    <label class="form-label text-info"><b>Cédula del Cliente:</b></label>
                    <input type="number" class="form-control bg-transparent text-white"
                    name="cedula" placeholder="Sin Símbolos" value="{{ $updateOrden->cedula }}">
                </div>
                @error('cedula')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div id="selectContainer" class="epa mb-3 text-info ">
                    <div class="mb-5">
                    <h4><b>Pedidos:</b></h5>
                    <label class="form-label"><h5>Plato:</h5></label>
                    <select id="selP" class="dynamic-select form-select mb-3" name="platillo[]" id="seleccion">
                        <option class="option" value="" {{ old('platillo') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                        @foreach ($platillos as $platillo)
                        <option class="option" value="{{$platillo->id_menu}}" data-precio="{{$platillo->precio_menu}}" {{ old('platillo') == $platillo->id_menu ? 'selected' : '' }}>{{$platillo->nombre_menu}} -> {{$platillo->precio_menu}}$</option>
                        @endforeach
                    </select>
                    
                    @error('platillo')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Cantidad:</b></label>
                    <input type="number" class="unidades form-control bg-transparent text-white" placeholder="Cantidad"
                    name="orden_cantidad[]" id="unidadesP" value="{{ old('orden_cantidad[0]') }}">
                </div>
                @error('orden_cantidad')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label bg-transparent"><b>Precio unitario:</b></label>
                    <div class="precioU form-control bg-transparent text-white" id="precioU">0.00$</div>
                </div>

                
                </div>
                <hr class="blanco">

                {{-- <div class="mb-5 rem-0">
                    <label class="form-label block"><h5>Plato:</h5></label>
                    <select name="platillo[]" class="border block form-select mb-3 dynamic-select">
                        <option value="" class="option" data-precio="null">Selecciona Uno</option>
                        <option value="1" class="option" data-precio="10">Hamburguesa Mixta -&gt; 10$</option>
                        <option value="2" class="option" data-precio="30">Pizza Margarita -&gt; 30$</option>
                        <option value="3" class="option" data-precio="15">Ensalada César -&gt; 15$</option>
                        <option value="4" class="option" data-precio="10">Tacos de Pollo -&gt; 10$</option>
                        <option value="5" class="option" data-precio="20">Sopa de Lentejas -&gt; 20$</option>
                    </select>
                    <div class="text-info mb-3">
                        <label class="form-label block"><b>Cantidad</b></label>
                        <input class="unidades form-control bg-transparent text-white" name="orden_cantidad[]" placeholder="Cantidad" type="number"></div>
                        <div class="text-info mb-3"><label class="form-label block"><b>Precio unitario</b></label>
                            <div class="precioU form-control bg-transparent text-white">0$</div></div>
                            <button id="rem-0" type="button" class="removeSelectBtn btn btn-outline-primary remo mb-4">quitar plato</button>
                            <hr class="blanco">
                        </div> --}}

                </div>
                
                <button type="button" id="addSelectBtn" class="btn btn-outline-primary tuqui mb-4">Agregar Plato</button>

                <div class="mb-3 text-info">
                    <label class="form-label bg-transparent"><b>Total a Pagar:</b></label>
                    <div class="form-control bg-transparent text-white" id="total">0.00$</div>
                </div>

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Comentario Adicional:</b></label>
                    <textarea type="text" class="form-control bg-transparent text-white" 
                    placeholder="Máximo 2000 Caracteres" name="comentario_adicional" 
                    rows="6" maxlength="2000">{{ $updateOrden->comentario_adicional }}</textarea>
                </div>
                @error('comentario_adicional')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Seleccione el Método de Pago:</b></label>
                    <select class="form-select" name="metodo_pago">
                        <option value="Transferencia" {{ $updateOrden->nombre_metodo == 'Transferencia' ? 'selected' : ''}}>Transferencia</option>
                        <option value="Pago Móvil" {{ $updateOrden->nombre_metodo == 'Pago Móvil' ? 'selected' : '' }}>Pago Móvil</option>
                    </select>
                </div>
                @error('metodo_pago')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror


                {{-- BOTONES DEL FORMULARIO --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-danger mx-3" href="{{ route('ordenes.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-outline-primary">Actualizar</button>
            </div>

            </div>
        </div>
    </form>

@endsection    




