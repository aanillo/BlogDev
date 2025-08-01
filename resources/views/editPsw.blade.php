<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerLog') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">

    <!-- Formulario para restablecer contraseña -->
        
    <h1 class="text-center text-3xl font-semibold mb-8">Editar Usuario</h1>

    <h2 class="text-center text-2xl font-semibold mb-6">{{ $user->nombre }} {{ $user->apellidos }}</h2>

    <form method="POST" action="{{ route('updatePsw', $user->id) }}"
        class="w-full max-w-2xl min-h-[300px] px-12 py-6 bg-amber-200 border-2 border-[#322411] rounded-2xl flex flex-col space-y-4">
        @csrf
        @method('PUT')

        <label for="password" class="w-full text-left" x-data="{ show: false }">
    <span class="block text-lg font-medium mb-1">Contraseña:</span>
    <div class="relative w-full mx-auto">
        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
        <input :type="show ? 'text' : 'password'" name="password" id="password"
            class="w-full pl-10 p-2 border-2 border-black rounded-md">
        <button type="button" @click="show = !show"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm">
            <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
        </button>
    </div>
</label>


<label for="password_repeat" class="w-full text-left" x-data="{ repeat: '', original: '', show: false }"
       x-init="original = document.getElementById('password').value">
    <span class="block text-lg font-medium mb-1">Repita su contraseña:</span>
    <div class="relative w-full mx-auto">
        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
        <input
            :type="show ? 'text' : 'password'"
            name="password_repeat"
            id="password_repeat"
            x-model="repeat"
            class="w-full pl-10 p-2 border-2 border-black rounded-md"
            @input="original = document.getElementById('password').value"
        >
        <template x-if="repeat && repeat === original">
            <i class="fas fa-check-circle absolute right-10 top-1/2 transform -translate-y-1/2 text-green-500"></i>
        </template>
        <template x-if="repeat && repeat !== original">
            <i class="fas fa-times-circle absolute right-10 top-1/2 transform -translate-y-1/2 text-red-500"></i>
        </template>
        <button
            type="button"
            @click="show = !show"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm"
            tabindex="-1"
        >
            <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
        </button>
    </div>
</label>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-16 mt-16">
                <button class="bg-green-500 w-52 font-bold mt-4 mb-4 text-black border-2 border-black px-6 py-2 rounded-md hover:bg-green-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                    type="submit">Actualizar</button>
                <button class="bg-red-500 w-52 font-bold mt-4 mb-4 text-black border-2 border-black px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                    type="reset">Cancelar</button>
            </div>
    </form>

        <div class="flex flex-col md:flex-row items-center gap-6 md:gap-16 mb-16 mt-16 w-full justify-center">
        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver atrás:</h3>
            <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
        </div>

        <br>

        <div class="flex items-center gap-4">
            <h3 class="text-lg">Volver a Home:</h3>
            @auth
                <a href="{{ route("home") }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @else
                <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
            @endauth
        </div>
   </div> 

        <img src="{{ asset('img/book2.jpg') }}" class="w-80 h-auto my-6 mb-16" alt="Libro" />

    </main>

    @include('partials.footer')

</body>
</html>
