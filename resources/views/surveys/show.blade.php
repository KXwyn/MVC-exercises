@extends('layouts.app')
@section('title', 'Votar')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title mb-4">{{ $survey->question }}</h3>

                <form action="{{ route('surveys.vote', $survey) }}" method="POST">
                    @csrf
                    <div class="list-group mb-4">
                        @foreach($survey->options as $opt)
                            <label class="list-group-item list-group-item-action">
                                <input class="form-check-input me-1" type="radio" name="option_id" value="{{ $opt->id }}" required>
                                {{ $opt->text }}
                            </label>
                        @endforeach
                    </div>
                    <button class="btn btn-success w-100">Enviar Voto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
