@extends('layouts.app')

@section('content')
<div class="catalog__grid">
     @forelse ($bikes as $bike)
        <x-bike-card :bike="$bike" />
     @empty
        <p class="catalog__empty">No hay bicicletas disponibles.</p>
    @endforelse
</div>
@endsection