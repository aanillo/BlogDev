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

    @include('partials.headerAdmin')

    <main class="flex-grow flex flex-col items-center bg-neutral-100 text-black px-6 mt-48">

        <form
            method="POST"
            action="{{ route('updateUsers', $user->id) }}"
            class="w-full max-w-7xl px-12 py-6 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8"
        >
            @csrf
            @method('PUT')

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">EDITAR PERFIL</h1>

            <!-- Contenedor de dos columnas (Formulario + Imagen) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 gap-y-4">

                <!-- Columna formulario -->
                <div class="flex flex-col gap-10 mt-8">

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

                </div>

                <!-- Columna derecha (Avatar) -->
<div class="flex flex-col justify-center items-center mt-12 sm:mt-8" x-data="{ avatar: '{{ old('avatar', $user->avatar) }}' }">

    <h3 class="text-2xl font-bold text-lime-400 mb-4">Elige tu avatar</h3>

    <!-- Avatar mostrado -->
    <img 
        :src="'{{ asset('') }}' + avatar" 
        class="w-48 h-48 object-cover rounded-full mb-4 border-4 border-lime-300" 
        alt="avatar seleccionado"
    >

    <!-- Botones para cambiar -->
    <div class="flex gap-6 mb-4">
        <button 
            type="button"
            class="px-4 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700"
            @click="avatar = 'avatar/hombre1.png'"
            :class="{ 'ring-4 ring-lime-400': avatar === 'avatar/hombre1.png' }"
        >
            1
        </button>

        <button 
            type="button"
            class="px-4 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700"
            @click="avatar = 'avatar/mujer1.png'"
            :class="{ 'ring-4 ring-lime-400': avatar === 'avatar/mujer1.png' }"
        >
            2
        </button>
        <button 
            type="button"
            class="px-4 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700"
            @click="avatar = 'avatar/hombre2.png'"
            :class="{ 'ring-4 ring-lime-400': avatar === 'avatar/hombre2.png' }"
        >
            3
        </button>

        <button 
            type="button"
            class="px-4 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700"
            @click="avatar = 'avatar/mujer2.png'"
            :class="{ 'ring-4 ring-lime-400': avatar === 'avatar/mujer2.png' }"
        >
            4
        </button>
    </div>

    <!-- Campo oculto para enviar avatar -->
    <input type="hidden" name="avatar" :value="avatar">

    @error("avatar")
    <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
    @enderror
                    
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-16 mb-8 mt-6">
                <div class="flex flex-col sm:flex-row gap-6 mt-14 mb-6 w-full justify-center mt-8 sm:mt-24">
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
                    <div class="flex flex-col sm:flex-row items-center gap-8 mt-8 mb-6 sm:mb-0 w-full justify-center">

                        <!-- Botón Atrás -->
                        <div class="flex flex-col items-center w-full sm:w-auto mt-8 sm:mt-2">
                            <h3 class="text-xl text-lime-300 mb-2">Volver atrás:</h3>
                            <a
                                href="{{ url()->previous() }}"
                                class="w-full sm:w-64 bg-purple-800 text-lime-200 text-xl text-center font-bold border-2 border-lime-200 px-10 py-2 rounded-md hover:bg-purple-900 transform transition-transform duration-300 ease-in-out hover:scale-110"
                            >
                                Atrás
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
