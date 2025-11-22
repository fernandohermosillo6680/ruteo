@extends('layouts.base')

@section('title', 'Juegos')

@section('content')

<style>
.card-image img {
    width: 100%;
    height: 200px;
    object-fit: contain; 
    border-radius: 6px;
}

/* ---- EFECTO ZOOM + ROTACIÓN ---- */
.zoom-rotate {
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.zoom-rotate:hover {
    transform: scale(1.12) rotate(3deg);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.30);
}
</style>

<h1 class="title has-text-centered mt-5">Juegos</h1>
<p class="subtitle has-text-centered">Explora nuestra colección de videojuegos populares 🎮</p>

<div class="buttons is-centered mb-5">
    <button id="btn-todos" data-categoria="todos" class="button is-dark">Todos</button>
    <button id="btn-nintendo" data-categoria="nintendo" class="button is-danger">Nintendo</button>
    <button id="btn-playstation" data-categoria="playstation" class="button is-primary">PlayStation</button>
    <button id="btn-xbox" data-categoria="xbox" class="button is-link">Xbox</button>
</div>

@php
    $juegos = [
        (object)['nombre' => 'The Legend of Zelda: Tears of the Kingdom', 'imagen' => asset('images/zelda_totk.jpg'), 'ruta' => '#', 'categoria' => 'nintendo'],
        (object)['nombre' => 'God of War: Ragnarök', 'imagen' => asset('images/gow_ragnarok.jpg'), 'ruta' => '#', 'categoria' => 'playstation'],
        (object)['nombre' => 'Halo Infinite', 'imagen' => asset('images/halo_infinite.jpg'), 'ruta' => '#', 'categoria' => 'xbox'],
        (object)['nombre' => 'Spider-Man 2', 'imagen' => asset('images/spiderman2.jpg'), 'ruta' => '#', 'categoria' => 'playstation'],
        (object)['nombre' => 'Super Mario Odyssey', 'imagen' => asset('images/mario_odyssey.jpg'), 'ruta' => '#', 'categoria' => 'nintendo'],
        (object)['nombre' => 'Elden Ring', 'imagen' => asset('images/elden_ring.jpg'), 'ruta' => '#', 'categoria' => 'playstation'],
        (object)['nombre' => 'Cyberpunk 2077', 'imagen' => asset('images/cyberpunk2077.jpg'), 'ruta' => '#', 'categoria' => 'playstation'],
        (object)['nombre' => 'Resident Evil 4 Remake', 'imagen' => asset('images/re4_remake.jpg'), 'ruta' => '#', 'categoria' => 'playstation'],
    ];
@endphp

<div id="contenedor-juegos" class="columns is-multiline is-mobile mt-5">
    @foreach ($juegos as $juego)
        <div class="column is-one-quarter-desktop is-half-tablet is-half-mobile juego producto {{ $juego->categoria }}">
            <a href="{{ $juego->ruta }}">
                <div class="card is-shadowless">
                    <div class="card-image">
                        <figure class="image">
                            <img src="{{ $juego->imagen }}" alt="{{ $juego->nombre }}">
                        </figure>
                    </div>
                    <div class="card-content has-text-centered">
                        <p class="title is-6 nombre-producto">{{ $juego->nombre }}</p>
                        <p class="is-size-7 has-text-grey mt-1">Categoría: {{ ucfirst($juego->categoria) }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
    // 🔹 FILTRO POR CATEGORÍA
    function filtrarJuegos(categoria) {
        const juegos = document.getElementsByClassName('juego');

        for (let i = 0; i < juegos.length; i++) {
            const juego = juegos[i];
            if (categoria === 'todos' || juego.classList.contains(categoria)) {
                juego.classList.remove('is-hidden');
            } else {
                juego.classList.add('is-hidden');
            }
        }
    }

    document.getElementById('btn-todos').addEventListener('click', () => filtrarJuegos('todos'));
    document.getElementById('btn-nintendo').addEventListener('click', () => filtrarJuegos('nintendo'));
    document.getElementById('btn-playstation').addEventListener('click', () => filtrarJuegos('playstation'));
    document.getElementById('btn-xbox').addEventListener('click', () => filtrarJuegos('xbox'));
</script>

<script>
// 🔹 Buscador global
document.addEventListener('DOMContentLoaded', () => {
    const textoBuscado = localStorage.getItem('busquedaGlobal');
    if (!textoBuscado) return;

    const productos = document.querySelectorAll('.nombre-producto');

    productos.forEach(p => {
        const nombre = p.innerText.toLowerCase();
        const card = p.closest('.producto, .juego, .libro, .column');

        if (nombre.includes(textoBuscado)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    localStorage.removeItem('busquedaGlobal');
});
</script>

<script>
// 🔹 EFECTO ZOOM + ROTACIÓN PARA IMÁGENES
document.addEventListener('DOMContentLoaded', () => {
    const imagenes = document.querySelectorAll('.card-image img');

    imagenes.forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.classList.add('zoom-rotate');
        });

        img.addEventListener('mouseleave', () => {
            img.classList.remove('zoom-rotate');
        });
    });
});
</script>

@endsection
