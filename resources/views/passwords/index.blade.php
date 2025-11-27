@extends('layouts.app')

@section('title', 'Generador de Contraseñas')

@section('styles')
<style>
    .blur-pass { filter: blur(4px); transition: 0.3s; cursor: pointer; }
    .blur-pass:hover { filter: blur(0); }
    .result-box input {
        font-family: monospace; font-size: 1.5rem; letter-spacing: 2px; text-align: center; color: #198754;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h3>🔐 Generador Seguro</h3>
            </div>
            <div class="card-body">

                <!-- Mostrar resultado si existe -->
                @if (session('generated_password'))
                    <div class="mb-4">
                        <label class="form-label text-success fw-bold">¡Contraseña Generada!</label>
                        <div class="input-group result-box">
                            <input type="text" class="form-control" value="{{ session('generated_password') }}" readonly id="passInput">
                            <button class="btn btn-outline-success" onclick="copyToClipboard()">Copiar</button>
                        </div>
                    </div>
                @endif

                <form action="{{ route('passwords.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Longitud: <span id="lenVal" class="fw-bold">12</span></label>
                        <input type="range" name="length" class="form-range" min="6" max="24" value="12"
                               oninput="document.getElementById('lenVal').innerText = this.value">
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="use_upper" checked>
                            <label class="form-check-label">Incluir Mayúsculas (ABC)</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="use_numbers" checked>
                            <label class="form-check-label">Incluir Números (123)</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="use_symbols">
                            <label class="form-check-label">Incluir Símbolos (!@#)</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Generar Contraseña</button>
                </form>
            </div>
        </div>

        <!-- Historial -->
        <div class="mt-4">
            <h5>Historial Reciente (Pasa el mouse para ver)</h5>
            <ul class="list-group">
                @foreach ($history as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="blur-pass bg-light px-2 rounded">{{ $item->password }}</span>
                        <small class="text-muted">{{ $item->length }} chars</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("passInput");
        copyText.select();
        navigator.clipboard.writeText(copyText.value);
        alert("¡Copiado al portapapeles!");
    }
</script>
@endsection
