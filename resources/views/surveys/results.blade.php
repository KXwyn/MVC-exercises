@extends('layouts.app')
@section('title', 'Resultados')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-white text-center">
                <h4>{{ $survey->question }}</h4>
                <span class="badge bg-secondary">Total Votos: {{ $totalVotes }}</span>
            </div>
            <div class="card-body">
                @foreach($survey->options as $opt)
                    @php
                        $percent = $totalVotes > 0 ? round(($opt->votes / $totalVotes) * 100) : 0;
                        $color = $percent > 50 ? 'success' : 'primary';
                    @endphp

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>{{ $opt->text }}</span>
                            <span class="fw-bold">{{ $percent }}% ({{ $opt->votes }})</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-{{ $color }}" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 text-center">
                    <a href="{{ route('surveys.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
