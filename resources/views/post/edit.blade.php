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

<main class="flex-grow flex flex-col items-center px-6 mt-40 bg-neutral-100 text-white py-10">

    <!-- Formulario de edición -->
    <form
        method="POST"
        action="{{ route('edit', $post->id) }}"
        enctype="multipart/form-data"
        x-data="{ 
            imageFile: null, 
            imagePreview: null, 
            handleDrop(e) { 
                e.preventDefault(); 
                this.setImage(e.dataTransfer.files[0]); 
            }, 
            setImage(file) { 
                this.imageFile = file; 
                this.imagePreview = URL.createObjectURL(file); 
                $refs.imageInput.files = [file]; 
            } 
        }"
        class="w-full max-w-5xl px-12 py-10 rounded-3xl shadow-2xl border border-lime-500 bg-neutral-900 backdrop-blur-md"
    >
        @csrf
        @method('PUT')

        <h1 class="text-center text-5xl font-bold mb-6 bg-gradient-to-r from-lime-400 to-lime-200 text-transparent bg-clip-text">
            EDITAR POST
        </h1>
        <p class="text-center text-xl text-lime-300 mb-10">
            Actualiza tu post: modifica el título, contenido o imagen. La categoría no se puede modificar.
        </p>

        <!-- Categoría (no editable) -->
        <input type="hidden" name="type" value="{{ $post->type }}">
        <h2 class="text-2xl text-center mb-4 font-semibold text-lime-300">Categoría seleccionada:</h2>
        <div class="flex justify-center mb-10">
            <button 
                type="button"
                disabled
                class="bg-neutral-900 text-lime-300 px-6 py-4 rounded-lg w-40 text-xl font-semibold ring-4 ring-lime-300 scale-105 cursor-default"
            >
                {{ strtoupper($post->type) }}
            </button>
        </div>

        <!-- Título -->
        <label class="block mb-6">
            <span class="text-xl text-lime-500 font-semibold">Título:</span>
            <input 
                name="title" 
                value="{{ old('title', $post->title) }}"
                class="mt-2 w-full h-12 bg-neutral-700 border border-lime-500 rounded-xl px-4 focus:ring-2 focus:ring-lime-300 outline-none text-lime-500 shadow-lg"
            >
            @error("title")
                <small class="text-red-500 font-bold">{{ $message }}</small>
            @enderror
        </label>

        <!-- Contenido -->
        <label class="block mb-6">
            <span class="text-xl text-lime-500 font-semibold">Contenido:</span>
            <textarea 
                name="post" 
                class="mt-2 w-full h-96 bg-neutral-700 border border-lime-500 rounded-xl px-4 py-2 focus:ring-2 focus:ring-lime-300 outline-none text-lime-500 shadow-lg"
            >{{ old('post', $post->post) }}</textarea>
            @error("post")
                <small class="text-red-500 font-bold">{{ $message }}</small>
            @enderror
        </label>

        <!-- Imagen actual -->
        @if($post->image)
            <div class="mt-4 mb-6">
                <p class="text-lime-300">Imagen actual:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Imagen actual" class="mx-auto mt-2 max-h-64 rounded-xl shadow-lg border border-neutral-600">
            </div>
        @endif

        <!-- Nueva imagen -->
        <div 
            @dragover.prevent
            @drop="handleDrop($event)"
            class="border-2 border-dashed border-lime-500 rounded-xl p-8 text-center cursor-pointer hover:bg-neutral-700/50 transition"
            @click="$refs.imageInput.click()"
        >
            <p class="text-lime-400 mb-2">Arrastra una nueva imagen aquí o haz clic para seleccionarla (opcional)</p>
            <input type="file" name="image" accept="image/*" x-ref="imageInput" class="hidden" @change="setImage($event.target.files[0])">
            <template x-if="imagePreview">
                <img :src="imagePreview" class="mx-auto mt-4 max-h-64 rounded-xl shadow-lg border border-neutral-600">
            </template>
            @error("image")
                <small class="text-red-500 font-bold">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 mt-10 w-full">
    <button type="submit"
        class="w-full sm:w-auto bg-green-700 hover:bg-green-800 text-lime-300 text-xl font-bold px-8 py-3 rounded-xl border-2 border-lime-300 shadow-lg transform hover:scale-110 transition">
        <i class="fa-solid fa-pen-to-square mr-2"></i> Actualizar
    </button>
    <button type="reset"
        class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-lime-300 text-xl font-bold px-8 py-3 rounded-xl border-2 border-lime-300 shadow-lg transform hover:scale-110 transition">
        <i class="fa-solid fa-xmark mr-2"></i> Cancelar
    </button>
</div>


    </form>
</main>

@include('partials.footer')

</body>
</html>
