<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>El rincón del dev</title>
    <link rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="{{ url('/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen text-white bg-neutral-100 font-[Courier New]">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center bg-neutral-100 text-black px-6 mt-40">

        <form
            method="POST"
            action="{{ route('updatePsw', $user->id) }}"
            class="w-full max-w-7xl px-12 pt-6 pb-4 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8"
        >
            @csrf
            @method('PUT')

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">RESTABLECER CONTRASEÑA</h1>

            <!-- Contenedor de dos columnas (Formulario + Imagen) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-2 min-h-[430px]">

                <!-- Columna formulario -->
                <div class="flex flex-col gap-14 mt-4">

                    <label for="password" class="text-left" x-data="{ show: false }">
                        <span class="block text-lg font-medium">Contraseña:</span>
                        <div class="relative w-full mx-auto">
                            <i
                                class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"
                            ></i>
                            <input
                                :type="show ? 'text' : 'password'"
                                name="password"
                                id="password"
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                            />
                            <button
                                type="button"
                                @click="show = !show"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lime-200 text-sm"
                            >
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                        @error("password")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>

                    <label
                        for="password_repeat"
                        class="text-left"
                        x-data="{ repeat: '', original: '', show: false }"
                        x-init="original = document.getElementById('password').value"
                    >
                        <span class="block text-lg font-medium">Repita su contraseña:</span>
                        <div class="relative w-full mx-auto">
                            <i
                                class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-lime-200"
                            ></i>
                            <input
                                :type="show ? 'text' : 'password'"
                                name="password_repeat"
                                id="password_repeat"
                                x-model="repeat"
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                                @input="original = document.getElementById('password').value"
                            />
                            <template x-if="repeat && repeat === original">
                                <i
                                    class="fas fa-check-circle absolute right-10 top-1/2 transform -translate-y-1/2 text-green-500"
                                ></i>
                            </template>
                            <template x-if="repeat && repeat !== original">
                                <i
                                    class="fas fa-times-circle absolute right-10 top-1/2 transform -translate-y-1/2 text-red-500"
                                ></i>
                            </template>
                            <button
                                type="button"
                                @click="show = !show"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lime-200 text-sm"
                            >
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                        @error("password_repeat")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>
                

                    <!-- Botones Registrarse y Cancelar debajo de los campos -->
                    <div class="flex flex-col sm:flex-row gap-6 mt-12 mb-6 w-full">
                        <button
                            type="submit"
                            class="w-full sm:w-64 bg-green-800 font-bold text-lime-300 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-green-900 transition-transform duration-300 ease-in-out hover:scale-110 text-center"
                        >
                            Editar
                        </button>
                        <button
                            type="reset"
                            class="w-full sm:w-64 bg-red-600 font-bold text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-300 ease-in-out hover:scale-110 text-center"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>

                <!-- Columna imagen -->
                <div class="flex flex-col items-center mt-10">
                    <img
                        src="{{ asset('img/security.jpg') }}"
                        class="w-full md:w-72 h-auto object-cover rounded-md mb-6"
                        alt="imagen"
                    />

                    <!-- Botón Volver a Home debajo de la imagen -->
                    <div class="flex flex-col sm:flex-row items-center gap-8 mt-8 mb-6 sm:mb-0 w-full justify-center">
    
    <!-- Botón Atrás -->
    <div class="flex flex-col items-center w-full sm:w-auto">
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
        </form>
    </main>

    @include('partials.footer')

</body>
</html>
