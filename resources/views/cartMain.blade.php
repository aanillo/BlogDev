<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro</title>
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
    <h1 class="text-4xl font-bold mb-4 text-center text-[#322411]">CARRO</h1>
    <h2 class="text-xl mt-2 text-center mb-6">Carrito de la compra de {{ auth()->user()->username }}</h2>

    <!-- Carro de la compra con los libros -->

    @if ($cart && $cart->cartItems->count() > 0)
        <div class="w-full max-w-5xl bg-amber-200 rounded-xl shadow-lg px-4 sm:px-8 py-6 space-y-6">

            @foreach ($cart->cartItems as $item)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 rounded-md shadow">
                    <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                        <img src="{{ $item->book->imagen }}" alt="{{ $item->book->titulo }}"
                             class="w-24 sm:w-28 h-auto max-h-40 object-contain rounded shadow">
                        <div>
                            <h2 class="text-lg sm:text-xl font-semibold text-[#322411]">{{ $item->book->titulo }}</h2>
                            <p class="text-sm sm:text-xl">Cantidad: {{ $item->quantity }}</p>
                            <p class="text-sm sm:text-xl">Precio unitario: {{ number_format($item->book->precio, 2) }} €</p>
                            <p class="font-bold text-sm sm:text-xl">Subtotal: {{ number_format($item->book->precio * $item->quantity, 2) }} €</p>
                        </div>
                    </div>

                    <div class="text-center sm:text-right">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-800 transform transition-transform duration-300 hover:scale-105">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="text-right text-xl font-bold text-[#322411]">
                Total: €{{ number_format($cart->totalPrice(), 2) }}
            </div>

            <div class="flex justify-end">
                <a href="{{ route('purchaseCheckoutAll') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-800 font-semibold transform transition-transform duration-300 hover:scale-105">
                    Proceder al pago
                </a>
            </div>
        </div>
    @else
        <p class="text-center text-lg text-gray-600">Tu carrito está vacío.</p>
    @endif

    <div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-300 hover:scale-105">Volver</a>
        </div>

        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-300 hover:scale-105">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-300 hover:scale-105">Home</a>
            @endauth
        </div>
    </div> 
</main>

@include('partials.footer')
</body>
</html>
