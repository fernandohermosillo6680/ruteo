@extends('layouts.base')

@section('title', 'Sobre Nosotros')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Sobre Nosotros</h1>

            {{-- Sección Cosas Geek + Quiénes somos --}}
            <div class="columns is-vcentered mt-5">
                <div class="column is-half has-text-centered">
                    <figure class="image is-3by2">
                       <img src="{{ asset('images/nosotrosxd.jpg') }}" alt="Imagen Cosas Geek">
                    </figure>
                </div>
                <div class="column is-half">
                    <h2 class="subtitle">¿Quiénes somos?</h2>
                    <p>
                        Aquí irá la información de quiénes son ustedes, qué hacen y cuál es la misión de la página.
                        (Texto de ejemplo para reemplazar más adelante).
                    </p>
                </div>
            </div>

            {{-- Sección Redes + Contacto --}}
            <div class="columns has-text-centered mt-6">
                <div class="column">
                    <h2 class="subtitle">Síguenos</h2>
                    <a href="#" class="icon is-large"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="icon is-large"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon is-large"><i class="fab fa-tiktok"></i></a>
                </div>
                <div class="column">
                    <h2 class="subtitle">Contáctanos</h2>
                    <p><strong>Tel:</strong> +52 3311558903</p>
                    <p><strong>Email:</strong> fershokun@hotmail.com</p>
                </div>
            </div>

            {{-- Sección Historia --}}
            <div class="mt-6">
                <h2 class="subtitle">Historia de la empresa</h2>
                <p>
                    Aquí podrás escribir la historia de tu empresa, cómo nació, qué los motiva y hacia dónde quieren llegar.
                    (Texto de ejemplo a reemplazar).
                </p>
            </div>
        </div>
    </section>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const textoBuscado = localStorage.getItem('busquedaGlobal');
    if (!textoBuscado) return;

    const productos = document.querySelectorAll('.nombre-producto');
    let encontrado = false;

    productos.forEach(p => {
        const nombre = p.innerText.toLowerCase();
        const card = p.closest('.producto, .juego, .libro, .column');
        if (nombre.includes(textoBuscado)) {
            card.style.display = 'block';
            encontrado = true;
        } else {
            card.style.display = 'none';
        }
    });

    // Limpia el término para no afectar futuras búsquedas
    localStorage.removeItem('busquedaGlobal');
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Registrar los productos reales de esta página
    const productosLocales = [];
    const items = document.querySelectorAll('.nombre-producto');

    // Detectar tipo de página automáticamente
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

    // Guardar lista global (sin duplicados)
    const listaGlobal = JSON.parse(localStorage.getItem('listaProductosGlobal') || '[]');
    const nombresExistentes = listaGlobal.map(p => p.nombre);
    const nuevos = productosLocales.filter(p => !nombresExistentes.includes(p.nombre));
    const actualizada = [...listaGlobal, ...nuevos];
    localStorage.setItem('listaProductosGlobal', JSON.stringify(actualizada));

    // Filtrar automáticamente si vienes desde el buscador
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
@endsection


