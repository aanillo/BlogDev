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
<body class="flex flex-col min-h-screen text-white bg-white font-[Courier New]">

    @include('partials.header') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-40">
        
        <section class="text-center mb-8 w-[70%] mx-auto px-10 py-10 bg-white">
  <h1 class="text-3xl font-bold underline">EL RINCÓN DEL DEV</h1>

  <div class="grid grid-cols-[50%_50%] items-center gap-1">
    <h2 class="text-xl text-center">
      La web del programador. <br>Aquí podrás compartir tus vivencias y experiencias sobre el maravilloso mundo de la programación informática. Cómo te iniciaste, por qué decidiste formarte en una determinada tecnología, tus procesos, avances, cómo trabajas...
    </h2>

    <img 
      src="{{ asset('img/logoSinFondo.png') }}" 
      class="w-full h-auto object-contain rounded-md max-h-60" 
      alt="logo"
    >
  </div>
</section>


    <section class="grid grid-cols-4 w-[90%] items-center gap-6 mb-16">
        <article class="flex flex-col justify-between border-2 border-lime-300 rounded-2xl px-10 py-10 shadow-lg bg-lime-200 text-center hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-2xl underline mb-8"><strong>INICIOS</strong></h2>
            <h3 class="text-xl mb-8">Los primeros pasos de la comunidad</h3>
            <img src="img/community.svg" alt="Descripción" class="mx-auto mb-6 h-32">
            <a>
                <button class="bg-lime-300 w-30 mt-8 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-300 rounded-2xl px-10 py-10 shadow-lg bg-lime-200 text-center hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-2xl underline mb-8"><strong>TECNOLOGÍAS</strong></h2>
            <h3 class="text-xl mb-8">Consejos e historias sobre las tecnologías</h3>
            <img src="img/tech.svg" alt="Descripción" class="mx-auto mb-6 h-32">
            <a>
                <button class="bg-lime-300 w-30 mt-8 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-300 rounded-2xl px-10 py-10 shadow-lg bg-lime-200 text-center hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-2xl underline mb-8"><strong>EXPERIENCIAS</strong></h2>
            <h3 class="text-xl mb-8">Aportaciones tanto profesionales como educativas</h3>
            <img src="img/work.svg" alt="Descripción" class="mx-auto mb-6 h-32">
            <a>
                <button class="bg-lime-300 w-30 mt-8 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-300 rounded-2xl px-10 py-10 shadow-lg bg-lime-200 text-center hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-2xl underline mb-8"><strong>OPINIONES</strong></h2>
            <h3 class="text-xl mb-8">Puntos de vista de la comunidad</h3>
            <img src="img/chat.svg" alt="Descripción" class="mx-auto mb-6 h-32">
            <a>
                <button class="bg-lime-300 w-30 mt-8 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110">Ir</button>
            </a>
        </article>
    </section>
    
        
    </main>

    @include('partials.footer')

</body>
</html>
