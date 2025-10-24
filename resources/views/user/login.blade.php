<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El rincón del dev</title>
    <link rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="{{ url('/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen text-white bg-neutral-100 font-[Courier New]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-neutral-100 text-black px-6 mt-40">

        <!-- Formulario para inicio de sesión -->
        <form method="POST" action="{{ route('doLogin') }}"
              class="w-full max-w-7xl px-12 py-6 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8">
            @csrf

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">LOGIN</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4">
                <!-- Columna de campos y botones -->
                <div class="flex flex-col gap-10 mt-8">

                    <label for="login" class="text-left">
                        <span class="block text-lg font-medium">Correo o Username:</span>
                        <div class="relative w-full mx-auto">
                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"></i>
                            <input type="text" name="login" id="login"
                                    value="{{ old('login') }}"
                                   class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                                   placeholder="Escribe tu correo o username">
                        </div>
                        @error("login") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
                    </label>

                    <label for="password" class="text-left" x-data="{ show: false }">
                        <span class="block text-lg font-medium">Contraseña:</span>
                        <div class="relative w-full mx-auto">
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"></i>
                            <input :type="show ? 'text' : 'password'" name="password" id="password"
                                   class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1">
                            <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lime-200 text-sm">
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                        @error("password") <small class="text-red-500 text-lg font-bold">{{ $message }}</small> @enderror
                    </label>

                    <!-- Botones debajo de los campos -->
                    <div class="flex flex-col items-center gap-6 mt-4">

                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-10 w-full justify-center">
                            <button type="submit"
                                class="bg-green-800 font-bold w-full sm:w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-green-900 transition-transform duration-300 ease-in-out hover:scale-110">
                                Iniciar sesión
                            </button>

                            <button type="reset"
                                class="bg-red-600 font-bold w-full sm:w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-300 ease-in-out hover:scale-110">
                                Cancelar
                            </button>
                        </div>

                        <div class="text-center mt-4 mb-10">
                            <h3 class="text-xl mb-2">¿Aún no estás registrado? Hazlo aquí:</h3>
                            <a href="{{ route('register.show') }}"
                               class="inline-block w-full sm:w-72 bg-indigo-700 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-1.5 rounded-md hover:bg-indigo-800 transform transition-transform duration-500 ease-in-out hover:scale-110">
                                Regístrate
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Columna de imagen + Home -->
                <div class="flex flex-col justify-center items-center gap-8 mt-12 sm:mt-0">
                    <img src="{{ asset('img/logo.png') }}"
                         class="w-full md:w-80 h-auto object-cover border-2 border-lime-300 rounded-full"
                         alt="logo">

                    <!-- Volver a Home debajo de la imagen -->
                    <div class="flex flex-col items-center gap-2 mb-8">
                        <h3 class="text-xl">Volver a Home:</h3>
                        <a href="{{ url('/') }}"
                           class="btnHome w-52 sm:w-72 bg-purple-800 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-1.5 rounded-md hover:bg-purple-900 transform transition-transform duration-1000 ease-in-out hover:scale-110">
                            Home
                        </a>
                    </div>
                </div>
            </div>

        </form>

    </main>

    @include('partials.footer')

</body>
</html>
