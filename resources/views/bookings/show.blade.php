@extends('layouts.app')

@section('content')
<div class="booking-detail">
    <div class="booking-detail__header">
        <h1>Detalles de la reserva</h1>
        <a href="{{ route('booking.index') }}" class="booking-detail__back">Volver a mis reservas</a>
    </div>

    <div class="booking-detail__card">
        <p><strong>Bicicleta:</strong> {{ $booking->bike->model }}</p>
        <p><strong>Usuario:</strong> {{ $booking->user->name }}</p>
        <p><strong>Fecha de inicio:</strong> {{ $booking->start_date->format('d/m/Y H:i') }}</p>
        <p><strong>Fecha de fin:</strong> {{ $booking->end_date->format('d/m/Y H:i') }}</p>
        <p><strong>Precio total:</strong> {{ number_format($booking->total_cost, 2, ',', '.') }} €</p>

        <p>
            <strong>Estado:</strong>
            @if ($booking->status === 'pending')
                <span class="booking-detail__status booking-detail__status--pending">Pendiente</span>
            @elseif ($booking->status === 'active')
                <span class="booking-detail__status booking-detail__status--active">Activa</span>
            @elseif ($booking->status === 'completed')
                <span class="booking-detail__status">Completada</span>
            @else
                <span class="booking-detail__status booking-detail__status--cancelled">Cancelada</span>
            @endif
        </p>

        @if ($booking->status === 'pending')
            <form action="{{ route('booking.cancel', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="booking-detail__cancel">Cancelar reserva</button>
            </form>
        @endif
    </div>
</div>
@endsection