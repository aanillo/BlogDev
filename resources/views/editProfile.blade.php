<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerLog')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">

        <!-- Formulario para editar perfil -->

        <h1 class="text-center text-3xl font-semibold mb-8">Editar Usuario</h1>

        <h2 class="text-center text-2xl font-semibold mb-6">{{ $user->nombre }} {{ $user->apellidos }}</h2>

        <form method="POST" action="{{ route('updateProfile', $user->id) }}"
    class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4 w-full max-w-4xl min-h-[500px] px-12 py-6 bg-amber-200 border-2 border-[#322411] rounded-2xl">
    @csrf
    @method('PUT')

    <label for="nombre" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Nombre:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md"
                placeholder="Escribe tu nombre">
        </div>
        @error("nombre") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <label for="apellidos" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Apellidos:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-user-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $user->apellidos) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md"
                placeholder="Escribe tus apellidos">
        </div>
        @error("apellidos") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <label for="username" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Username:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md"
                placeholder="Escribe tu username">
        </div>
        @error("username") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <label for="email" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Correo:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md"
                placeholder="Escribe tu correo">
        </div>
        @error("email") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <label for="fecha_nacimiento" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Fecha de nacimiento:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md">
        </div>
        @error("fecha_nacimiento") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <label for="localidad" class="w-full text-left">
        <span class="block text-lg font-medium mb-1">Localidad:</span>
        <div class="relative w-full mx-auto">
            <i class="fas fa-map-marker-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
            <input type="text" name="localidad" id="localidad" value="{{ old('localidad', $user->localidad) }}"
                class="w-full pl-10 p-2 border-2 border-black rounded-md"
                placeholder="Escribe la localidad">
        </div>
        @error("localidad") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
    </label>

    <div class="col-span-full flex flex-col sm:flex-row justify-center items-center gap-32 mt-4">
        <button
            class="bg-green-500 font-bold w-72 text-black border-2 border-black px-6 py-2 rounded-md hover:bg-green-700 transition-transform duration-300 ease-in-out hover:scale-110"
            type="submit">Actualizar Usuario</button>
        <button
            class="bg-red-500 font-bold w-72 text-black border-2 border-black px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
            type="reset">Cancelar</button>
    </div>
</form>


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

</body>
</html>
