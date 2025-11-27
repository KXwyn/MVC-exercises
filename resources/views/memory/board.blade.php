@extends('layouts.app')

@section('title', 'Jugando...')

@section('styles')
<style>
    .game-grid {
        display: grid;
        gap: 15px;
        max-width: 600px;
        margin: 0 auto;
        perspective: 1000px;
    }
    .grid-easy { grid-template-columns: repeat(4, 1fr); }
    .grid-hard { grid-template-columns: repeat(4, 1fr); }

    .memory-card {
        background: transparent;
        height: 100px;
        cursor: pointer;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.6s;
    }
    .memory-card.flipped { transform: rotateY(180deg); }

    .card-face {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .face-front { background: #343a40; color: #adb5bd; transform: rotateY(0deg); } /* Reverso */
    .face-back { background: #fff; transform: rotateY(180deg); border: 2px solid #ffc107; } /* Cara emoji */
    .memory-card.matched .face-back { background: #d1e7dd; border-color: #198754; }
</style>
@endsection

@section('content')
<div class="container text-center">
    <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 600px; margin: 0 auto;">
        <a href="{{ route('memory.index') }}" class="btn btn-outline-secondary">⬅ Abandonar</a>
        <h4 class="mb-0">Movimientos: <span id="movesBadge" class="badge bg-primary">0</span></h4>
    </div>

    <!-- TABLERO -->
    <div class="game-grid {{ $level == 'hard' ? 'grid-hard' : 'grid-easy' }}">
        @foreach ($deck as $icon)
            <div class="memory-card" data-icon="{{ $icon }}" onclick="flipCard(this)">
                <div class="card-face face-front">❓</div>
                <div class="card-face face-back">{{ $icon }}</div>
            </div>
        @endforeach
    </div>

    <!-- Formulario Oculto para ganar -->
    <form id="winForm" action="{{ route('memory.store') }}" method="POST" class="d-none">
        @csrf
        <input type="hidden" name="moves" id="inputMoves">
        <input type="hidden" name="level" value="{{ $level }}">
        <input type="hidden" name="player" id="inputPlayer">
    </form>
</div>
@endsection

@section('scripts')
<script>
    let hasFlippedCard = false;
    let lockBoard = false;
    let firstCard, secondCard;
    let moves = 0;
    let matchedPairs = 0;
    const totalPairs = {{ count($deck) / 2 }};

    function flipCard(card) {
        if (lockBoard) return;
        if (card === firstCard) return; // No clicar la misma dos veces
        if (card.classList.contains('flipped')) return; // Ya volteada

        card.classList.add('flipped');

        if (!hasFlippedCard) {
            hasFlippedCard = true;
            firstCard = card;
            return;
        }

        secondCard = card;
        incrementMoves();
        checkForMatch();
    }

    function incrementMoves() {
        moves++;
        document.getElementById('movesBadge').innerText = moves;
    }

    function checkForMatch() {
        let isMatch = firstCard.dataset.icon === secondCard.dataset.icon;
        isMatch ? disableCards() : unflipCards();
    }

    function disableCards() {
        firstCard.classList.add('matched');
        secondCard.classList.add('matched');

        matchedPairs++;
        if (matchedPairs === totalPairs) {
            setTimeout(endGame, 500);
        }

        resetBoard();
    }

    function unflipCards() {
        lockBoard = true;
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            resetBoard();
        }, 1000);
    }

    function resetBoard() {
        [hasFlippedCard, lockBoard] = [false, false];
        [firstCard, secondCard] = [null, null];
    }

    function endGame() {
        let player = prompt(`¡Ganaste en ${moves} movimientos! \nIngresa tu nombre para guardar el récord:`);
        if (player) {
            document.getElementById('inputMoves').value = moves;
            document.getElementById('inputPlayer').value = player;
            document.getElementById('winForm').submit();
        } else {
            window.location.href = "{{ route('memory.index') }}";
        }
    }
</script>
@endsection
