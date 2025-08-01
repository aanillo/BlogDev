<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar escritor</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">

    <!-- Formulario para editar escritor -->
        
    <h1 class="text-center text-3xl font-semibold mb-8">Editar Autor</h1>

    
    <h2 class="text-center text-2xl font-semibold mb-6">{{ $writer->nombre }}</h2>

    <form method="POST" action="{{ route('updateWriter', $writer->id) }}" 
        class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4 w-full max-w-4xl min-h-[500px] px-12 py-6 bg-amber-200 border-2 border-[#322411] rounded-2xl">
        @csrf
        @method('PUT')

        <label for="nombre" class="text-left">
            <span class="block text-lg font-medium">Nombre:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $writer->nombre) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Nombre del autor">
            </div>
        </label>
        @error("nombre") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="imagen" class="text-left">
            <span class="block text-lg font-medium">URL de la imagen:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-image absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="url" name="imagen" id="imagen" value="{{ old('imagen', $writer->imagen) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="https://...">
            </div>
        </label>
        @error("imagen") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="nombre_completo" class="text-left">
            <span class="block text-lg font-medium">Nombre Completo:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-user-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo', $writer->nombre_completo) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="Nombre completo del autor">
            </div>
        </label>
        @error("nombre_completo") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="pais" class="text-left">
            <span class="block text-lg font-medium">País:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-flag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="text" name="pais" id="pais" value="{{ old('pais', $writer->pais) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="País de origen">
            </div>
        </label>
        @error("pais") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="nacimiento" class="text-left">
            <span class="block text-lg font-medium">Fecha de Nacimiento:</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="date" name="nacimiento" id="nacimiento" value="{{ old('nacimiento', $writer->nacimiento) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="AAAA-MM-DD">
            </div>
        </label>
        @error("nacimiento") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <label for="fallecimiento" class="text-left">
            <span class="block text-lg font-medium">Fecha de Fallecimiento (opcional):</span>
            <div class="relative w-full mx-auto">
                <i class="fas fa-calendar-times absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="date" name="fallecimiento" id="fallecimiento" value="{{ old('fallecimiento', $writer->fallecimiento) }}"
                    class="w-full pl-10 p-2 border-2 border-black rounded-md mt-1"
                    placeholder="AAAA-MM-DD">
            </div>
        </label>
        @error("fallecimiento") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror

        <div class="col-span-full flex flex-col sm:flex-row justify-center items-center gap-32 mt-4">
            <button class="bg-green-500 w-72 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-green-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                type="submit">Actualizar Autor</button>
            <button class="bg-red-500 w-72 font-bold text-black border-2 border-black px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                type="reset">Cancelar</button>
        </div>
    </form>

    <div class="flex items-center gap-4 mb-8 mt-16">
        <h3 class="text-lg">Volver atrás:</h3>
        <a href="{{ route('admin.writers') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Autores</a>
    </div>

    <div class="flex items-center gap-4 mb-16 mt-8">
        <h3 class="text-lg">Volver a la vista principal:</h3>
        <a href="{{ route('admin') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
    </div>

    </main>

    @include('partials.footer')

</body>
</html>
