<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>El rincón del dev - Inicio</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .prose img {
          max-width: 300px;
          max-height: 250px;
          display: block;
          margin: 1rem auto;
          border-radius: 0.5rem;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-neutral-100 font-[Courier New] text-black">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center px-6 mt-48">

        <section 
            x-data="{
                currentPage: 1,
                perPage: 12,
                searchQuery: '',
                allPosts: @js($posts->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'title' => $p->title,
                        'excerpt' => $p->excerpt,
                        'post' => $p->post,
                        'type' => $p->type,
                        'author' => $p->user->username,
                        'created_at' => $p->created_at->format('d M, Y')
                    ];
                })),
                baseUrl: '{{ url('posts/show') }}/',
                get filteredPosts() {
                    if (!this.searchQuery) {
                        return this.allPosts;
                    }
                    return this.allPosts.filter(post =>
                        post.title.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },
                get totalPages() {
                    return Math.ceil(this.filteredPosts.length / this.perPage);
                },
                get paginatedPosts() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredPosts.slice(start, start + this.perPage);
                }
            }"
            class="w-[80%] px-10 py-12 bg-white border border-neutral-300 rounded-2xl shadow-lg mb-12"
        >
            <div class="bg-neutral-900 w-[60%] mx-auto border-2 border-yellow-500 text-yellow-500 px-8 py-6 rounded-lg shadow-md mb-12 text-center transition transform hover:scale-105">
                <h1 class="text-5xl font-bold leading-tight">Posts de {{ $type }}</h1>
            </div>

            <div class="mb-6 w-full max-w-md mx-auto relative">
    <!-- Icono de búsqueda -->
    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>

    <!-- Input -->
    <input
        type="text"
        x-model="searchQuery"
        @input="currentPage = 1"
        placeholder="Buscar post por título"
        class="w-full pl-10 p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600"
    />
</div>

            <!-- Si no hay posts -->
            <template x-if="allPosts.length === 0">
                <p class="text-center text-neutral-700 text-xl italic">No hay posts en la categoría "{{ $type }}".</p>
            </template>

            <!-- Lista de posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto" x-show="allPosts.length > 0">
                <template x-for="post in paginatedPosts" :key="post.id">
                    <article class="bg-neutral-50 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-neutral-200 flex flex-col">
                        <div class="bg-yellow-500 p-4 text-center">
                            <h2 class="text-2xl font-bold text-black mb-1 line-clamp-2" x-text="post.title"></h2>
                        </div>

                        <div class="flex-1 p-6 flex flex-col justify-between">

                            <div class="flex justify-between items-center text-sm text-neutral-700 mb-4">
                                <p x-text="post.author"></p>
                                <div class="bg-neutral-800 border border-yellow-500 text-yellow-500 px-3 py-1 rounded-lg text-sm">
                                    <span x-text="post.type"></span>
                                </div>
                                <time class="text-neutral-500" x-text="post.created_at"></time>
                            </div>
                            <p class="text-neutral-600 mt-8 mb-2 line-clamp-2" x-text="post.post"></p>

                            <a 
                                @click="window.location.href = baseUrl + post.id" 
                                class="mt-auto inline-block text-yellow-600 hover:text-yellow-800 font-semibold text-lg transition-colors cursor-pointer"
                            >
                                Ver post completo →
                            </a>
                        </div>
                    </article>
                </template>
            </div>

            <!-- Controles de paginación -->
            <div class="flex justify-center items-center gap-4 mt-8" x-show="totalPages > 1">
                <button 
                    @click="if (currentPage > 1) currentPage--"
                    class="px-4 py-2 bg-neutral-800 text-yellow-500 border-2 border-yellow-500 rounded-lg disabled:opacity-50"
                    :disabled="currentPage === 1"
                >
                    ← Anterior
                </button>

                <span class="text-lg font-semibold">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>

                <button 
                    @click="if (currentPage < totalPages) currentPage++"
                    class="px-4 py-2 bg-neutral-800 text-yellow-500 border-2 border-yellow-500 rounded-lg disabled:opacity-50"
                    :disabled="currentPage === totalPages"
                >
                    Siguiente →
                </button>
            </div>

        <div class="flex flex-wrap justify-center gap-10 items-center mt-16 gap-4">
    <a href="{{ url('/') }}"
       class="px-8 py-3 w-full md:w-60 text-xl text-center bg-purple-600 text-black border-2 border-black font-bold rounded-lg hover:bg-purple-700 hover:scale-105 transition transform flex flex-col items-center gap-2">
        <i class="fas fa-home text-2xl"></i>
        Home
    </a>
     <a href="{{ route('type', 'Inicio') }}"
       class="px-8 py-3 w-full md:w-60 text-xl text-center bg-emerald-500 text-black border-2 border-black font-bold rounded-lg hover:bg-emerald-600 hover:scale-105 transition transform flex flex-col items-center gap-2">
        <i class="fas fa-seedling text-2xl"></i>
        Inicios
    </a>
    <a href="{{ route('type', 'Tecnología') }}"
       class="px-8 py-3 w-full md:w-60 text-xl text-center bg-indigo-500 text-black border-2 border-black font-bold rounded-lg hover:bg-indigo-600 hover:scale-105 transition transform flex flex-col items-center gap-2">
        <i class="fas fa-microchip text-2xl"></i>
        Tecnologías
    </a>
    <a href="{{ route('type', 'Experiencia') }}"
       class="px-8 py-3 w-full md:w-60 text-xl text-center bg-orange-600 text-black border-2 border-black font-bold rounded-lg hover:bg-orange-700 hover:scale-105 transition transform flex flex-col items-center gap-2">
        <i class="fas fa-briefcase text-2xl"></i>
        Experiencias
    </a>
            </div>

        </section>

    </main>

    @include('partials.footer')

</body>
</html>
