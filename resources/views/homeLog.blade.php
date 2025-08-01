<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreros</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/LogoInicial.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-white font-[Georgia]">

    @include('partials.headerLog') 

    <main class="flex-grow flex flex-col items-center bg-white text-black px-6 mt-52">
        
        <section class="text-center mb-8">
            <h1 class="text-3xl font-bold">Libreros, un espacio para los amantes de la lectura</h1>
            <h2 class="text-xl mt-2">Aquí podrás encontrar tus libros favoritos y compartir tus vivencias</h2>
            <hr class="mt-8 border-[#F5D074] w-9/10 border-2 mx-auto">
        </section>

        <section class="w-full text-center mb-8">
            <h3 class="text-2xl font-semibold mb-4">Libros</h3>
            <p class="mb-4 text-lg">Disfruta de nuestro amplio catálogo de libros, podrás buscar por géneros y por autores.</p>
            
            <div class="flex flex-wrap justify-center gap-4 max-w-7xl mx-auto">
                @foreach ($randomBooks as $book)
                    <div class="flex flex-col items-center w-46 h-72">
                        <div class="w-46 h-48"> 
                            <img src="{{ $book->imagen }}" alt="Imagen libro" class="w-full h-full object-cover rounded-lg shadow-md">
                        </div>
                    <p class="mt-2 text-l text-center w-32">{{ $book->titulo }}</p>
                    </div>
                @endforeach
            </div>
            <hr class="mt-4 border-[#F5D074] w-3/4 border-2 mx-auto">
        </section>

        <section class="w-full text-center">
            <h3 class="text-2xl font-semibold mb-4">Autores</h3>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
                @foreach ($randomWriters as $writer)
                    <div class="p-3 text-black mx-auto bg-[#F8F3EB]">
                        <p class="text-lg">{{ $writer->nombre }}</p>
                    </div>
                @endforeach
            </div>
            <hr class="mt-8 border-[#F5D074] w-3/4 border-2 mx-auto">
        </section>

        <section class="section_frases flex flex-col md:flex-row gap-6 mt-6 mb-12 px-4">
  
            <div class="bg-amber-200 p-4 rounded-md flex items-center justify-center md:w-1/3">
                <h3 class="text-black text-center text-lg">
                Un lector vive mil<br> vidas antes de morir.<br><br>
                <i>George R. R. Martin</i>
                </h3>
            </div>

            <img 
                src="{{ asset('img/biblio.jpeg') }}" 
                class="w-full md:w-96 h-auto object-cover rounded-md" 
                alt="Libros"
            >

            <div class="bg-amber-200 p-4 rounded-md flex items-center justify-center md:w-1/3">
                <h3 class="text-black text-center text-lg">
                La lectura es para la<br> mente lo que el ejercicio<br> es para el cuerpo.<br><br>
                <i>Richard Steele</i>
                </h3>
            </div>
        </section>

    </main>

    @include('partials.footer')

</body>
</html>
