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
                perPage: 10,
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
                get totalPages() {
                    return Math.ceil(this.allPosts.length / this.perPage);
                },
                get paginatedPosts() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.allPosts.slice(start, start + this.perPage);
                }
            }"
            class="w-[80%] px-10 py-12 bg-orange-50 border border-neutral-300 rounded-2xl shadow-lg mb-12"
        >
            <div class="bg-neutral-800 w-[60%] mx-auto border-2 border-orange-600 text-orange-600 px-8 py-6 rounded-lg shadow-md mb-12 text-center">
                <h1 class="text-5xl font-bold leading-tight">Posts de {{ $type }}</h1>
            </div>

            <!-- Si no hay posts -->
            <template x-if="allPosts.length === 0">
                <p class="text-center text-neutral-700 text-xl italic">No hay posts en la categoría "{{ $type }}".</p>
            </template>

            <!-- Lista de posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto" x-show="allPosts.length > 0">
                <template x-for="post in paginatedPosts" :key="post.id">
                    <article class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-orange-600 p-2 rounded-lg text-center">
                            <h2 class="text-3xl font-semibold text-black mb-2" x-text="post.title"></h2>
                        </div>
                        <p class="text-neutral-600 mb-4 line-clamp-3" x-text="post.excerpt"></p>

                        <div class="flex justify-between items-center text-lg text-black">
                            <p x-text="post.author"></p>
                            <div class="bg-neutral-800 border-2 border-orange-600 text-orange-600 w-[30%] p-2 text-center rounded-lg h-[40px] flex items-center justify-center">
                                <p class="text-center text-lg" x-text="post.type"></p>
                            </div>
                            <time x-text="post.created_at"></time>
                        </div>
                        <p class="text-neutral-600 mt-8 mb-2 line-clamp-2" x-text="post.post"></p>
                        <a @click="window.location.href = baseUrl + post.id" 
                           class="text-orange-700 hover:underline font-semibold text-xl cursor-pointer">
                            Ver post completo →
                        </a>
                    </article>
                </template>
            </div>

            <!-- Controles de paginación -->
            <div class="flex justify-center items-center gap-4 mt-8" x-show="totalPages > 1">
                <button 
                    @click="if (currentPage > 1) currentPage--"
                    class="px-4 py-2 bg-neutral-800 text-orange-600 border-2 border-oragne-600 rounded-lg disabled:opacity-50"
                    :disabled="currentPage === 1"
                >
                    ← Anterior
                </button>

                <span class="text-lg font-semibold">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>

                <button 
                    @click="if (currentPage < totalPages) currentPage++"
                    class="px-4 py-2 bg-neutral-800 text-orange-600 border-2 border-orange-600 rounded-lg disabled:opacity-50"
                    :disabled="currentPage === totalPages"
                >
                    Siguiente →
                </button>
            </div>
        </section>

    </main>

    @include('partials.footer')

</body>
</html>
