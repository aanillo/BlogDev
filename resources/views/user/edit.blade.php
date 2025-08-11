<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>El rincón del dev</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen text-white bg-neutral-100 font-[Courier New]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-neutral-100 text-black px-6 mt-48">

        <form
            method="POST"
            action="{{ route('updateProfile', $user->id) }}"
            class="w-full max-w-7xl px-12 py-6 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8"
        >
            @csrf
            @method('PUT')

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">EDITAR PERFIL</h1>

            <!-- Contenedor de dos columnas (Formulario + Imagen) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4 min-h-[500px]">

                <!-- Columna formulario -->
                <div class="flex flex-col gap-10 mt-4">

                    <label for="username" class="text-left">
                        <span class="block text-lg font-medium">Username:</span>
                        <div class="relative w-full mx-auto">
                            <i
                                class="fas fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"
                            ></i>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                value="{{ old('username', $user->username) }}"
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                                placeholder="Escribe tu username"
                            />
                        </div>
                        @error("username")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>

                    <label for="email" class="text-left">
                        <span class="block text-lg font-medium">Correo:</span>
                        <div class="relative w-full mx-auto">
                            <i
                                class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"
                            ></i>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                                placeholder="Escribe tu correo"
                            />
                        </div>
                        @error("email")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>

                    <label for="fecha_nacimiento" class="text-left">
                        <span class="block text-lg font-medium">Fecha de nacimiento:</span>
                        <div class="relative w-full mx-auto">
                            <i
                                class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"
                            ></i>
                            <input
                                type="date"
                                name="fecha_nacimiento"
                                id="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}"
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                            />
                        </div>
                        @error("fecha_nacimiento")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>

                    

                    <!-- Botones Registrarse y Cancelar debajo de los campos -->
                    <div class="flex flex-row gap-10 mt-10 mb-6">
                        <button
                            type="submit"
                            class="bg-green-800 font-bold w-40 sm:w-64 text-lime-300 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-green-900 transition-transform duration-300 ease-in-out hover:scale-110"
                        >
                            Editar
                        </button>
                        <button
                            type="reset"
                            class="bg-red-600 font-bold w-40 sm:w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-300 ease-in-out hover:scale-110"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>

                <!-- Columna imagen -->
                <div class="flex flex-col justify-center items-center">
                    <img
                        src="{{ asset('img/dev.jpg') }}"
                        class="w-full md:w-96 h-auto object-cover rounded-md mb-6"
                        alt="imagen"
                    />

                    <!-- Botón Volver a Home debajo de la imagen -->
                    <div class="flex flex-col items-center gap-2 mt-8">
    
    <div class="flex flex-row gap-8">
    <!-- Botón Atrás -->
    <div class="flex flex-col items-center">
        <h3 class="text-xl text-lime-300 mb-2">Volver atrás:</h3>
        <a
            href="{{ url()->previous() }}"
            class="w-40 sm:w-64 bg-purple-800 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-1.5 rounded-md hover:bg-purple-900 transform transition-transform duration-1000 ease-in-out hover:scale-110"
        >
            Atrás
        </a>
    </div>

    <!-- Botón Home -->
    <div class="flex flex-col items-center">
        <h3 class="text-xl text-lime-300 mb-2">Volver a Inicio:</h3>
        <a
            href="{{ url('/') }}"
            class="w-40 sm:w-64 bg-purple-800 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-1.5 rounded-md hover:bg-purple-900 transform transition-transform duration-1000 ease-in-out hover:scale-110"
        >
            Home
        </a>
    </div>
</div>

</div>

                </div>
            </div>
        </form>
    </main>

    @include('partials.footer')

</body>
</html>
