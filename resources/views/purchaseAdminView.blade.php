<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerAdmin')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">

        <section class="text-center mb-8">
            <h1 class="text-3xl font-bold">COMPRAS</h1>
        </section>

        <!-- Lista de compras de todos los usuarios -->

        <section class="w-full overflow-x-auto"
        x-data="{
            currentPage: 1,
            purchasesPerPage: 15,
            searchQuery: '',
            get filteredPurchases() {
                if (!this.searchQuery) return this.purchases;
                return this.purchases.filter(purchase =>
                    purchase.user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    purchase.id.toString().includes(this.searchQuery)
                );
            },
            get paginatedPurchases() {
                const start = (this.currentPage - 1) * this.purchasesPerPage;
                return this.filteredPurchases.slice(start, start + this.purchasesPerPage);
            },
            get totalPages() {
                return Math.max(1, Math.ceil(this.filteredPurchases.length / this.purchasesPerPage));
            },
            purchases: @js($purchases),
            baseUrl: '{{ url('purchases/admin') }}'
        }">
             <div class="mb-6 w-full flex justify-center">
                <input
                    type="text"
                    x-model="searchQuery"
                    placeholder="Buscar por ID o usuario"
                    class="w-full max-w-md p-2 border-2 border-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
            </div>

            <h2 class="text-2xl text-center font-bold mb-6">Lista de Compras</h2>

            <table class="w-[90%] bg-white border border-gray-200 mx-auto">
                <thead>
                    <tr class="bg-[#322411] text-left text-lg text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Dirección</th>
                        <th class="px-4 py-2">Precio Total</th>
                        <th class="px-4 py-2">Libros Comprados</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="purchase in paginatedPurchases" :key="purchase.id">
                        <tr class="border-b text-black text-lg bg-amber-100">
                            <td class="px-4 py-2 font-bold" x-text="purchase.id"></td>
                            <td class="px-4 py-2 font-bold" x-text="purchase.user.username"></td>
                            <td class="px-4 py-2" x-text="purchase.address"></td>
                            <td class="px-4 py-2" x-text="purchase.total_price + ' €'"></td>
                            <td class="px-4 py-2">
                                <ul class="list-disc ml-4" x-html="purchase.books.map(book => `${book.titulo} (x${book.pivot.quantity})`).join('<br>')"></ul>
                            </td>
                            <td class="px-4 py-2">
                                <form :action="baseUrl + '/purchases/' + purchase.id" method="POST" class="inline">
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