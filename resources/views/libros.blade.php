@extends('layouts.base')

@section('title', 'Libros')

@section('content')

{{--imágenes sin distorsión--}}
<style>
.card-image img {
    width: 75%;   /* 25% más pequeña */
    height: auto;
    object-fit: cover;
    border-radius: 6px;
    margin: 0 auto; /* centra la imagen */
    display: block;
}

/* 🔹 Reduce toda la card al 75% (25% más pequeña) */
.card {
    transform: scale(0.75);
    transform-origin: top center;
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

<h1 class="title has-text-centered mt-5">Libros</h1>
<p class="subtitle has-text-centered">Encuentra los mejores libros de terror de Stephen King 📖💀</p>

@php
    $libros = [
        (object)[ 'nombre' => 'It (Eso)', 'imagen' => asset('images/it_stephenking.jpg'), 'ruta' => '#' ],
        (object)[ 'nombre' => 'El Resplandor (The Shining)', 'imagen' => asset('images/the_shining.jpg'), 'ruta' => '#' ],
        (object)[ 'nombre' => 'Cementerio de animales (Pet Sematary)', 'imagen' => asset('images/pet_sematary.jpg'), 'ruta' => '#' ],
        (object)[ 'nombre' => 'Misery', 'imagen' => asset('images/misery.jpg'), 'ruta' => '#' ],
        (object)[ 'nombre' => 'Carrie', 'imagen' => asset('images/carrie.jpg'), 'ruta' => '#' ],
    ];
@endphp

{{--libros--}}
<div class="columns is-multiline is-mobile mt-5" id="contenedorLibros">
    @foreach ($libros as $libro)
        <div class="column is-one-quarter-desktop is-half-tablet is-half-mobile producto">
            <a href="{{ $libro->ruta }}">
                <div class="card is-shadowless">
                    <div class="card-image">
                        <figure class="image">
                            <img src="{{ $libro->imagen }}" alt="{{ $libro->nombre }}">
                        </figure>
                    </div>
                    <div class="card-content has-text-centered">
                        <p class="title is-6 nombre-producto">{{ $libro->nombre }}</p>
                        <p class="is-size-7 has-text-grey mt-1">Ver detalles</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
// 🔹 Buscador global
document.addEventListener('DOMContentLoaded', () => {
    const textoBuscado = localStorage.getItem('busquedaGlobal');
    if (!textoBuscado) return;

    const productos = document.querySelectorAll('.nombre-producto');

    productos.forEach(p => {
        const nombre = p.innerText.toLowerCase();
        const card = p.closest('.producto, .juego, .libro, .column');

        card.style.display = nombre.includes(textoBuscado) ? 'block' : 'none';
    });

    localStorage.removeItem('busquedaGlobal');
});
</script>

<script>
// 🔹 Registro local + filtrado si vienes del buscador
document.addEventListener('DOMContentLoaded', () => {

    const productosLocales = [];
    const items = document.querySelectorAll('.nombre-producto');

    const rutaActual = window.location.pathname;
    let categoria = 'productos';
    if (rutaActual.includes('juegos')) categoria = 'juegos';
    if (rutaActual.includes('libros')) categoria = 'libros';

    items.forEach(i => {
        productosLocales.push({
            nombre: i.innerText.trim(),
            categoria: categoria,
            ruta: window.location.href
        });
    });

    const listaGlobal = JSON.parse(localStorage.getItem('listaProductosGlobal') || '[]');
    const nombresExistentes = listaGlobal.map(p => p.nombre);
    const nuevos = productosLocales.filter(p => !nombresExistentes.includes(p.nombre));
    const actualizada = [...listaGlobal, ...nuevos];
    localStorage.setItem('listaProductosGlobal', JSON.stringify(actualizada));

    const textoBuscado = localStorage.getItem('busquedaGlobal');
    if (textoBuscado) {
        items.forEach(i => {
            const nombre = i.innerText.toLowerCase();
            const card = i.closest('.producto, .juego, .libro, .column');

            card.style.display = nombre.includes(textoBuscado) ? 'block' : 'none';
        });
        localStorage.removeItem('busquedaGlobal');
    }
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
