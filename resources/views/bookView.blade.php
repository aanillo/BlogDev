<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro</title>
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

    <!-- Muestra del libro seleccionado -->

    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">LIBRO</h1>
        <h2 class="text-2xl font-bold mb-2 text-center text-[#322411]">{{ $book->titulo }}</h2>

        
        <div class="flex flex-col md:flex-row gap-16 shadow-lg rounded-xl border border-gray-200 justify-center bg-amber-100 items-start p-4 mt-8 mb-12">
            
            <div class="flex-shrink-0 mx-auto md:mx-0">
                <img src="{{ $book->imagen }}" alt="{{ $book->titulo }}" 
                     class="w-80 object-cover rounded-md shadow-md">
            </div>

            <div class="flex flex-col justify-start max-w-md">
                <p class="mb-4 mt-2"><strong>Autor:</strong> {{ $book->writer->nombre }}</p>
                <p class="mb-4"><strong>Género:</strong> {{ $book->genero }}</p>
                <p class="mb-4"><strong>Año:</strong> {{ $book->fecha_creacion }}</p>
                <p class="mb-4 text-justify"><strong>Descripción:</strong> {{ $book->descripcion }}</p>
                <div class="mb-2"> 
                    <p class="mt-2"><strong>Valoración:</strong> {{ number_format($book->valoracion, 1) }} / 5</p>
                </div>
            </div>
        </div>

        <!-- Acciones de usuario sobre el libro -->

        @auth
        <div class="justify-center items-center flex flex-row gap-8 mt-16 mb-8">
            <h2 class="text-lg"><strong>Comprar el libro:</strong></h2>
            <a href="{{ route('purchaseCheckout', ['book_id' => $book->id]) }}" 
       class="bg-green-500 text-white font-semibold px-6 py-2 rounded-md hover:bg-green-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">
        Comprar
    </a>
        </div>
        
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-32 w-full max-w-4xl mx-auto">
        <div x-data="{ valoracion: {{ isset($book->valoracion) ? $book->valoracion : 0 }} }" class="mt-8 flex flex-col items-center space-y-4">
            <strong class="mb-4">Valora este libro:</strong>
            <div class="flex space-x-1">
                <template x-for="star in 5" :key="star">
                    <i class="fas fa-star text-yellow-300 cursor-pointer text-4xl mb-4"
                    @click="valoracion = star"
                    :class="valoracion >= star ? 'text-yellow-500' : 'text-gray-300'"></i>
                </template>
            </div>
            <form action="{{ route('rateBook', $book->id) }}" method="POST">
                @csrf
                <input type="hidden" name="valoracion" x-bind:value="valoracion">
                <button type="submit" class="bg-blue-500 text-black font-bold border-2 border-solid border-black px-6 py-2 rounded-md hover:bg-blue-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">Enviar valoración</button>
            </form>
        </div>
        <div class="mt-6 flex flex-col items-center space-y-2 w-full max-w-md">
    <strong>Envía un comentario:</strong>
    <form action="{{ route('comments.store') }}" method="POST" class="w-full space-y-2">
        @csrf
        <textarea name="comment" placeholder="Escribe tu comentario aquí..." rows="2"
                  class="w-full border border-gray-400 rounded-md p-3 text-black focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                  required></textarea>
                  @error('comment')
    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <div class="flex justify-center">
            <button class="w-60 bg-blue-500 text-black font-bold border-2 border-solid border-black px-6 py-2 rounded-md hover:bg-blue-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">
                Enviar comentario
            </button>
        </div>

    </form>
</div>

        </div>
        @endauth

        <!-- Caso de no estar logueado -->

       @guest
    <div class="flex justify-center text-xl items-center mt-16 mb-8">
        <div class="text-center bg-yellow-100 text-black px-6 py-4 rounded-lg shadow-md max-w-xl">
            <p class="text-xl font-semibold">¿Te interesa este libro?</p>
            <p class="mt-2">Regístrate o inicia sesión para poder comprar, valorar y comentar sobre este libro.</p>
        </div>
    </div>
@endguest

        <!-- Muestra de comentarios -->

        <div x-data="{ open: false }" class="mt-12 w-full max-w-4xl">
            <div @click="open = !open" class="flex items-center cursor-pointer select-none text-lg font-semibold text-[#322411]">
                <span class="flex items-center gap-2">
                    <i class="fas fa-comment-dots"></i> Comentarios
                </span>
                <svg :class="{'transform rotate-180': open}" class="w-5 h-5 ml-2 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                </svg>
            </div>

            <div x-show="open" x-transition class="mt-4 space-y-4">
            @forelse ($book->comments as $comment)
        <div class="p-4 border border-gray-300 rounded bg-amber-100 text-black text-lg relative">
        <p class="mb-2"><strong>{{ $comment->user->username ?? 'Anónimo' }}:</strong></p>
        <div class="p-4 border border-gray-300 rounded bg-white text-black text-lg relative">
            <p class="italic">"{{ $comment->comment }}"</p>
            <p class="text-sm">{{ \Carbon\Carbon::parse($comment->publish_date)->format('d/m/Y') }}</p>
        </div>

        @auth
            @if (Auth::id() === $comment->user_id)
                <form action="{{ route('comments.delete', $comment->id) }}" method="POST" class="absolute top-3 right-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-md">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </form>
            @endif
            @endauth
            </div>
        @empty
            <p class="text-gray-500">No hay comentarios aún.</p>
        @endforelse

            </div>
        </div>

    </div>

   <div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Libros:</h3>
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

</body>

@include('partials.footer')
</html>
