<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar cierre de sesión</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">
    @if(Auth::check() && Auth::user()->rol === 'admin')
        @include('partials.headerAdmin')
    @else
        @include('partials.headerLog')
    @endif

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-64">
        <h1 class="text-4xl font-bold mb-6 text-center text-[#322411]">¿Seguro que deseas cerrar sesión?</h1>
        <div class="flex justify-center mt-8 gap-24">
            <div class="flex flex-col items-center">
                <h3 class="text-lg">Cerrar sesión:</h3>
                <a href="{{ route("logout") }}" class="btnHome bg-blue-500 text-black font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-blue-700 transform transition-transform duration-1000 ease-in-out hover:scale-110">Logout</a>
            </div>

            <div class="flex flex-col items-center">
                <h3 class="text-lg">Volver atrás:</h3>
                <a href="{{ url()->previous() }}" class="btnHome bg-amber-200 text-[#322411] font-bold border-2 border-solid border-black px-10 py-1.5 rounded-md hover:bg-yellow-600 transform transition-transform duration-1000 ease-in-out hover:scale-110">Volver</a>
            </div>
        </div>
        <img class="mt-16 mb-16" src="{{ asset('img/LogoInicial.jpg') }}" width="200px" />
    </main>

    @include('partials.footer')
</body>