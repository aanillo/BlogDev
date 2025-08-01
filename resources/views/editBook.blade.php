<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar libro</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">
        
    <h1 class="text-center text-3xl font-semibold mb-8">Editar libro</h1>

    <!-- Formulario para editar libro -->
    
    <h2 class="text-center text-2xl font-semibold mb-6">{{ $book->titulo }}</h2>

    <form method="POST" action="{{ route('update', $book->id) }}" 
        class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4 w-full max-w-4xl min-h-[500px] px-12 py-6 bg-amber-200 border-2 border-[#322411] rounded-2xl">
        @csrf
        @method('PUT')

        <label for="titulo" class="text-left">
            <span class="block text-lg font-medium">Título:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-book absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $book->titulo) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Título del libro">
            </div>
        </label>
        @error("titulo") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="imagen" class="text-left">
            <span class="block text-lg font-medium">URL de la imagen:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-image absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="url" name="imagen" id="imagen" value="{{ old('imagen', $book->imagen) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="https://...">
            </div>
        </label>
        @error("imagen") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="autor_id" class="text-left">
            <span class="block text-lg font-medium">Autor:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-user-edit absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <select name="autor_id" id="autor_id" class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1">
                    <option value="" disabled selected>Selecciona un autor</option>
                    @foreach($writers as $writer)
                        <option value="{{ $writer->id }}" {{ $writer->id == old('autor_id', $book->autor_id) ? 'selected' : '' }}>
                            {{ $writer->id }} - {{ $writer->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </label>
        @error("autor_id") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="genero" class="text-left">
            <span class="block text-lg font-medium">Género:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-tags absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="genero" id="genero" value="{{ old('genero', $book->genero) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Ej: Fantasía, Romance...">
            </div>
        </label>
        @error("genero") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="editorial" class="text-left">
            <span class="block text-lg font-medium">Editorial:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-building absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="editorial" id="editorial" value="{{ old('editorial', $book->editorial) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Nombre de la editorial">
            </div>
        </label>
        @error("editorial") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="fecha_creacion" class="text-left">
            <span class="block text-lg font-medium">Año de publicación:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="number" name="fecha_creacion" id="fecha_creacion" value="{{ old('fecha_creacion', $book->fecha_creacion) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Ej: 2022">
            </div>
        </label>
        @error("fecha_creacion") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="descripcion" class="text-left">
            <span class="block text-lg font-medium">Descripción:</span>
            <div class="relative w-full mx-auto">
                <textarea name="descripcion" id="descripcion" class="w-full p-2 border-2 border-black rounded-md mt-1 resize-none"
                    rows="4" placeholder="Describe brevemente el libro...">{{ old('descripcion', $book->descripcion) }}</textarea>
            </div>
        </label>
        @error("descripcion") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="valoracion" class="text-left">
    <span class="block text-lg font-medium">Valoración:</span>
    <div class="relative w-full mx-auto">
        <i class="fas fa-star absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
        <p class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1 text-center">
            {{ $book->valoracion }} 
        </p>
    </div>
</label>
@error("valoracion") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="precio" class="text-left">
            <span class="block text-lg font-medium">Precio (€):</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-euro-sign absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $book->precio) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Ej: 19.95">
            </div>
        </label>
        @error("precio") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <div class="col-span-full flex flex-col sm:flex-row justify-center items-center gap-32 mt-4">
            <button class="bg-green-500 w-72 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-green-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                type="submit">Actualizar Libro</button>
            <button class="bg-red-500 w-72 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                type="reset">Cancelar</button>
        </div>
    </form>

    <div class="flex items-center gap-4 mb-8 mt-16">
        <h3 class="text-lg">Volver atrás:</h3>
        <a href="{{ route('admin.books') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Libros</a>
    </div>

    <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a la vista principal:</h3>
        <a href="{{ route('admin') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
    </div>

    </main>

    @include('partials.footer')

</body>
</html>
