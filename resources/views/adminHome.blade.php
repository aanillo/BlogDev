<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-36">

    <!-- Enlaces a los diferentes elementos -->

    <section class="flex-grow flex flex-row items-center gap-8">
 
        <div class="flex-grow flex flex-col items-center text-center">
            <h1 class="text-3xl mb-8 font-bold">USUARIOS</h1>
            <a href="{{ route('admin.users') }}" class="w-52 h-52 bg-amber-100 flex items-center justify-center text-8xl mb-8 border-2 border-solid border-gray-800 rounded-lg p-4 hover:bg-amber-200">
            <i class="fas fa-users"></i> 
            </a>
        </div>

        
        <div class="flex-grow flex flex-col items-center text-center">
            <h1 class="text-3xl mb-8 font-bold">LIBROS</h1>
            <a href="{{ route('admin.books') }}" class="w-52 h-52 bg-amber-100 flex items-center justify-center text-8xl mb-8 border-2 border-solid border-gray-800 rounded-lg p-4 hover:bg-amber-200">
            <i class="fas fa-book"></i> 
            </a>
        </div>

        
        <div class="flex-grow flex flex-col items-center text-center">
            <h1 class="text-3xl mb-8 font-bold">AUTORES</h1>
            <a href="{{ route('admin.writers') }}" class="w-52 h-52 bg-amber-100 flex items-center justify-center text-8xl mb-8 border-2 border-solid border-gray-800 rounded-lg p-4 hover:bg-amber-200">
            <i class="fas fa-pen"></i> 
            </a>
        </div>

        <div class="flex-grow flex flex-col items-center text-center">
            <h1 class="text-3xl mb-8 font-bold">COMENTARIOS</h1>
            <a href="{{ route('admin.comments') }}" class="w-52 h-52 bg-amber-100 flex items-center justify-center text-8xl mb-8 border-2 border-solid border-gray-800 rounded-lg p-4 hover:bg-amber-200">
            <i class="fas fa-comment"></i> 
            </a>
        </div>

        <div class="flex-grow flex flex-col items-center text-center">
            <h1 class="text-3xl mb-8 font-bold">COMPRAS</h1>
            <a href="{{ route('admin.purchases') }}" class="w-52 h-52 bg-amber-100 flex items-center justify-center text-8xl mb-8 border-2 border-solid border-gray-800 rounded-lg p-4 hover:bg-amber-200">
            <i class="fas fa-credit-card"></i> 
            </a>
        </div>
        </section>

    </main>

    @include('partials.footer')

</body>
</html>
