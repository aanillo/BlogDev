<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perfil</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerLog') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52 max-w-6xl mx-auto">

        <section class="text-center mb-8 w-full">
            <h1 class="text-4xl font-bold text-[#322411]">PERFIL</h1>

            <div class="flex flex-col md:flex-row gap-8 mt-8 w-full justify-center items-start">

                <!-- Datos del perfil autenticado -->

                <div class="flex flex-col md:flex-row gap-8 flex-grow bg-amber-200 shadow-lg rounded-xl p-6 md:p-10">
                    <div class="w-60 h-60 flex-shrink-0 mt-8">
                        <img src="{{ asset('img/book.jpg') }}" alt="Foto de perfil" class="w-full h-full object-cover rounded-full border border-gray-300" />
                    </div>

                    <div class="text-left text-black space-y-4 text-xl flex-grow">
                        <p><strong>Nombre: </strong>{{ $user->nombre }}</p>
                        <p><strong>Apellidos: </strong>{{ $user->apellidos }}</p>
                        <p><strong>Username: </strong>{{ $user->username }}</p>
                        <p><strong>Correo: </strong>{{ $user->email }}</p>
                        <p><strong>Localidad: </strong>{{ $user->localidad }}</p>
                        <p><strong>Fecha nacimiento: </strong>{{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</p>
                        <p><strong>Fecha de registro: </strong>{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

               
                <div class="flex flex-col justify-center mt-8 gap-8 min-w-[220px]">
                    <div class="flex flex-col items-center">
                        <h3 class="text-lg mb-2">Editar perfil:</h3>
                        <a href="{{ route('editProfile', ['id' => $user->id]) }}" class="btnHome bg-blue-500 w-52 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-blue-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">Editar</a>
                    </div>

                    <div class="flex flex-col items-center">
                        <h3 class="text-lg mb-2">Cambiar contraseña:</h3>
                        <a href="{{ route('editPsw', ['id' => $user->id]) }}" class="btnHome bg-yellow-500 w-52 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">Reestablecer</a>
                    </div>

                    <div class="flex flex-col items-center">
                        <h3 class="text-lg mb-2">Eliminar cuenta:</h3>
                        <a href="{{ route('deleteShow', ['id' => $user->id]) }}" class="btnHome bg-red-500 w-52 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-red-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">Eliminar</a>
                    </div>
                </div>

            </div>
        </section>

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
