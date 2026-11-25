@extends('layouts.app')


@section('content')
    <div class="booking-page">
        <h1>Registrar Préstamo</h1>

        <a href="{{ route('bikes.show', $bike) }}">Volver a la bicicleta</a>

        <p>Bicicleta: {{ $bike->model }} · Precio por hora: {{ number_format($bike->price_per_hour, 2, ',', '.') }} €</p>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="booking-form" action="{{ route('booking.store') }}" method="POST" data-price-per-hour="{{ $bike->price_per_hour }}">
            @csrf
            <input type="hidden" name="bike_id" value="{{ $bike->id }}">
            <div>
                <label for="start_date">Fecha de Inicio:</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div>
                <label for="end_date">Fecha de Fin:</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
            </div>

            <p>Coste estimado: <output id="cost-estimate" for="start_date end_date" aria-live="polite">Elige las fechas para ver el coste</output></p>

            <button type="submit">Registrar Préstamo</button>
        </form>
    </div>
    
@endsection