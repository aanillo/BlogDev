<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El rincón del dev</title>
    <link rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="{{ url('/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white bg-neutral-100 font-[Courier New]">

    @include('partials.header') 

    <main class="flex-grow flex flex-col items-center bg-neutral-100 text-black px-6 mt-36">
        
    <section class="text-center mt-8 mb-8 w-full sm:w-[90%] md:w-[80%] mx-auto px-4 md:px-10 py-10 bg-neutral-100">
    <div class="grid grid-cols-1 md:grid-cols-[70%_30%] items-center gap-6 shadow-2xl rounded-2xl p-6 md:p-10 bg-white border border-neutral-300">
        <div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl text-center text-black mb-4 md:mb-6">
                El rincón del dev: La web del programador
            </h1>
            <h3 class="text-base sm:text-lg md:text-xl">
                Este es tu espacio para compartir vivencias y experiencias en el fascinante mundo de la programación: cómo te iniciaste, por qué elegiste cierta tecnología, tus aprendizajes, desafíos y la forma en que entiendes y vives el desarrollo de software.
            </h3>
        </div>

        <div class="mt-6 md:mt-0">
            <img 
                src="{{ asset('img/logoSinFondo.png') }}" 
                class="w-full h-auto object-contain rounded-md max-h-60" 
                alt="logo"
            >
        </div>
    </div>
</section>



    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 w-[90%] items-center gap-6 mb-10">
        <article class="flex flex-col justify-between border-2 border-lime-200 rounded-2xl px-10 py-10 shadow-lg bg-emerald-500 text-center text-black hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-3xl underline mb-8"><strong>INICIOS</strong></h2>
            <h3 class="text-2xl mb-8">Los primeros pasos de la comunidad</h3>
            <img src="{{ url('community.svg') }}" alt="Experiencias" class="mx-auto mb-6 h-32">
            <a href="{{ route('type', 'Inicio') }}">
                <button class="bg-transparent w-40 mt-8 text-lime-200 text-xl font-bold border-2 border-solid border-lime-200 px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110 hover:text-black hover:border-black">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-200 rounded-2xl px-10 py-10 shadow-lg bg-indigo-500 text-center text-black hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-3xl underline mb-8"><strong>TECNOLOGÍAS</strong></h2>
            <h3 class="text-2xl mb-8">Consejos e historias sobre las tecnologías</h3>
            <img src="{{ url('tech.svg') }}" alt="Experiencias" class="mx-auto mb-6 h-32">
            <a href="{{ route('type', 'Tecnología') }}">
                <button class="bg-transparent shadow-2xl w-40 mt-8 text-lime-200 text-xl font-bold border-2 border-solid border-lime-200 px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110 hover:text-black hover:border-black">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-200 rounded-2xl px-10 py-10 shadow-lg bg-orange-600 text-center text-black hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-3xl underline mb-8"><strong>EXPERIENCIAS</strong></h2>
            <h3 class="text-2xl mb-8">Aportaciones tanto profesionales como educativas</h3>
            <img src="{{ url('work.svg') }}" alt="Experiencias" class="mx-auto mb-6 h-32">
            <a href="{{ route('type', 'Experiencia') }}">
                <button class="bg-transparent w-40 mt-8 text-lime-200 text-xl font-bold border-2 border-solid border-lime-200 px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110 hover:text-black hover:border-black">Ir</button>
            </a>
        </article>
        <article class="flex flex-col justify-between border-2 border-lime-200 rounded-2xl px-10 py-10 shadow-lg bg-yellow-500 text-center text-black hover:-translate-y-1 transition hover:bg-[#1f1b16] hover:text-lime-300 h-[500px]">
            <h2 class="text-3xl underline mb-8"><strong>OPINIONES</strong></h2>
            <h3 class="text-2xl mb-8">Puntos de vista de la comunidad</h3>
            <img src="{{ url('chat.svg') }}" alt="Experiencias" class="mx-auto mb-6 h-32">
            <a href="{{ route('type', 'Opinión') }}">
                <button class="bg-transparent w-40 mt-8 text-lime-200 text-xl font-bold border-2 border-solid border-lime-200 px-10 py-1.5 rounded-md hover:bg-lime-500 transform transition-transform duration-1000 ease-in-out hover:scale-110 hover:text-black hover:border-black">Ir</button>
            </a>
        </article>
    </section>

   <section 
    x-data="{
        posts: @js($recentPosts),
        baseUrl: '{{ url('posts/show') }}/'
    }" 
    class="w-[90%] mx-auto mt-20"
>
    <h2 class="text-4xl font-bold text-center mb-12 text-black">Últimos Posts</h2>

    <template x-if="posts.length === 0">
        <p class="text-center text-neutral-600 text-xl italic">
            No hay posts recientes disponibles.
        </p>
    </template>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-show="posts.length > 0">
        <template x-for="post in posts" :key="post.id">
            <article class="bg-neutral-50 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-neutral-200 flex flex-col">
                <!-- Header del post -->
                <div class="bg-lime-500 p-4 text-center">
                    <h2 class="text-2xl font-bold text-black mb-1 line-clamp-2" x-text="post.title"></h2>
                </div>

                <!-- Contenido del post -->
                <div class="flex-1 p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-center text-sm text-neutral-700 mb-4">
                        <p class="font-semibold text-neutral-900" x-text="post.username"></p>
                        <div class="bg-neutral-800 border border-lime-500 text-lime-400 px-3 py-1 rounded-lg text-sm">
                            <span x-text="post.type"></span>
                        </div>
                        <time class="text-neutral-500" x-text="post.created_at"></time>
                    </div>

                    <p class="text-neutral-600 mt-2 mb-4 line-clamp-3" x-text="post.excerpt"></p>

                    <button 
                        @click="window.location.href = baseUrl + post.id"
                        class="mt-auto inline-block text-lime-600 hover:text-lime-800 font-semibold text-lg text-left transition-colors cursor-pointer"
                    >
                        Ver post completo →
                    </button>
                </div>
            </article>
        </template>
    </div>
</section>



<section class="text-center mt-20 mb-16 w-full sm:w-[90%] md:w-[80%] shadow-2xl rounded-2xl mx-auto px-4 md:px-10 py-10 bg-white border border-neutral-300">
    @guest
        <h2 class="text-4xl font-bold text-black mb-4">Únete a la Comunidad</h2>
        <p class="text-lg text-neutral-700 mb-8">
            Comparte tus experiencias, aprende de otros y forma parte de un espacio donde la programación se vive con pasión.
        </p>
        <a href="{{ route('doRegister') }}">
            <button class="bg-neutral-800 text-lime-500 text-xl font-bold px-8 py-3 rounded-lg border-2 border-lime-500 hover:bg-lime-500 hover:text-black hover:border-black transform hover:scale-105 transition duration-500">
                Publicar mi primer post
            </button>
        </a>
    @endguest

    @auth
        <h2 class="text-4xl font-bold text-black mb-4">
            Bienvenido, {{ Auth::user()->username }}
        </h2>
        <p class="text-lg text-neutral-700 mb-8">
            ¿Listo para compartir tus ideas con la comunidad?
        </p>
        <a href="{{ route('insert.show') }}">
            <button class="bg-neutral-800 text-lime-500 text-xl font-bold px-8 py-3 rounded-lg border-2 border-lime-500 hover:bg-lime-500 hover:text-black hover:border-black transform hover:scale-105 transition duration-500">
                Publicar un nuevo post
            </button>
        </a>
    @endauth
</section>


    
        
    </main>

    @include('partials.footer')

</body>
</html>
