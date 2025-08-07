<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El rincón del dev</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen text-white bg-neutral-100 font-[Courier New]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center justify-center bg-neutral-100 text-black px-6 pt-48 pb-24">

  <h1 class="text-5xl md:text-6xl font-bold text-center text-lime-600 underline mb-12">
    ¿Seguro que quieres cerrar sesión?
  </h1>

  <div class="bg-lime-200 w-full max-w-3xl rounded-3xl border-2 border-lime-300 shadow-xl px-8 py-12 text-center">

    <div class="flex flex-col md:flex-row justify-center items-center gap-12">

      <!-- Botón Logout -->
      <!-- Botón Logout usando <a> en lugar de <form> -->
<div class="flex flex-col items-center gap-4">
  <i class="fas fa-door-open text-5xl text-[#1f1b16]"></i>
  <a href="{{ route('logout') }}"
     class="w-64 bg-indigo-700 text-lime-200 text-xl font-bold border-2 border-lime-300 px-6 py-3 rounded-xl transition-all duration-300 hover:bg-indigo-800 hover:scale-105 shadow-md text-center">
    Cerrar sesión
  </a>
</div>


      <!-- Botón Volver -->
      <div class="flex flex-col items-center gap-4">
        <i class="fas fa-arrow-left text-5xl text-[#1f1b16]"></i>
        <a href="{{ url()->previous() }}"
           class="w-64 bg-purple-800 text-lime-200 text-xl font-bold border-2 border-lime-300 px-6 py-3 rounded-xl transition-all duration-300 hover:bg-purple-900 hover:scale-105 shadow-md">
          Volver atrás
        </a>
      </div>
    </div>

    <h2 class="text-2xl mt-12 text-[#1f1b16] font-semibold">
      ¡Estaremos encantados de verte de nuevo!
    </h2>

    <img src="{{ asset('img/logoSinFondo.png') }}" class="mx-auto mt-8" width="260" height="auto" alt="Logo" />
  </div>

</main>


    @include('partials.footer')

</body>
</html>

