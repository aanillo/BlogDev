<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
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

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-56"
      x-data="{
          currentPage: 1,
          authorsPerPage: 12,
          searchQuery: '',
          get filteredAuthors() {
              if (!this.searchQuery) return this.allAuthors;
              const query = this.searchQuery.toLowerCase();
              return this.allAuthors.filter(autor =>
                  autor.nombre?.toLowerCase().includes(query)
              );
          },
          get paginatedAuthors() {
              const start = (this.currentPage - 1) * this.authorsPerPage;
              return this.filteredAuthors.slice(start, start + this.authorsPerPage);
          },
          get totalPages() {
              return Math.ceil(this.filteredAuthors.length / this.authorsPerPage);
          },
          allAuthors: @js($autores),
          baseUrl: '{{ url('writers/autor') }}/'
      }">
      
    <div class="max-w-4xl mx-auto mb-6 px-4 w-full">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">AUTORES</h1>
        <h2 class="text-xl mt-2 text-center mb-6">Consulta información sobre tus autores favoritos y sus mejores obras</h2>
    </div>

    <!-- Lista de autores -->
    
    <div class="mb-6 w-full max-w-md mx-auto">
        <input
            type="text"
            x-model="searchQuery"
            placeholder="Buscar autor por nombre"
            class="w-full p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
        />
    </div>

   
    <div class="max-w-6xl w-full px-4 mb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="autor in paginatedAuthors" :key="autor.id">
                <div @click="window.location.href = baseUrl + autor.id" 
                    class="cursor-pointer bg-white border border-gray-300 bg-[#F8F3EB] shadow-md rounded-lg overflow-hidden flex flex-col items-center p-4 text-center hover:-translate-y-1">
                    <img :src="autor.imagen" :alt="autor.nombre" class="w-48 h-48 object-cover rounded-full mb-4">
                    <h3 class="text-lg font-semibold text-[#322411]" x-text="autor.nombre"></h3>
                </div>
            </template>
        </div>
    </div>

    
    <div class="flex justify-center mt-6 gap-4 items-center text-[#322411] text-2xl">
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

   
    <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a Home:</h3>
        @auth
            <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @else
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        @endauth
    </div>
</main>

</body>

@include('partials.footer')
</html>
