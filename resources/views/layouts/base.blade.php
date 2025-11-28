<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mi Sitio')</title>

  <!-- ✔ BULMA (era lo que faltaba en Railway) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

  <!-- ✔ Vite (forma correcta, en una sola llamada) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>

  /* -----------------------------------------------------------
     🎮 ANIMACIÓN RETRO DE ENTRADA
     ----------------------------------------------------------- */
  @keyframes retroPortal {
    0% { opacity: 0; transform: scale(0.3) rotate(-12deg); }
    40% { opacity: 1; transform: scale(1.15) rotate(4deg); }
    70% { transform: scale(0.95) rotate(-2deg); }
    100% { opacity: 1; transform: scale(1) rotate(0deg); }
  }

  .fx-retro-enter {
    animation: retroPortal .65s cubic-bezier(.26,.75,.32,1.2) forwards;
  }

  /* -----------------------------------------------------------
     ✨ TARJETA PRODUCTO (con brillo suave)
     ----------------------------------------------------------- */
  .producto {
    transition: all 0.25s ease;
    transform-origin: center;
    border: none;
    position: relative;
    overflow: visible !important;
    border-radius: 10px;
    box-shadow: none;
  }

  .producto:hover {
    box-shadow: 0 0 14px rgba(183,148,244,0.75);
    background-color: transparent;
    border: none !important;
    z-index: 10;
  }

  .producto img {
    width: 100%;
    border-radius: 8px;
  }

  /* -----------------------------------------------------------
     🔫 CURSOR BULLET BILL FIX
     ✔ asset() para que funcione en producción
     ----------------------------------------------------------- */
  html, body, a, button, input, .producto, * {
    cursor: url("{{ asset('images/bulletbill.png') }}") 18 18, auto !important;
  }

</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar custom-navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ url('/') }}">
      <strong>Inicio</strong>
    </a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="menuPrincipal">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="menuPrincipal" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="{{ route('productos') }}">Productos</a>
      <a class="navbar-item" href="{{ route('juegos') }}">Juegos</a>
      <a class="navbar-item" href="{{ route('libros') }}">Libros</a>
    </div>
  </div>
</nav>

<!-- 🔍 BUSCADOR SIMPLE -->
<div class="container mt-5" style="max-width: 500px;">
  <div class="field has-addons">
    <div class="control is-expanded">
      <input id="inputBusqueda" class="input" type="text" placeholder="Buscar en esta página...">
    </div>
    <div class="control">
      <button id="btnBuscar" class="button is-primary">Buscar</button>
    </div>
  </div>
</div>

<!-- CONTENIDO -->
<section class="section">
  <div class="container">
    @yield('content')
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="content has-text-centered">
    <p>© {{ date('Y') }} Videojuegos y Cosas Geek</p>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {

  /* 🍔 Menú responsivo */
  const burger = document.querySelector('.navbar-burger');
  const menu = document.querySelector('#menuPrincipal');
  if (burger && menu) {
    burger.addEventListener('click', () => {
      burger.classList.toggle('is-active');
      menu.classList.toggle('is-active');
    });
  }

  /* 🔎 Buscador */
  const input = document.getElementById('inputBusqueda');
  const btn = document.getElementById('btnBuscar');

  const buscar = () => {
    const texto = input.value.toLowerCase().trim();
    const elementos = document.querySelectorAll('.producto');

    elementos.forEach(el => {
      const nombre = el.querySelector('.nombre-producto')?.innerText.toLowerCase() || '';
      el.style.display = nombre.includes(texto) || texto === '' ? '' : 'none';
    });
  };

  btn.addEventListener('click', buscar);
  input.addEventListener('keyup', e => {
    if (e.key === 'Enter') buscar();
  });

  /* 🎮 EFECTO DE ENTRADA RETRO */
  document.querySelectorAll('.producto').forEach(card => {
    card.classList.add('fx-retro-enter');
  });

});
</script>

</body>
</html>
