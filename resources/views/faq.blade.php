@extends('layouts.base')

@section('title', 'Preguntas Frecuentes')

@section('content')

<h1 class="title has-text-centered mt-5">Preguntas Frecuentes (FAQ)</h1>
<p class="subtitle has-text-centered mb-6">Haz clic en una pregunta para ver la respuesta 👇</p>

<div class="max-w-2xl mx-auto">

    {{-- Pregunta 1 --}}
    <div id="pregunta1" class="cursor-pointer border p-4 bg-gray-100 rounded-lg">
        <p class="font-bold">¿Qué es este sitio web?</p>
    </div>
    <div id="respuesta1" class="hidden border p-4 bg-gray-50 rounded-b-lg">
        <p>Es una página dedicada al contenido geek, donde puedes explorar videojuegos, libros y más.</p>
    </div>

    {{-- Pregunta 2 --}}
    <div id="pregunta2" class="cursor-pointer border p-4 bg-gray-100 mt-4 rounded-lg">
        <p class="font-bold">¿Cómo puedo comprar un producto?</p>
    </div>
    <div id="respuesta2" class="hidden border p-4 bg-gray-50 rounded-b-lg">
        <p>Puedes hacerlo desde la sección de catálogo o contactándonos directamente en la página de soporte.</p>
    </div>

    {{-- Pregunta 3 --}}
    <div id="pregunta3" class="cursor-pointer border p-4 bg-gray-100 mt-4 rounded-lg">
        <p class="font-bold">¿Aceptan devoluciones?</p>
    </div>
    <div id="respuesta3" class="hidden border p-4 bg-gray-50 rounded-b-lg">
        <p>Sí, siempre y cuando se cumplan las condiciones de garantía del fabricante.</p>
    </div>

    {{-- Pregunta 4 --}}
    <div id="pregunta4" class="cursor-pointer border p-4 bg-gray-100 mt-4 rounded-lg">
        <p class="font-bold">¿Puedo sugerir nuevos productos?</p>
    </div>
    <div id="respuesta4" class="hidden border p-4 bg-gray-50 rounded-b-lg">
        <p>¡Claro! Nos encanta recibir sugerencias. Escríbenos en la sección de contacto.</p>
    </div>

</div>

{{-- 🔹 JavaScript básico para mostrar/ocultar --}}
<script>
    function mostrarOcultar1() {
        const respuesta1 = document.getElementById('respuesta1');
        respuesta1.classList.toggle('hidden');
    }

    function mostrarOcultar2() {
        const respuesta2 = document.getElementById('respuesta2');
        respuesta2.classList.toggle('hidden');
    }

    function mostrarOcultar3() {
        const respuesta3 = document.getElementById('respuesta3');
        respuesta3.classList.toggle('hidden');
    }

    function mostrarOcultar4() {
        const respuesta4 = document.getElementById('respuesta4');
        respuesta4.classList.toggle('hidden');
    }

    // Enlazar eventos con addEventListener
    const pregunta1 = document.getElementById('pregunta1');
    const pregunta2 = document.getElementById('pregunta2');
    const pregunta3 = document.getElementById('pregunta3');
    const pregunta4 = document.getElementById('pregunta4');

    pregunta1.addEventListener('click', mostrarOcultar1);
    pregunta2.addEventListener('click', mostrarOcultar2);
    pregunta3.addEventListener('click', mostrarOcultar3);
    pregunta4.addEventListener('click', mostrarOcultar4);
</script>

@endsection
