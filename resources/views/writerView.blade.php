<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor</title>
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

<main class="flex-grow flex flex-col items-center bg-white text-black p-6 mt-56">

    <!-- Datos del autor seleccionado -->

    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">AUTOR</h1>
        <h2 class="text-2xl font-bold mb-2 text-center text-[#322411]">{{ $writer->nombre }}</h2>
        
        <div class="flex flex-col md:flex-row gap-16 shadow-lg rounded-xl border border-gray-200 justify-center bg-amber-100 items-start p-4 mt-8 mb-8">
            <div class="flex-shrink-0 mx-auto md:mx-0">
                <img src="{{ $writer->imagen }}" alt="{{ $writer->nombre }}" 
                    class="w-72 object-cover rounded-md shadow-md mt-4 mb-4">
            </div>
            <div class="flex flex-col justify-start max-w-md text-lg">
                <p class="mt-16 mb-8"><strong>Nombre completo:</strong> {{ $writer->nombre_completo }}</p>
                <p class="mb-8"><strong>País:</strong> {{ $writer->pais }}</p>
                <p class="mb-8"><strong>Fecha nacimiento:</strong> {{ \Carbon\Carbon::parse($writer->nacimiento)->format('d-m-Y') }}</p>
                @if ($writer->fallecimiento)
                <p class="mb-16"><strong>Fecha fallecimiento:</strong> {{ \Carbon\Carbon::parse($writer->fallecimiento)->format('d-m-Y') }}</p>
                @else
                    <p class="mb-16"><strong>Fecha fallecimiento:</strong> </p>
                @endif
            </div>
        </div>
            
        </div>
           
            <div class="max-w-6xl mx-auto mt-8 mb-12 px-4 w-full"
     x-data="{
         currentPage: 1,
         booksPerPage: 15,
         get paginatedBooks() {
             const start = (this.currentPage - 1) * this.booksPerPage;
             const end = start + this.booksPerPage;
             return this.allBooks.slice(start, end);
         },
         get totalPages() {
             return Math.ceil(this.allBooks.length / this.booksPerPage);
         },
         allBooks: @js($booksWriter),
         baseUrl: '{{ url('books/libro') }}/'
     }">

    <!-- Lista de libros escritos por el autor seleccionado -->

    <h2 class="text-xl mt-2 text-center mb-6 font-bold text-[#322411]">Libros de {{ $writer->nombre }}</h2>

    <div x-show="allBooks.length === 0" class="text-center text-lg font-semibold text-red-500">
        No se encontraron libros para este autor.
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4">
        <template x-for="libro in paginatedBooks" :key="libro.id">
            <div @click="window.location.href = baseUrl + libro.id"
                 class="cursor-pointer bg-[#F8F3EB] p-2 bg-[#F8F3EB] shadow-md rounded-lg hover:-translate-y-1 transition">
                <img :src="libro.imagen" :alt="libro.titulo" class="w-full h-auto max-h-72 object-contain sm:h-72 sm:object-cover rounded-md">
                <h2 class="text-lg font-semibold mt-2 text-center" x-text="libro.titulo"></h2>
            </div>
        </template>
    </div>

    <div class="flex justify-center mt-6 gap-4 items-center text-[#322411] text-2xl">
        <button 
            @click="if (currentPage > 1) currentPage--"
            clAass="hover:text-amber-500 transition"
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
</div>


<div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
    <div class="flex items-center gap-4">
        <h3 class="text-lg">Volver a Autores:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600">Volver</a>
        </div>

    <div class="flex items-center gap-4">
        <h3 class="text-lg">Volver a Home:</h3>
        @auth
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @else
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @endauth
    </div>
</div>
    

</main>

</body>

@include('partials.footer')
</html>