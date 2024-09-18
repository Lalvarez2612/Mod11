{{-- MODAL PARA FINALIZAR LA RUTA --}}
<div class="modal fade mt-5" id="exampleModal_3">

    <div class="modal-dialog">
        <div class="modal-content text-info modalRuta">
            <div class="modal-header div1Modal">
                <h4 class="text-danger"><b>Está seguro de entregar esta orden?</b></h3>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="p-3" action="{{ route("asignacion.show") }}" method="POST"> 
                @csrf

                <div class="mb-3 text-center text-info">
                    <h6>Hora Actual: <b id="reloj"></b></h6>
                </div>

                <div class="mb-3 text-start text-info">
                    <label class="form-label"><b>Código de la Orden</b></label>
                    <input id="codigo" type="text" class="form-control bg-transparent text-white"
                    name="tiempo_final" placeholder="O-0000" value="{{ old('tiempo_final') }}">
                </div>

                <div class="mt-2 text-center text-white">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success mx-2">Finalizar Ruta</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>

    // ACTUALIZAR HORA CADA SEGUNDO
    function updateTime() {
        const now = new Date();
        const options = { timeZone: 'America/Caracas', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const timeString = now.toLocaleTimeString('es-VE', options);
        document.getElementById('reloj').textContent = timeString;
    }

    setInterval(updateTime, 1000);

</script>