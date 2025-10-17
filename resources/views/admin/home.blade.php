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
<body class="flex flex-col min-h-screen text-gray-900 bg-neutral-100 font-[Courier New]">

    @include('partials.headerAdmin') 

    <main class="flex-grow flex flex-col items-center px-6 mt-48 mb-16">

        <h1 class="text-4xl md:text-6xl font-extrabold text-center text-lime-600 underline mb-16 tracking-tight">
            ADMIN
        </h1>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-lime-200 border-2 border-neutral-700 p-10 w-full sm:w-[80%] rounded-2xl shadow-xl mb-8 md:mb-0">

    <!-- Usuarios -->
    <div class="flex flex-col items-center">
        <a href="{{ route('admin.users') }}" 
           class="w-[98%] sm:w-72 h-56 bg-neutral-800 flex flex-col items-center justify-between text-lime-300 text-7xl border-2 border-lime-300 rounded-xl p-6 hover:bg-black hover:text-lime-500 hover:scale-105 transition-transform shadow-md">
            <h1 class="text-2xl font-bold mb-4">USUARIOS</h1>
            <i class="fas fa-users"></i>
        </a>
    </div>

    <!-- Posts -->
    <div class="flex flex-col items-center">
        <a href="{{ route('admin.posts') }}" 
           class="w-[98%] sm:w-72 h-56 bg-neutral-800 flex flex-col items-center justify-between text-lime-300 text-7xl border-2 border-lime-300 rounded-xl p-6 hover:bg-black hover:text-lime-500 hover:scale-105 transition-transform shadow-md">
            <h1 class="text-2xl font-bold mb-4">POSTS</h1>
            <i class="fas fa-book"></i>
        </a>
    </div>

    <!-- Comentarios -->
    <div class="flex flex-col items-center">
        <a href="{{ route('admin.comments') }}" 
           class="w-[98%] sm:w-72 h-56 bg-neutral-800 flex flex-col items-center justify-between text-lime-300 text-7xl border-2 border-lime-300 rounded-xl p-6 hover:bg-black hover:text-lime-500 hover:scale-105 transition-transform shadow-md">
            <h1 class="text-2xl font-bold mb-4">COMENTARIOS</h1>
            <i class="fas fa-comment"></i>
        </a>
    </div>

</section>



    </main>

    @include('partials.footer')

</body>
</html>

