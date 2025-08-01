<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen text-white font-[Georgia]">

@auth
    @include('partials.headerLog')
@else
    @include('partials.header')
@endauth

<main class="flex-grow flex flex-col bg-white items-center text-black px-6 mt-56">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">LIBROS</h1>
        <h2 class="text-xl mt-2 text-center mb-6">Realiza tu búsqueda según tipo o género</h2>

    <!-- Lista de géneros para seleccionar -->
        <ul class="grid grid-cols-2 md:grid-cols-5 gap-4 w-full">
            <li class="group p-2 shadow hover:shadow-lg transition border-2 border-solid flex items-center justify-center w-[160px]
                {{ request()->get('genero') === null || request()->get('genero') === 'Todos' ? 'bg-[#322411] border-amber-200' : 'bg-amber-200 border-[#322411]' }}
                hover:bg-[#322411] hover:border-amber-200 active:bg-[#322411] active:border-amber-200">
                
                <a href="{{ route('books', ['genero' => 'Todos']) }}"
                class="text-lg text-center font-bold 
                {{ request()->get('genero') === null || request()->get('genero') === 'Todos' ? 'text-amber-200' : 'text-[#322411]' }} 
                group-hover:text-amber-200">
                Todos
                </a>
            </li>

            @foreach ($generos as $genero)
            <li class="group p-2 shadow hover:shadow-lg transition border-2 border-solid flex items-center justify-center w-[160px]
                {{ request()->get('genero') === $genero ? 'bg-[#322411] border-amber-200' : 'bg-amber-200 border-[#322411]' }}
                hover:bg-[#322411] hover:border-amber-200 active:bg-[#322411] active:border-amber-200">
                
                <a href="{{ route('books', ['genero' => $genero]) }}"
                class="text-lg text-center font-bold 
                {{ request()->get('genero') === $genero ? 'text-amber-200' : 'text-[#322411]' }} 
                group-hover:text-amber-200">
                {{ $genero }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="max-w-6xl mx-auto mt-8 mb-16 px-4 w-full"
         x-data="{
             currentPage: 1,
             booksPerPage: 15,
             searchQuery: '',
             get filteredBooks() {
    if (!this.searchQuery) return this.allBooks;

    const query = this.searchQuery.toLowerCase();

    return this.allBooks.filter(book => {
        const titulo = book.titulo ? book.titulo.toLowerCase() : '';
        const autor = book.autor ? book.autor.toLowerCase() : '';
        return titulo.includes(query) || autor.includes(query);
    });
},
             get paginatedBooks() {
                 const start = (this.currentPage - 1) * this.booksPerPage;
                 return this.filteredBooks.slice(start, start + this.booksPerPage);
             },
             get totalPages() {
                 return Math.ceil(this.filteredBooks.length / this.booksPerPage);
             },
             allBooks: @js($librosPorGenero),
             baseUrl: '{{ url('books/libro') }}/'
         }">

         <div class="mb-6 w-full max-w-md mx-auto">
            <input
                type="text"
                x-model="searchQuery"
                placeholder="Buscar libro por título"
                class="w-full p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
            />
        </div>

        <h2 class="text-xl mt-2 text-center mb-6">
            Libros en el género: 
            <span>
                {{ request()->get('genero') ? request()->get('genero') : 'Todos' }}
            </span>
        </h2>


        <!-- Muestra de libros y paginación -->

        <div x-show="filteredBooks.length === 0" class="text-center text-lg font-semibold text-red-500">
            No se encontraron libros.
        </div>
      
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4" x-show="filteredBooks.length > 0">
            <template x-for="libro in paginatedBooks" :key="libro.id">
                <div @click="window.location.href = baseUrl + libro.id"
                     class="cursor-pointer p-2 shadow-md rounded-lg hover:-translate-y-1 transition border border-gray-300 bg-[#F8F3EB]">
                    <img :src="libro.imagen" :alt="libro.titulo" class="w-full h-auto max-h-72 object-contain sm:h-72 sm:object-cover rounded-md">
                    <h2 class="text-lg font-semibold mt-2 text-center" x-text="libro.titulo"></h2>
                </div>
            </template>
        </div>

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
    </div>

    <div class="flex items-center gap-4 mb-16">
        <h3 class="text-lg">Volver a Home:</h3>
        @auth
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @else
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @endauth
    </div>
</main>

@include('partials.footer')
</body>
</html>
