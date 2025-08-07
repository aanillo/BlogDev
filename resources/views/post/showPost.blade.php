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
    <style>
        .prose img {
          max-width: 300px;
          max-height: 250px;
          display: block;
          margin: 1rem auto;
          border-radius: 0.5rem;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-neutral-100 font-[Courier New] text-black">

    @include('partials.header')

    <main class="flex-grow flex flex-col items-center px-6 mt-48">

        <h1 class="text-4xl md:text-6xl font-extrabold text-center text-lime-600 underline mb-12 tracking-tight">POST</h1>

        <section class="w-[80%] px-10 py-12 bg-white border border-neutral-300 rounded-2xl shadow-lg mb-12">

            <!-- Título fuera del grid -->
            <div class="bg-neutral-900 text-lime-400 px-8 py-6 rounded-lg shadow-md mb-12 text-center">
                <h1 class="text-5xl font-bold leading-tight">{{ $post->title }}</h1>
            </div>

            <!-- Grid principal -->
            <div class="grid grid-cols-[70%_25%] gap-12">

                <!-- Columna izquierda -->
                <div class="flex flex-col gap-10">

                    <!-- Metadata -->
                    <div class="flex justify-between items-center text-black">
                        <div>
                            <p class="text-lg font-semibold">Publicado por:</p>
                            <p class="text-2xl font-bold">{{ $post->user->username }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold">Fecha publicación:</p>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($post->publish_date)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="inline-block px-5 py-2 text-xl font-semibold bg-neutral-800 text-lime-400 rounded shadow">
                                {{ $post->type }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <article class="prose prose-lg max-w-none text-black border-l-8 border-r-8 border-lime-500 pl-6">
                        {!! $post->post !!}
                    </article>

                    <!-- Botones -->
                    <div class="flex flex justify-between items-center mt-8">
                        <a href="{{ url('/') }}"
                           class="px-8 py-3 w-60 text-xl text-center bg-purple-800 text-lime-300 font-bold rounded-md hover:bg-purple-900 transition transform hover:scale-105">
                            <i class="fas fa-home mr-2"></i> Home
                        </a>

                        @auth
                        @if (Auth::id() === $post->user_id)
                            <a href="{{ route('edit', $post->id) }}"
                               class="px-8 py-3 w-60 text-xl text-center items-center bg-indigo-700 text-lime-300 font-bold rounded-md hover:bg-indigo-800 transition transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('delete', $post->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este post?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-8 py-3 w-60 text-xl text-center items-center bg-red-600 text-lime-200 font-bold rounded-md hover:bg-red-700 transition transform hover:scale-105 flex items-center justify-center gap-2">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        @endif
                        @endauth
                    </div>
                </div>

                <!-- Columna derecha (comentarios) -->
                <div class="flex flex-col bg-neutral-50 rounded-lg shadow-md p-6 max-h-[650px] overflow-auto">

                    @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6 space-y-3">
                        @csrf
                        <label for="comment" class="block font-semibold text-gray-700">Envía un comentario:</label>
                        <textarea name="comment" id="comment" rows="3" required
                            placeholder="Escribe tu comentario aquí..."
                            class="w-full p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-500 resize-none text-black"></textarea>
                        @error('comment')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit"
                            class="w-full bg-green-800 border-2 border-lime-200 text-lime-200 text-lg font-bold py-2 rounded transition transform hover:bg-green-900 hover:scale-105">
                            Enviar comentario
                        </button>
                    </form>
                    @endauth

                    @guest
                    <div class="p-4 bg-yellow-100 text-yellow-900 rounded shadow text-center mb-6">
                        <p class="font-semibold text-lg">¿Quieres comentar el post?</p>
                        <p>Regístrate o inicia sesión para poder aportar tu punto de vista.</p>
                    </div>
                    @endguest

                    <div x-data="{ open: false }" class="w-full">
                        <button @click="open = !open" class="flex items-center justify-between w-full text-lg font-semibold text-neutral-800 mb-3 focus:outline-none">
                            <span class="flex items-center gap-2">
                                <i class="fas fa-comment-dots"></i> Comentarios ({{ $post->comments->count() }})
                            </span>
                            <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                            @forelse ($post->comments as $comment)
                            <div class="bg-white p-4 rounded border border-gray-300 relative">
                                <p class="font-semibold mb-1">{{ $comment->user->username ?? 'Anónimo' }}:</p>
                                <p class="italic mb-2 text-gray-700">"{{ $comment->comment }}"</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($comment->publish_date)->format('d/m/Y') }}</p>

                                @auth
                                @if (Auth::id() === $comment->user_id)
                                    <form action="{{ route('comments.delete', $comment->id) }}" method="POST" class="absolute top-3 right-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm" aria-label="Eliminar comentario">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                                @endauth
                            </div>
                            @empty
                            <p class="text-gray-500">No hay comentarios aún.</p>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>

    @include('partials.footer')

</body>
</html>
