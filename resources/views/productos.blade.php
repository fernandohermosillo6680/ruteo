@extends('layouts.base')

@section('title', 'Nuestra Colección de Productos')

@section('content')

@php
    // Datos agrupados por categoría
    $productos_por_categoria = [
        'xbox' => [
            (object)['nombre' => 'Consola Xbox Blanco', 'imagen' => asset('images/xboxblanco.jpg')],
            (object)['nombre' => 'Audífonos Xbox', 'imagen' => asset('images/xaudifonos.jpg')],
            (object)['nombre' => 'Mando Xbox Gris', 'imagen' => asset('images/xmandogris.jpg')],
            (object)['nombre' => 'Mando Xbox Verde', 'imagen' => asset('images/xmandoverde.jpg')],
            (object)['nombre' => 'Halo Infinite', 'imagen' => asset('images/halo_infinite.jpg')],
        ],
        'playstation' => [
            (object)['nombre' => 'Playstation 5', 'imagen' => asset('images/PS5.jpg')],
            (object)['nombre' => 'Mando PS5', 'imagen' => asset('images/ps5mando.jpg')],
            (object)['nombre' => 'Audífonos PS', 'imagen' => asset('images/Psaudifonos.jpg')],
            (object)['nombre' => 'God of War: Ragnarök', 'imagen' => asset('images/gow_ragnarok.jpg')],
            (object)['nombre' => 'Spider-Man 2', 'imagen' => asset('images/spiderman2.jpg')],
        ],
        'nintendo' => [
            (object)['nombre' => 'Nintendo Switch', 'imagen' => asset('images/Nswitch.jpg')],
            (object)['nombre' => 'Joystick Nintendo', 'imagen' => asset('images/Nstick.jpg')],
            (object)['nombre' => 'Nintendo Switch Lite', 'imagen' => asset('images/Nlite.jpg')],
            (object)['nombre' => 'Super Mario Odyssey', 'imagen' => asset('images/mario_odyssey.jpg')],
            (object)['nombre' => 'Zelda: Tears of the Kingdom', 'imagen' => asset('images/zelda_totk.jpg')],
        ],
        'libros' => [
            (object)['nombre' => 'It (Eso)', 'imagen' => asset('images/it_stephenking.jpg')],
            (object)['nombre' => 'El Resplandor', 'imagen' => asset('images/the_shining.jpg')],
            (object)['nombre' => 'Cementerio de animales', 'imagen' => asset('images/pet_sematary.jpg')],
            (object)['nombre' => 'Misery', 'imagen' => asset('images/misery.jpg')],
            (object)['nombre' => 'Carrie', 'imagen' => asset('images/carrie.jpg')],
        ],
    ];
@endphp

<h1 class="title has-text-centered">Catálogo General</h1>
<p class="subtitle has-text-centered">Filtra por categoría o usa el buscador de arriba 🔍</p>

{{-- MENÚ DE FILTRO --}}
<div class="buttons is-centered mb-5">
    <button id="btn-todos" data-categoria="todos" class="button is-dark">Todos</button>
    <button id="btn-xbox" data-categoria="xbox" class="button is-link">Xbox</button>
    <button id="btn-playstation" data-categoria="playstation" class="button is-primary">PlayStation</button>
    <button id="btn-nintendo" data-categoria="nintendo" class="button is-danger">Nintendo</button>
    <button id="btn-libros" data-categoria="libros" class="button is-warning">Libros</button>
</div>

{{-- IMÁGENES SIN DISTORSIÓN --}}
<style>
.card-image img {
    width: 100%;
    height: auto; 
    object-fit: contain;
    max-height: 150px; 
    border-radius: 6px;
    background-color: #f5f5f5; 
}

/* ★★★ EFECTO ZOOM + ROTACIÓN ★★★ */
.zoom-rotate {
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.zoom-rotate:hover {
    transform: scale(1.12) rotate(3deg);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.30);
}
</style>

{{-- PRODUCTOS --}}
<div id="contenedor-productos" class="columns is-multiline is-mobile">
    @foreach ($productos_por_categoria as $categoria => $productos)
        @foreach ($productos as $item)
            <div class="column is-one-quarter-desktop is-half-tablet is-half-mobile producto {{ $categoria }}">
                <div class="card is-shadowless">
                    <div class="card-image">
                        <figure class="image">
                            <img src="{{ $item->imagen }}" alt="{{ $item->nombre }}">
                        </figure>
                    </div>
                    <div class="card-content has-text-centered">
                        <p class="title is-6 nombre-producto">{{ $item->nombre }}</p>
                        <p class="is-size-7 has-text-grey mt-1">Categoría: {{ ucfirst($categoria) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

{{-- FILTROS --}}
<script>
function filtrarProductos(categoria) {
    const productos = document.getElementsByClassName('producto');

    for (let i = 0; i < productos.length; i++) {
        const producto = productos[i];
        if (categoria === 'todos' || producto.classList.contains(categoria)) {
            producto.classList.remove('is-hidden');
        } else {
            producto.classList.add('is-hidden');
        }
    }
}

document.getElementById('btn-todos').addEventListener('click', function() { filtrarProductos('todos'); });
document.getElementById('btn-xbox').addEventListener('click', function() { filtrarProductos('xbox'); });
document.getElementById('btn-playstation').addEventListener('click', function() { filtrarProductos('playstation'); });
document.getElementById('btn-nintendo').addEventListener('click', function() { filtrarProductos('nintendo'); });
document.getElementById('btn-libros').addEventListener('click', function() { filtrarProductos('libros'); });
</script>

{{-- BUSCADOR --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const textoBuscado = localStorage.getItem('busquedaGlobal');
    if (!textoBuscado) return;

    const productos = document.querySelectorAll('.nombre-producto');

    productos.forEach(p => {
        const nombre = p.innerText.toLowerCase();
        const card = p.closest('.producto');
        card.style.display = nombre.includes(textoBuscado) ? 'block' : 'none';
    });

    localStorage.removeItem('busquedaGlobal');
});
</script>

{{-- REGISTRO Y FILTRO GLOBAL --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const productosLocales = [];
    const items = document.querySelectorAll('.nombre-producto');

    let categoria = 'productos';
    const rutaActual = window.location.pathname;
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
            const card = i.closest('.producto');
            card.style.display = nombre.includes(textoBuscado) ? 'block' : 'none';
        });
        localStorage.removeItem('busquedaGlobal');
    }
});
</script>

{{-- ★★★ EFECTO ZOOM + ROTACIÓN (JS) ★★★ --}}
<script>
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
