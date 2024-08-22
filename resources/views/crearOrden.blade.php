{{-- VISTA CREAR ORDENES --}}

@extends('layouts/layout_general') {{-- AQUI SE INVOCA AL LAYOUT --}}

@section("Módulo Delivery", "Crear Orden")  {{-- AQUI SE DEFINE EL NOMBRE DE LA PAGINA --}}


@section('Contenido') {{-- AQUI SE INDICA LO QUE PONDREMOS DENTRO DEL LAYOUT --}}

    {{-- FOMRULARIO PARA CREAR ORDEN--}}

    <form class="container formCrearOrden bg-transparent rounded p-5" action="{{ route("ordenes.store") }}" method="POST">
        @csrf

        <div class="d-flex justify-content-between align-items-center container">
            <h4 class="text-info">Ingresa los Datos Solicitados para Crear la Orden</h4>

            {{-- BOTONES DEL FORMULARIO --}}
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-danger mx-3" href="{{ route('ordenes.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-outline-primary">Crear</button>
            </div>

        </div>
        <hr class="text-white">

        {{-- INPUTS DEL FORMULARIO --}}

        <div class="d-flex container">

            <div class="w-100 my-2">

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Cédula del Cliente:</b></label>
                    <input type="number" class="form-control bg-transparent text-white"
                    name="cedula" placeholder="Sin Símbolos" value="{{ old('cedula') }}">
                </div>
                @error('cedula')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Platillos:</b></label>
                    <select class="form-select" name="platillo" id="menu">
                        <option value="" {{ old('platillo') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                        <option value="Hamburgesa Mixta" {{ old('platillo') == 'Hamburgesa Mixta' ? 'selected' : '' }}>Hamburgesa Mixta -> 10$</option>
                        <option value="Pizza Margarita" {{ old('platillo') == 'Pizza Margarita' ? 'selected' : '' }}>Pizza Margarita -> 30$</option>
                        <option value="Ensalada César" {{ old('platillo') == 'Ensalada César' ? 'selected' : '' }}>Ensalada César -> 15$</option>
                        <option value="Tacos de Pollo" {{ old('platillo') == 'Tacos de Pollo' ? 'selected' : '' }}>Tacos de Pollo -> 10$</option>
                        <option value="Sopa de Lentejas" {{ old('platillo') == 'Sopa de Lentejas' ? 'selected' : '' }}>Sopa de Lentejas -> 20$</option>
                    </select>
                </div>
                @error('platillo')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Cantidad:</b></label>
                    <input type="number" class="form-control bg-transparent text-white" placeholder="Cantidad"
                    name="orden_cantidad" id="unidades" value="{{ old('orden_cantidad') }}">
                </div>
                @error('orden_cantidad')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label bg-transparent"><b>Total a Pagar:</b></label>
                    <div class="form-control bg-transparent text-white" id="total">0$</div>
                </div>

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Comentario Adicional:</b></label>
                    <textarea type="text" class="form-control bg-transparent text-white" 
                    placeholder="Máximo 2000 Caracteres" name="comentario_adicional" 
                    rows="6" maxlength="2000">{{ old('comentario_adicional') }}</textarea>
                </div>
                @error('comentario_adicional')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="mb-3 text-info">
                    <label class="form-label"><b>Seleccione el Método de Pago:</b></label>
                    <select class="form-select" name="metodo_pago">
                        <option value="" {{ old('metodo_pago') == '' ? 'selected' : '' }}>Selecciona Uno</option>
                        <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                        <option value="Pago Móvil" {{ old('metodo_pago') == 'Pago Móvil' ? 'selected' : '' }}>Pago Móvil</option>
                    </select>
                </div>
                @error('metodo_pago')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

            </div>

        </div>

    </form>

@endsection    



