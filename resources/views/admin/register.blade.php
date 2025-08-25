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

        <!-- Formulario de registro -->
        <form
            method="POST"
            action="{{ route('doInsertUser') }}"
            class="w-full max-w-7xl px-12 py-6 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8"
        >
            @csrf

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">REGISTRO</h1>

            <!-- Contenedor de dos columnas (Formulario + Imagen) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4 min-h-[500px]">

                <!-- Columna formulario -->
                <div class="flex flex-col gap-4">

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
                                class="w-full pl-10 p-2 border border-lime-200 bg-neutral-700 text-lime-200 rounded-md mt-1"
                            />
                        </div>
                        @error("fecha_nacimiento")
                        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
                        @enderror
                    </label>

                    <label class="text-left block">
    <span class="block text-lg font-medium">Rol:</span>

    <div class="flex gap-6 mt-1">
        <label class="flex items-center gap-2">
            <input type="radio" name="rol" value="user" checked class="accent-lime-300" />
            <span>User</span>
        </label>

        <label class="flex items-center gap-2">
            <input type="radio" name="rol" value="admin" class="accent-lime-300" />
            <span>Admin</span>
        </label>
    </div>

    @error('rol')
        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
    @enderror
</label>


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
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-10 w-full justify-center mt-4 mb-4">
                        <button
                            type="submit"
                            class="bg-green-800 font-bold w-full sm:w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-green-900 transition-transform duration-300 ease-in-out hover:scale-110"
                        >
                            Registrarse
                        </button>
                        <button
                            type="reset"
                            class="bg-red-600 font-bold w-full sm:w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-300 ease-in-out hover:scale-110"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>

                <!-- Columna imagen -->
                <div class="flex flex-col justify-center items-center">
                    <img
                        src="{{ asset('img/register.png') }}"
                        class="w-full md:w-96 h-auto object-cover rounded-md mb-6"
                        alt="imagen"
                    />

                    <!-- Botón Volver a Home debajo de la imagen -->
                    <div class="flex flex-col items-center gap-2 mt-16">
                        <h3 class="text-xl text-lime-300 mb-2">Volver atrás:</h3>
                        <a
                            href="{{ url()->previous() }}"
                            class="btnHome w-64 bg-purple-800 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-1.5 rounded-md hover:bg-purple-900 transform transition-transform duration-1000 ease-in-out hover:scale-110"
                        >
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </main>

    @include('partials.footer')

</body>
</html>
