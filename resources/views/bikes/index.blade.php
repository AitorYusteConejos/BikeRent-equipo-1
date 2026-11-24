<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Catálogo de bicicletas</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
   


    <main class="catalog">
        <div class="catalog__grid">
            @forelse ($bikes as $bike)
                <x-bike-card :bike="$bike" />
            @empty
                <p class="catalog__empty">No hay bicicletas disponibles.</p>
            @endforelse
        </div>
    </main>
</body>
</html>