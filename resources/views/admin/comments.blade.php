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
<body class="flex flex-col min-h-screen bg-neutral-100 font-[Courier New] text-black">

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center px-6 mt-48">

        <h1 class="text-4xl md:text-6xl font-extrabold text-center text-lime-600 underline mb-12 tracking-tight">
            ADMIN - COMENTARIOS
        </h1>

        <section class="w-[90%] px-10 py-12 bg-white border border-neutral-300 rounded-2xl shadow-lg mb-12"
            x-data="{
                currentPage: 1,
                commentsPerPage: 15,
                searchQuery: '',
                comments: @js($comments),
                baseUrl: '{{ url('comments/admin') }}',

                get filteredComments() {
                    if (!this.searchQuery) return this.comments;
                    return this.comments.filter(comment =>
                        comment.comment.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                get paginatedComments() {
                    const start = (this.currentPage - 1) * this.commentsPerPage;
                    return this.filteredComments.slice(start, start + this.commentsPerPage);
                },

                get totalPages() {
                    return Math.max(1, Math.ceil(this.filteredComments.length / this.commentsPerPage));
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                }
            }"
        >

            <!-- Subir post -->
            <div class="flex items-center gap-8 mb-10 justify-center items-center">
                <a href="{{ route('admin') }}"
                    class="flex flex-col items-center justify-center gap-2 px-8 py-3 w-60 text-xl border-2 border-black bg-purple-600 text-black font-bold rounded-md hover:bg-purple-700 transition transform hover:scale-105">
                    <i class="fas fa-home text-2xl"></i>
                    <span>Volver</span>
                </a>
            </div>

            <!-- Barra de búsqueda -->
            <div class="mb-6 w-full flex justify-center">
                <input
                    type="text"
                    x-model="searchQuery"
                    placeholder="Buscar comentario"
                    class="w-full max-w-md p-2 border-2 border-neutral-400 rounded-md focus:outline-none focus:ring-2 focus:ring-lime-500"
                />
            </div>

            <!-- Lista de comentarios -->
            <h2 class="text-2xl font-bold text-center mb-6">Lista de comentarios</h2>
            <div class="w-full overflow-x-auto">
                <table class="w-full border border-neutral-300 rounded-lg overflow-hidden shadow-md whitespace-nowrap">
                <thead>
                    <tr class="bg-neutral-800 text-left text-lg text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Post</th>
                        <th class="px-4 py-2">Comentario</th>
                        <th class="px-4 py-2">Fecha publicación</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="comment in paginatedComments" :key="comment.id">
                        <tr class="border-b text-black text-md even:bg-neutral-100 odd:bg-lime-100 hover:bg-lime-200 transition">
                            <td class="px-4 py-2 font-bold" x-text="comment.id"></td>
                            <td class="px-4 py-2" x-text="comment.user.username"></td>
                            <td class="px-4 py-2 truncate overflow-hidden whitespace-nowrap max-w-[350px]" x-text="comment.post.title"></td>
                            <td class="px-4 py-2 truncate overflow-hidden whitespace-nowrap max-w-[450px]" x-text="comment.comment"></td>
                            <td class="px-4 py-2" x-text="formatDate(comment.publish_date)"></td>
                            <td class="px-4 py-2 text-center space-x-4">
                                <form :action="baseUrl + '/comments/' + comment.id" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-bold hover:underline" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            </div>
    

            <!-- Paginación -->
            <div class="flex justify-center mt-6 gap-6 items-center text-neutral-800 text-lg" x-show="totalPages > 1">
                <button 
                    @click="if (currentPage > 1) currentPage--"
                    class="hover:text-lime-600 transition"
                    :disabled="currentPage === 1"
                    :class="{ 'opacity-30 cursor-not-allowed': currentPage === 1 }"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>

                <span class="font-bold">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>

                <button 
                    @click="if (currentPage < totalPages) currentPage++"
                    class="hover:text-lime-600 transition"
                    :disabled="currentPage === totalPages"
                    :class="{ 'opacity-30 cursor-not-allowed': currentPage === totalPages }"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        </section>


    </main>

    @include('partials.footer')

</body>
</html>
