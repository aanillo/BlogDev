<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

@include('partials.headerLog') 

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">

    <div class="max-w-6xl mx-auto px-4" x-data="{
    currentPage: 1,
    purchasesPerPage: 5,
    searchQuery: '',
    allPurchases: @js($purchases),

    formatSearchDate() {
        if (!this.searchQuery) return '';
        const parts = this.searchQuery.split('-'); 
        return parts.length === 2 ? `${parts[1]}/${parts[0]}` : '';
    },

    get filteredPurchases() {
        if (!this.searchQuery) return this.allPurchases;
        const formattedSearch = this.formatSearchDate();
        return this.allPurchases.filter(p => p.date.includes(formattedSearch));
    },

    get totalPages() {
        return Math.ceil(this.filteredPurchases.length / this.purchasesPerPage);
    },

    get paginatedPurchases() {
        const start = (this.currentPage - 1) * this.purchasesPerPage;
        return this.filteredPurchases.slice(start, start + this.purchasesPerPage);
    }
}">

    <!-- Historial de compras del usuario logueado -->

        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">HISTORIAL</h1>
        <h2 class="text-xl mt-2 text-center mb-6">Compras realizadas por {{ $user->username }}</h2>

       
        <div class="mb-6 w-full max-w-md mx-auto">
            <input
            type="month"
            x-model="searchQuery"
            placeholder="Buscar compra por fecha"
            class="w-full p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
        />
        </div>

        
        <template x-if="filteredPurchases.length === 0">
            <p class="text-center text-red-500 font-bold text-lg">No hay compras registradas.</p>
        </template>

        
        <div x-show="filteredPurchases.length > 0" class="w-[120%] mx-auto bg-amber-200 rounded-lg py-8 px-6 mt-6"  style="position: relative; left: 50%; transform: translateX(-50%);">
            <ul class="space-y-3 p-4 text-lg" x-show="filteredPurchases.length > 0">
            <template x-for="(purchase, index) in paginatedPurchases" :key="index">
        <li class="bg-white w-[90%] rounded-md p-6 shadow text-black text-lg" style="position: relative; left: 50%; transform: translateX(-50%);">
            <div class="grid grid-cols-1 md:grid-cols-2">
                
                <div>
                    <p><strong>Libros:</strong></p>
                    <ul class="flex flex-col list-none font-bold mt-2">
                        <template x-for="(title, i) in purchase.books" :key="i">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-book text-[#322411]"></i>
                                <span x-text="title"></span>
                            </li>
                        </template>
                    </ul>
                </div>

                <div class="space-y-2">
                    <p><strong>Precio total:</strong> <span x-text="purchase.amount + ' €'"></span></p>
                    <p><strong>Dirección:</strong> <span x-text="purchase.address"></span></p>
                    <p><strong>Fecha:</strong> <span x-text="purchase.date"></span></p>
                </div>
            </div>
        </li>
    </template>
</ul>

        
        <div class="flex justify-center items-center gap-6 mt-6 text-[#322411] text-xl" x-show="totalPages > 1 && filteredPurchases.length > 0">
            <button 
                @click="if (currentPage > 1) currentPage--" 
                :disabled="currentPage === 1"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === 1 }"
                class="hover:text-amber-500 transition"
            >
                <i class="fas fa-chevron-left"></i>
            </button>
            <span class="font-bold text-lg">Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span></span>
            <button 
                @click="if (currentPage < totalPages) currentPage++" 
                :disabled="currentPage === totalPages"
                :class="{ 'opacity-30 cursor-not-allowed': currentPage === totalPages }"
                class="hover:text-amber-500 transition"
            >
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
        </div>

    
    <div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}"
               class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
        </div>
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @endauth
        </div>
    </div>


</main>

@include('partials.footer')

</body>
</html>