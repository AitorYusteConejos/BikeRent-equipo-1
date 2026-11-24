<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Bikes') }}
        </h2>
    </x-slot>

    <a href="{{ url('/') }}">Inicio</a>

    <div class="catalog__grid">
        @forelse ($bikes as $bike)
            <x-bike-card :bike="$bike" />
        @empty
            <p>No hay bicicletas disponibles.</p>
        @endforelse
    </div>
</x-app-layout>