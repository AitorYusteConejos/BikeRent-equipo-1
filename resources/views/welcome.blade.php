@extends('layouts.app')

@section('content')
    <div class="landing">
        <!-- Hero -->
        <section class="hero">
            <div class="hero-content">
                <h1>Explora la ciudad sobre ruedas</h1>
                <p>Encuentra, reserva y disfruta de las mejores bicicletas disponibles para tus rutas urbanas o escapadas al aire libre.</p>
                <div class="hero-actions">
                    <a href="{{ route('bikes.index') }}" class="btn-primary">Ver bicicletas</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-secondary">Crear cuenta</a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Características / Ventajas -->
        <section class="features">
            <div class="feature-card">
                <h3>Reserva rápida</h3>
                <p>Consulta la disponibilidad en tiempo real y elige la bicicleta que mejor se adapte a tu recorrido.</p>
            </div>
            <div class="feature-card">
                <h3>Flota variada</h3>
                <p>Desde bicicletas urbanas ligeras hasta modelos de montaña listos para cualquier terreno.</p>
            </div>
            <div class="feature-card">
                <h3>Gestión sencilla</h3>
                <p>Controla tus reservas y tu perfil desde un único lugar de forma cómoda y segura.</p>
            </div>
        </section>
    </div>
@endsection