<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-48">

        <!-- Formulario para inicio de sesión -->

        <h1 class="text-center text-4xl font-semibold mb-8 text-[#322411]">LOGIN</h1>

        <form method="POST" action="{{ route('doLogin') }}"
    class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full max-w-4xl bg-amber-200 border-2 border-[#322411] rounded-2xl p-8">
    @csrf

    
    <div class="flex items-center justify-center">
        <img src="{{ asset('img/LogoInicial.jpg') }}" alt="Logo" class="w-62 h-auto">
    </div>

    
    <div class="space-y-4">

        <label for="email" class="block">
            <span class="block text-lg font-medium">Correo:</span>
            <div class="relative w-full">
                <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input type="email" name="email" id="email"
                    class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5"
                    placeholder="Escribe tu correo">
            </div>
            @error("email") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
        </label>

        <label for="password" class="block">
            <span class="block text-lg font-medium">Contraseña:</span>
            <div x-data="{ show: false }" class="relative w-full">
                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-800"></i>
                <input :type="show ? 'text' : 'password'" name="password" id="password"
                    class="w-full pl-10 p-2 border-2 border-solid border-black rounded-md mt-0.5" />
                <button type="button" @click="show = !show"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
            </div>
            @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
        </label>

        <br>

        <div class="flex flex-col sm:flex-row sm:justify-center sm:space-x-6 space-y-4 sm:space-y-0 mt-12">
    <button
        class="bg-green-500 w-72 font-bold text-black border-2 border-black px-8 py-2 rounded-md hover:bg-green-700 transition-transform duration-300 ease-in-out hover:scale-110"
        type="submit">Login</button>
    <button
        class="bg-red-500 w-72 font-bold text-black border-2 border-black px-8 py-2 rounded-md hover:bg-red-700 transition-transform duration-300 ease-in-out hover:scale-110"
        type="reset">Cancelar</button>
</div>

       <br>

        
<div class="flex flex-col sm:flex-row sm:justify-center sm:items-center sm:space-x-6 space-y-4 sm:space-y-0 mt-8">
    <p class="text-center w-52 text-md sm:text-left">¿Aún no estás registrado?</p>
    <a href="{{ route('register.show') }}"
        class="bg-blue-500 w-52 text-black font-bold border-2 border-black px-6 py-2 rounded-md hover:bg-blue-700 text-center transform transition-transform duration-300 ease-in-out hover:scale-110">
        Registrarse
    </a>
</div>

    </div>
</form>



        <div class="flex items-center gap-4 mt-8">
            <h3 class="text-lg">Volver a Home:</h3>
            <a href="{{ url('/') }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Home</a>
        </div>

        <section class="section_frases flex flex-col md:flex-row gap-6 mt-12 mb-12 px-4">
  
            <div class="bg-amber-200 p-4 rounded-md flex items-center justify-center md:w-1/3">
                <h3 class="text-black text-center text-lg">
                Una habitación sin libros es<br> como un cuerpo sin alma<br><br>
                <i>Marco Tulio Cicerón</i>
                </h3>
            </div>

            <img 
                src="{{ asset('img/book2.jpg') }}" 
                class="w-full md:w-96 h-auto object-cover rounded-md" 
                alt="Libros"
            >

            <div class="bg-amber-200 p-4 rounded-md flex items-center justify-center md:w-1/3">
                <h3 class="text-black text-center text-lg">
                Un clásico es un libro que nunca ha terminado<br> de decir lo que tiene que decir<br><br>
                <i>Italo Calvino</i>
                </h3>
            </div>
        </section>

    </main>

    @include('partials.footer')

</body>


</html>
