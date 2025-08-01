<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar libro</title>
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

<main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-56">

    <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">COMPRA</h1>

    <div class="w-full max-w-4xl mx-auto px-4 mt-8">
        <div class="flex flex-col md:flex-row gap-6 bg-amber-200 shadow-lg rounded-xl p-6 md:p-10">

            <!-- Libro seleccionado y usuario que va a comprar -->

            <div class="flex flex-col md:w-1/2 text-center items-center md:items-start">
                <h2 class="text-4xl font-bold text-[#322411] mb-12">{{ $book->titulo }}</h2>
                <img src="{{ $book->imagen }}" alt="{{ $book->titulo }}" 
                     class="w-80 md:max-w-md rounded-lg shadow-md object-cover mb-4">
            </div>

            <div class="flex flex-col md:w-1/2 space-y-4">
                <div class="flex flex-col space-y-4 text-xl font-semibold text-[#322411]">
                    <p><strong>Usuario:</strong> {{ auth()->user()->username }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                </div>

                <div class="text-xl font-semibold text-[#322411]">
                    <p><strong>Precio:</strong> {{ number_format($book->precio, 2) }} €</p>
                </div>

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif


                <!-- Formulario con datos de envío -->

                <form action="{{ route('purchase.store') }}" method="POST" class="space-y-4" id="purchase-form">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div>
                        <label for="quantity" class="block mb-2 font-semibold">Cantidad:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required
                               class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="direccion" class="block mb-2 font-semibold">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="provincia" class="block mb-2 font-semibold">Provincia:</label>
                        <input type="text" id="provincia" name="provincia" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="municipio" class="block mb-2 font-semibold">Municipio:</label>
                        <input type="text" id="municipio" name="municipio" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="codigo_postal" class="block mb-2 font-semibold">Código Postal:</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    </div>

                    <input type="hidden" name="payment_method" value="card">

                    <div class="flex flex-col">
                        <button type="submit" class="w-full bg-green-600 text-white text-xl px-6 py-2 rounded-md mt-8 font-semibold hover:bg-green-800 transform transition-transform duration-1000 ease-in-out hover:scale-110" id="purchase-btn">
                            <i class="fas fa-credit-card text-white mr-4 text-xl"></i>
                            Realizar compra
                        </button><br>

                        <button name="action" value="cart" id="cart-btn"
                                formaction="{{ route('cart.add') }}"
                                formmethod="POST"
                                class="bg-blue-600 text-white text-xl px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transform transition-transform duration-1000 ease-in-out hover:scale-110">
                            <i class="fas fa-shopping-cart text-white mr-4 text-xl"></i>
                            Añadir al carrito
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
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

@include('partials.footer')

<!-- Script para insertar los datos del envío en la variable de dirección -->

<script>
    const purchaseBtn = document.getElementById('purchase-btn');
    const cartBtn = document.getElementById('cart-btn');
    const purchaseForm = document.getElementById('purchase-form');

    
    const addressFields = [
        document.getElementById('direccion'),
        document.getElementById('provincia'),
        document.getElementById('municipio'),
        document.getElementById('codigo_postal'),
    ];

    
    function setAddressRequired(isRequired) {
        addressFields.forEach(field => {
            if (field) {
                field.required = isRequired;
            }
        });
    }

   
    setAddressRequired(false);

    
    purchaseBtn.addEventListener('click', function() {
        setAddressRequired(true);
    });

    
    cartBtn.addEventListener('click', function() {
        setAddressRequired(false);
    });
</script>
