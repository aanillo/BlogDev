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
            action="{{ route('doInsert') }}"
            enctype="multipart/form-data"
            x-data="{ selectedType: '' }"
            @submit.prevent="if (selectedType) $el.submit(); else alert('Por favor, selecciona una categoría')"
            class="w-full max-w-7xl px-12 py-6 rounded-2xl shadow-xl text-lime-300 bg-neutral-800 mb-8"
        >
            @csrf

            <h1 class="text-center text-4xl font-semibold mb-8 text-lime-500 underline mt-2">INSERTAR POST</h1>

            <h2 class="text-2xl text-center mb-6">Participa en nuestra comunidad aportando tus ideas, anécdotas o experiencias. Puedes insertar imágenes opcionalmente.</h2>

            <div>
                

            <!-- Campo oculto para el type -->
<input type="hidden" name="type" x-model="selectedType">

<h2 class="text-2xl text-center mb-4">Seleccionar categoría:</h2>

<div class="flex justify-center flex-wrap gap-4 mb-8">
    <template x-for="option in [
        { label: 'INICIOS', value: 'Inicio', color: 'bg-purple-600' },
        { label: 'TECNOLOGÍAS', value: 'Tecnología', color: 'bg-indigo-500' },
        { label: 'EXPERIENCIAS', value: 'Experiencia', color: 'bg-orange-600' },
        { label: 'OPINIONES', value: 'Opinión', color: 'bg-yellow-500' }
    ]" :key="option.value">
        <button
            type="button"
            @click="selectedType = option.value"
            :class="[ 
    selectedType === option.value 
        ? 'bg-neutral-900 scale-105 ring-2 ring-lime-300 text-xl text-lime-200 border-lime-200 font-semibold' 
        : option.color + ' text-black border-2 ring-2 ring-neutral-700 border-black font-bold', 
    'px-4 py-2 rounded-md text-xl w-[20%] transition-all border-2 transform hover:scale-110' 
].join(' ')"
        >
            <span x-text="option.label"></span>
        </button>
    </template>
</div>


            <div class="flex flex-col mt-4 mb-8 gap-2 text-xl">
                <h3>Título:</h3>
                <input name="title" class="w-full h-[40px] bg-neutral-700 border border-lime-500 rounded-2xl shadow-xl p-4">
                @error("title")
        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
    @enderror
            </div>

            <div class="flex flex-col gap-2">
                <h3 class="text-xl">Cuéntanos sobre tí:</h3>
                <textarea name="post" class="w-full h-[800px] bg-neutral-700 text-lg border border-lime-500 rounded-2xl shadow-xl p-4"></textarea>
                @error("post")
        <small class="text-red-500 text-lg font-bold">{{ $message }}</small>
    @enderror
            </div>

    <!-- Drag & Drop usando Alpine.js -->
    <div 
        x-data="{
            imageFile: null,
            handleDrop(e) {
                e.preventDefault();
                this.imageFile = e.dataTransfer.files[0];
                $refs.imageInput.files = e.dataTransfer.files;
            }
        }"
        @dragover.prevent
        @drop="handleDrop($event)"
        class="border-2 border-dashed border-lime-500 rounded-md p-6 text-center cursor-pointer mt-2"
    >
        <p class="text-lime-600">Arrastra una imagen aquí o haz clic para seleccionarla</p>
        <input type="file" name="image" accept="image/*" x-ref="imageInput" class="hidden" @change="imageFile = $event.target.files[0]">
        <button type="button" @click="$refs.imageInput.click()" class="mt-2 px-4 py-2 bg-lime-500 text-black font-bold rounded-md">
            Seleccionar imagen
        </button>

        <template x-if="imageFile">
            <p class="mt-4 text-sm text-lime-300">Imagen seleccionada: <strong x-text="imageFile.name"></strong></p>
        </template>
        @error("image")
        <small class="text-red-500 text-lg font-bold block mt-2">{{ $message }}</small>
    @enderror
    </div>
            
            </div>

            <div class="flex flex-row gap-10 justify-center items-center mt-10 mb-4">
                            <button type="submit"
                                class="bg-green-800 font-bold w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-green-900 transition-transform duration-300 ease-in-out hover:scale-110">
                            Insertar
                        </button>

                        <button type="reset"
                                class="bg-red-600 font-bold w-64 text-lime-200 text-xl border-2 border-lime-200 px-6 py-2 rounded-md hover:bg-red-700 transform transition-transform duration-300 ease-in-out hover:scale-110">
                            Cancelar
                        </button>
            </div>

        </form>

    </main>

    @include('partials.footer')

</body>
</html>