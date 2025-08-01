<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerAdmin')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">

        <section class="text-center mb-8">
            <h1 class="text-3xl font-bold">COMENTARIOS</h1>
        </section>

        <section class="w-full overflow-x-auto"
        x-data="{
            currentPage: 1,
            commentsPerPage: 15,
            searchQuery: '',
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
            },

            comments: @js($comments),
            baseUrl: '{{ url('comments/admin') }}'
        }">
            <div class="mb-6 w-full flex justify-center">
                <input
                    type="text"
                    x-model="searchQuery"
                    placeholder="Buscar comentario"
                    class="w-full max-w-md p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
            </div>

            <!-- Comentarios totales de los usuarios -->

            <h2 class="text-2xl text-center font-bold mb-6">Lista de comentarios</h2>

            <table class="w-[90%] mx-auto bg-white border border-gray-200">
                <thead>
                    <tr class="bg-[#322411] text-left text-lg text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Comentario</th>
                        <th class="px-4 py-2 min-w-[130px]">Fecha</th>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Libro</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="comment in paginatedComments" :key="comment.id">
                        <tr class="border-b text-black text-lg bg-amber-100">
                            <td class="px-4 py-2 font-bold" x-text="comment.id"></td>
                            <td class="px-4 py-2 font-bold" x-text="comment.comment"></td>
                            <td class="px-4 py-2" x-text="formatDate(comment.publish_date)"></td>
                            <td class="px-4 py-2" x-text="comment.user.username"></td>
                            <td class="px-4 py-2" x-text="comment.book.titulo"></td>
                            <td class="px-4 py-2">
                                <form :action="baseUrl + '/comments/' + comment.id" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-bold" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div class="flex justify-center mt-6 gap-4 items-center text-[#322411] text-2xl" x-show="totalPages > 1">
                <button 
                    @click="if (currentPage > 1) currentPage--"
                    class="hover:text-amber-500 transition"
                    :disabled="currentPage === 1"
                    :class="{ 'opacity-30 cursor-not-allowed': currentPage === 1 }"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>

                <span class="font-bold text-lg">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>

                <button 
                    @click="if (currentPage < totalPages) currentPage++"
                    class="hover:text-amber-500 transition"
                    :disabled="currentPage === totalPages"
                    :class="{ 'opacity-30 cursor-not-allowed': currentPage === totalPages }"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        </section>

        <div class="flex items-center gap-4 mb-16 mt-8">
            <h3 class="text-lg">Volver a la vista principal:</h3>
            <a href="{{ route('admin') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
        </div>

    </main>

    @include('partials.footer')

</body>
</html>
