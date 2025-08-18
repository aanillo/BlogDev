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

<body class="flex flex-col min-h-screen bg-neutral-100 font-[Courier New] text-black">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center px-6 mt-48">

        <h1 class="text-4xl md:text-6xl font-extrabold text-center text-lime-600 underline mb-12 tracking-tight">PERFIL</h1>

        <section class="w-[80%] px-10 py-12 bg-white border border-neutral-300 rounded-2xl shadow-lg mb-12">

            <!-- Avatar + nombre -->
            <div class="flex flex-col items-center mb-10">
                <div class="flex justify-center w-[50%] items-center bg-neutral-800 px-8 py-4 rounded-lg shadow text-lime-500 text-center border-2 border-lime-500 transition transform hover:scale-105">
                    <h1 class="text-4xl md:text-5xl font-bold">{{ $user->username }}</h1>
                </div>
                <span class="mt-4 inline-block bg-neutral-700 text-lime-500 text-lg font-semibold px-4 py-1 rounded-full shadow">
                    Rol: {{ ucfirst($user->rol) }}
                </span>
            </div>

            <!-- Información -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Detalles -->
                <div class="flex flex-col gap-6 text-xl">

                    <div class="flex flex-col gap-2">
                        <h2 class="text-2xl font-bold border-b border-lime-400 pb-1 mb-2"><i class="fas fa-user-circle mr-2 text-lime-500"></i>Información personal</h2>
                        <p><i class="fas fa-user mr-2 text-lime-500"></i><strong>Username:</strong> {{ $user->username }}</p>
                        <p><i class="fas fa-envelope mr-2 text-lime-500"></i><strong>Correo:</strong> {{ $user->email }}</p>
                        <p><i class="fas fa-birthday-cake mr-2 text-lime-500"></i><strong>Fecha nacimiento:</strong> {{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</p>
                        <p><i class="fas fa-calendar-plus mr-2 text-lime-500"></i><strong>Fecha registro:</strong> {{ \Carbon\Carbon::parse($user->fecha_registro)->format('d/m/Y') }}</p>
                        <p><i class="fas fa-clock mr-2 text-lime-500"></i><strong>Última actualización:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h2 class="text-2xl font-bold border-b border-lime-400 pb-1 mb-2 mt-6"><i class="fas fa-chart-line mr-2 text-lime-500"></i>Actividad</h2>
                        <p><i class="fas fa-pen mr-2 text-lime-500"></i><strong>Posts publicados:</strong> {{ $numPosts }}</p>
                        <p><i class="fas fa-comment-dots mr-2 text-lime-500"></i><strong>Comentarios realizados:</strong> {{ $numComments }}</p>
                        <a href="{{ route('user.posts', ['id' => auth()->user()->id]) }}"><button
                            class="w-[50%] mt-6 bg-lime-600 border-2 border-lime-700 text-white text-lg font-bold py-2 rounded-lg transition transform hover:bg-lime-700 hover:scale-105">
                            Ver tus posts
                        </button>
                        </a>
                    </div>

                </div>

                <!-- Imagen decorativa -->
               <div class="flex justify-center items-center">
    <img src="{{ asset('img/computer.jpg') }}"
         class="w-full mt-10 md:w-[500px] lg:w-[600px] max-h-[500px] object-cover rounded-xl shadow-lg"
         alt="imagen decorativa">
</div>

            </div>

            <div class="flex flex-wrap justify-center gap-10 mt-20">

    <!-- Botón Home -->
    <a href="{{ url('/') }}"
       class="flex flex-col items-center justify-center gap-2 px-8 py-3 w-60 text-xl border-2 border-black bg-purple-600 text-black font-bold rounded-md hover:bg-purple-700 transition transform hover:scale-105">
        <i class="fas fa-home text-2xl"></i>
        <span>Home</span>
    </a>

    <!-- Botón Editar Perfil -->
    <a href="{{ route('editProfile', ['id' => $user->id]) }}"
       class="flex flex-col items-center justify-center gap-2 px-8 py-3 w-60 text-xl border-2 border-black bg-indigo-500 text-black font-bold rounded-md hover:bg-indigo-600 transition transform hover:scale-105">
        <i class="fas fa-user-edit text-2xl"></i>
        <span>Editar perfil</span>
    </a>

    <!-- Botón Restablecer Contraseña -->
    <a href="{{ route('editPsw', ['id' => $user->id]) }}"
       class="flex flex-col items-center justify-center gap-2 px-8 py-3 w-60 text-xl border-2 border-black bg-yellow-500 text-black text-center font-bold rounded-md hover:bg-yellow-600 transition transform hover:scale-105">
        <i class="fas fa-key text-2xl"></i>
        <span>Restablecer contraseña</span>
    </a>

    <!-- Botón Eliminar Perfil -->
    <a href="{{ route('deleteShow', ['id' => $user->id]) }}"
       class="flex flex-col items-center justify-center gap-2 px-8 py-3 w-60 text-xl border-2 border-black bg-red-500 text-black font-bold rounded-md hover:bg-red-600 transition transform hover:scale-105">
        <i class="fas fa-user-slash text-2xl"></i>
        <span>Eliminar perfil</span>
    </a>

</div>



        </section>

    </main>

    @include('partials.footer')

</body>
</html>
