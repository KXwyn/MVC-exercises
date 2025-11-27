@extends('layouts.app')

@section('title', 'Cronómetro Online')

@section('styles')
<!-- Fuente digital para el reloj -->
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
    .timer-display {
        font-family: 'Share Tech Mono', monospace;
        font-size: 4rem;
        color: #0d6efd;
        text-shadow: 0 0 10px rgba(13, 110, 253, 0.3);
        letter-spacing: 2px;
    }
    .laps-box {
        max-height: 200px;
        overflow-y: auto;
        border-top: 2px solid #eee;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">

    <!-- CRONÓMETRO -->
    <div class="col-md-5 mb-4">
        <div class="card shadow text-center">
            <div class="card-header bg-dark text-white">⏱️ Cronómetro</div>
            <div class="card-body">

                <!-- Display -->
                <div id="display" class="timer-display my-3">00:00:00.00</div>

                <!-- Controles -->
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <button id="btnStart" class="btn btn-success px-4" onclick="startTimer()">Iniciar</button>
                    <button id="btnPause" class="btn btn-warning px-4" onclick="pauseTimer()" disabled>Pausa</button>
                    <button id="btnLap" class="btn btn-info px-4 text-white" onclick="recordLap()" disabled>Vuelta</button>
                    <button id="btnReset" class="btn btn-danger px-4" onclick="resetTimer()" disabled>Reiniciar</button>
                </div>

                <!-- Vueltas Actuales -->
                <ul id="lapsList" class="list-group list-group-flush laps-box mb-3 text-start small"></ul>

                <!-- Formulario Oculto para Guardar -->
                <form id="saveForm" action="{{ route('timer.store') }}" method="POST" style="display:none">
                    @csrf
                    <input type="hidden" name="duration" id="inputDuration">
                    <input type="hidden" name="laps" id="inputLaps">
                    <button type="button" class="btn btn-primary w-100" onclick="submitSession()">
                        💾 Guardar Sesión
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- HISTORIAL -->
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white">📜 Historial de Tiempos</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($history as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 fw-bold">{{ $item->duration }}</h5>
                                    <small class="text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    @if(count($item->laps) > 0)
                                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#laps-{{ $item->id }}">
                                            Ver {{ count($item->laps) }} vueltas
                                        </button>
                                    @endif

                                    <form action="{{ route('timer.destroy', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm text-danger border-0" onclick="return confirm('¿Borrar?')">✕</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Lista desplegable de vueltas -->
                            @if(count($item->laps) > 0)
                                <div class="collapse mt-2" id="laps-{{ $item->id }}">
                                    <div class="card card-body bg-light p-2 small">
                                        <ul class="mb-0 ps-3">
                                            @foreach($item->laps as $idx => $lap)
                                                <li>Vuelta {{ $idx + 1 }}: {{ $lap }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
                @if($history->isEmpty())
                    <div class="p-4 text-center text-muted">No hay registros guardados.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let startTime, updatedTime, difference, tInterval;
    let running = false;
    let laps = [];

    const display = document.getElementById('display');
    const lapsList = document.getElementById('lapsList');
    const saveForm = document.getElementById('saveForm');

    function startTimer() {
        if(!running){
            startTime = new Date().getTime() - (difference || 0);
            tInterval = setInterval(getShowTime, 10);
            running = true;

            toggleButtons(true);
            saveForm.style.display = 'none';
        }
    }

    function pauseTimer() {
        if (running) {
            clearInterval(tInterval);
            difference = new Date().getTime() - startTime;
            running = false;

            document.getElementById('btnStart').innerText = "Continuar";
            toggleButtons(false);
            saveForm.style.display = 'block';
        }
    }

    function resetTimer() {
        clearInterval(tInterval);
        running = false;
        difference = 0;
        display.innerHTML = "00:00:00.00";
        laps = [];
        lapsList.innerHTML = "";

        document.getElementById('btnStart').innerText = "Iniciar";
        toggleButtons(false, true); // Reset total
        saveForm.style.display = 'none';
    }

    function recordLap() {
        if (running) {
            let current = display.innerHTML;
            laps.push(current);
            let li = document.createElement('li');
            li.className = "list-group-item py-1";
            li.innerText = `🚩 Vuelta ${laps.length}: ${current}`;
            lapsList.prepend(li);
        }
    }

    function getShowTime() {
        updatedTime = new Date().getTime();
        difference = updatedTime - startTime;

        let hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((difference % (1000 * 60)) / 1000);
        let milliseconds = Math.floor((difference % 1000) / 10);

        display.innerHTML =
            (hours < 10 ? "0" + hours : hours) + ':' +
            (minutes < 10 ? "0" + minutes : minutes) + ':' +
            (seconds < 10 ? "0" + seconds : seconds) + '.' +
            (milliseconds < 10 ? "0" + milliseconds : milliseconds);
    }

    function toggleButtons(isRunning, isReset = false) {
        document.getElementById('btnStart').disabled = isRunning;
        document.getElementById('btnPause').disabled = !isRunning;
        document.getElementById('btnLap').disabled = !isRunning;
        document.getElementById('btnReset').disabled = isRunning && !isReset;

        if(isReset) {
            document.getElementById('btnStart').disabled = false;
            document.getElementById('btnPause').disabled = true;
            document.getElementById('btnLap').disabled = true;
            document.getElementById('btnReset').disabled = true;
        }
    }

    function submitSession() {
        document.getElementById('inputDuration').value = display.innerHTML;
        // Enviamos el array como string JSON para que Laravel lo procese
        document.getElementById('inputLaps').value = JSON.stringify(laps);
        document.getElementById('saveForm').submit(); // Enviar formulario real
    }
</script>
@endsection
