@extends('layouts.base')

@section('title', 'Inicio')

@section('content')

<section class="hero custom-banner">
    <div class="hero-body has-text-centered">
        <p class="title">Bienvenidos a videojuegos y cosas geek</p>
        <p class="subtitle">Explora productos, juegos y libros geek 🎮📚</p>
    </div>
</section>

{{-- Tabs de navegación --}}
<div class="tabs is-centered is-toggle is-toggle-rounded mt-5">
    <ul>
        <li><a>Catálogo</a></li>
        <li><a>Ofertas</a></li>
        <li><a>Coleccionables</a></li>
        <li><a>Reventas</a></li>
        <li><a>Suscripciones</a></li>
    </ul>
</div>

{{-- Banner principal --}}
<div class="box has-text-centered">
    <figure class="image is-3by1">
        <img class="zoom-target" src="{{ asset('images/productomasvendido.jpg') }}" alt="Producto destacado">
    </figure>
    <div class="mt-2">
        <button class="button is-small">◀</button>
        <button class="button is-small">▶</button>
    </div>
</div>

{{-- Lo más comprado --}}
<h2 class="title is-4 mt-6">Lo más comprado</h2>
<div class="columns is-multiline is-mobile" id="contenedorProductos">

    <div class="column is-one-fifth producto">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img class="zoom-target" src="{{ asset('images/PS5.jpg') }}" alt="PS5">
                </figure>
            </div>
            <div class="card-content has-text-centered">
                <p class="title is-6 nombre-producto">PlayStation 5</p>
            </div>
        </div>
    </div>

    <div class="column is-one-fifth producto">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img class="zoom-target" src="{{ asset('images/xboxblanco.jpg') }}" alt="Xbox">
                </figure>
            </div>
            <div class="card-content has-text-centered">
                <p class="title is-6 nombre-producto">Xbox Series X Blanca</p>
            </div>
        </div>
    </div>

    <div class="column is-one-fifth producto">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img class="zoom-target" src="{{ asset('images/xmandogris.jpg') }}" alt="Mando Xbox Gris">
                </figure>
            </div>
            <div class="card-content has-text-centered">
                <p class="title is-6 nombre-producto">Mando Xbox Gris</p>
            </div>
        </div>
    </div>

    <div class="column is-one-fifth producto">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img class="zoom-target" src="{{ asset('images/Nswitch.jpg') }}" alt="Nintendo Switch">
                </figure>
            </div>
            <div class="card-content has-text-centered">
                <p class="title is-6 nombre-producto">Nintendo Switch</p>
            </div>
        </div>
    </div>

    <div class="column is-one-fifth producto">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img class="zoom-target" src="{{ asset('images/Psaudifonos.jpg') }}" alt="Audífonos PS5">
                </figure>
            </div>
            <div class="card-content has-text-centered">
                <p class="title is-6 nombre-producto">Audífonos PS5</p>
            </div>
        </div>
    </div>

</div>

{{-- Botón conocenos --}}
<div class="has-text-centered mt-6 mb-6">
    <a href="{{ route('nosotros') }}" class="button is-link is-medium">Conócenos</a>
</div>

{{-- FAQ --}}
<section class="section mt-6">
    <h2 class="title has-text-centered">Preguntas Frecuentes ❓</h2>

    <div class="container" style="max-width: 700px; margin: 0 auto;">

        {{-- Pregunta 1 --}}
        <div id="pregunta1" class="faq-pregunta box is-clickable">
            <p class="has-text-weight-semibold">¿Cuáles son los métodos de pago disponibles?</p>
        </div>
        <div id="respuesta1" class="faq-respuesta box hidden">
            <p>Aceptamos tarjetas de crédito, débito y pagos mediante PayPal.</p>
        </div>

        {{-- Pregunta 2 --}}
        <div id="pregunta2" class="faq-pregunta box is-clickable mt-3">
            <p class="has-text-weight-semibold">¿Hacen envíos internacionales?</p>
        </div>
        <div id="respuesta2" class="faq-respuesta box hidden">
            <p>Sí, enviamos a varios países. Los costos dependen del destino.</p>
        </div>

        {{-- Pregunta 3 --}}
        <div id="pregunta3" class="faq-pregunta box is-clickable mt-3">
            <p class="has-text-weight-semibold">¿Puedo devolver un producto?</p>
        </div>
        <div id="respuesta3" class="faq-respuesta box hidden">
            <p>Claro, las devoluciones son válidas hasta 15 días después de recibir el producto.</p>
        </div>

    </div>
</section>

{{-- FAQ Script --}}
<script>
function mostrarOcultar(id) {
    const respuesta = document.getElementById('respuesta' + id);
    respuesta.classList.toggle('hidden');
}

for (let i = 1; i <= 3; i++) {
    const pregunta = document.getElementById('pregunta' + i);
    pregunta.addEventListener('click', () => mostrarOcultar(i));
}
</script>

{{-- ESTILOS --}}
<style>
.hidden {
    display: none !important;
}

.is-clickable {
    cursor: pointer;
}

.faq-pregunta {
    background-color: #001f3f !important; 
    color: white !important;
    border: none;
    transition: background-color 0.3s;
}

.faq-pregunta:hover {
    background-color: #003366 !important;
}

.faq-respuesta {
    background-color: #c886eeff !important; 
    color: white !important;
    border: none;
}

/* efecto zoom y rotacion */
.zoom-effect {
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.zoom-effect:hover {
    transform: scale(1.12) rotate(3deg);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.30);
}
</style>

{{-- JS para agregar zoom --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const imagenes = document.querySelectorAll('.zoom-target');

    imagenes.forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.classList.add('zoom-effect');
        });

        img.addEventListener('mouseleave', () => {
            img.classList.remove('zoom-effect');
        });
    });
});
</script>

{{--Script del buscador--}}
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

@endsection
