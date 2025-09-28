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

    <main class="flex-grow flex flex-col items-center px-4 sm:px-6 mt-44 sm:mt-48">

        <h1 class="text-4xl md:text-6xl font-extrabold text-center text-lime-600 underline mb-12 tracking-tight">POST</h1>

        <section class="w-full sm:w-[85%] px-4 sm:px-10 py-8 sm:py-12 bg-lime-50 border border-neutral-200 rounded-3xl shadow-xl mb-12">

            <!-- Título del post -->
            <div class="bg-neutral-900 w-full sm:w-[65%] mx-auto border-2 border-lime-500 text-lime-300 px-4 sm:px-10 py-6 rounded-xl shadow-md mb-12 text-center transition transform hover:scale-105">
                <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight break-words">{{ $post->title }}</h1>
            </div>

            <!-- Grid principal -->
            <div class="grid grid-cols-1 lg:grid-cols-[70%_28%] gap-8 lg:gap-12">

                <!-- Columna izquierda -->
                <div class="flex flex-col gap-10">

                    <!-- Metadata -->
                    <div class="flex flex-wrap justify-between items-start text-black gap-6">
                        <div class="min-w-[40%]">
                            <p class="text-base sm:text-lg font-semibold">Publicado por:</p>
                            <p class="text-xl sm:text-2xl font-bold break-words">{{ $post->user->username }}</p>
                        </div>
                        <div class="text-left sm:text-center min-w-[40%]">
                            <p class="text-base sm:text-lg font-semibold">Fecha publicación:</p>
                            <p class="text-base sm:text-lg">{{ \Carbon\Carbon::parse($post->publish_date)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="inline-block px-4 sm:px-5 py-2 text-lg sm:text-xl font-semibold bg-neutral-800 text-lime-400 rounded-xl shadow-lg">
                                {{ $post->type }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido del post -->
                    <article class="prose max-w-none bg-white text-black bg-lime-50 border-l-8 border-r-8 border-lime-500 p-4 sm:p-8 text-base sm:text-lg rounded-2xl shadow-md transition hover:shadow-xl">
                        @php
                            $postContent = nl2br(e($post->post));
                            $postContent = preg_replace('/\[IMG\](.*?)\[\/IMG\]/', '<img src="$1" style="max-width:100%;height:auto;">', $postContent);
                        @endphp

                        {!! $postContent !!}
                    </article>

                    <!-- Botones -->
                    <div class="flex flex-wrap justify-between items-center mt-8 gap-4">
                        <a href="{{ url('/') }}"
                           class="px-6 sm:px-8 py-3 w-full md:w-60 text-lg sm:text-xl text-center bg-purple-600 text-black border-2 border-black font-bold rounded-lg hover:bg-purple-700 hover:scale-105 transition transform flex flex-col items-center gap-2">
                            <i class="fas fa-home text-2xl"></i>
                            Home
                        </a>

                        @auth
                        @if (Auth::id() === $post->user_id)
                            <a href="{{ route('post.edit', $post->id) }}"
                               class="px-6 sm:px-8 py-3 w-full md:w-60 text-lg sm:text-xl text-center bg-indigo-500 text-black border-2 border-black font-bold rounded-lg hover:bg-indigo-600 hover:scale-105 transition transform flex flex-col items-center gap-2">
                                <i class="fas fa-edit text-2xl"></i>
                                Editar
                            </a>
                            <form action="{{ route('delete', $post->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este post?');" class="w-full md:w-60">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 sm:px-8 py-3 w-full text-lg sm:text-xl text-center bg-red-500 border-2 border-black text-black font-bold rounded-lg hover:bg-red-600 hover:scale-105 transition transform flex flex-col items-center gap-2">
                                    <i class="fas fa-trash-alt text-2xl"></i>
                                    Eliminar
                                </button>
                            </form>
                        @endif
                        @endauth
                    </div>

                </div>

                <!-- Columna derecha (comentarios) -->
                <div class="flex flex-col rounded-2xl p-4 sm:p-6 max-h-[650px] overflow-auto bg-white shadow-lg border border-neutral-200">

                    <!-- Formulario comentario -->
                    @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6 space-y-3">
                        @csrf
                        <label for="comment" class="block font-semibold text-black">Envía un comentario:</label>
                        <textarea name="comment" id="comment" rows="3" required
                            placeholder="Escribe tu comentario aquí..."
                            class="w-full bg-gray-50 p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-500 resize-none text-black"></textarea>
                        @error('comment')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit"
                            class="w-full bg-lime-600 border-2 border-lime-700 text-white text-lg font-bold py-2 rounded-lg transition transform hover:bg-lime-700 hover:scale-105">
                            Enviar comentario
                        </button>
                    </form>
                    @endauth

                    @guest
                    <div class="p-4 bg-lime-200 text-black rounded-xl shadow text-center mb-6">
                        <p class="font-semibold text-lg">¿Quieres comentar el post?</p>
                        <p>Regístrate o inicia sesión para poder aportar tu punto de vista.</p>
                    </div>
                    @endguest

                    <!-- Lista comentarios -->
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
                            @php
                                $renderComments = function($comments, $level = 0) use (&$renderComments) {
                                    foreach ($comments as $comment) {
                                        echo '<div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm relative ml-' . ($level * 6) . '">';
                                        echo '<p class="font-semibold mb-1">' . e($comment->user->username ?? 'Anónimo') . ':</p>';
                                        echo '<p class="mb-2 text-black">' . e($comment->comment) . '</p>';
                                        echo '<p class="text-xs text-black">' . \Carbon\Carbon::parse($comment->publish_date)->format('d/m/Y') . '</p>';

                                        if(auth()->check()) {
                                            echo '<div x-data="{ openReply: false }" class="mt-2">';
                                            echo '<button @click="openReply = !openReply" class="text-sm text-blue-600 hover:underline">Responder</button>';
                                            echo '<div x-show="openReply" class="mt-2">';
                                            echo '<form method="POST" action="' . route('comments.store') . '">';
                                            echo csrf_field();
                                            echo '<textarea name="comment" rows="2" class="w-full p-2 border rounded text-black" placeholder="Escribe tu respuesta..."></textarea>';
                                            echo '<input type="hidden" name="post_id" value="' . $comment->post_id . '">';
                                            echo '<input type="hidden" name="parent_id" value="' . $comment->id . '">';
                                            echo '<button type="submit" class="mt-2 px-4 py-1 bg-lime-600 text-white rounded hover:bg-lime-700">Enviar</button>';
                                            echo '</form>';
                                            echo '</div>';
                                            echo '</div>';
                                        }

                                        if(auth()->check() && auth()->id() === $comment->user_id) {
                                            echo '<form action="' . route('comments.delete', $comment->id) . '" method="POST" class="absolute top-3 right-3">';
                                            echo csrf_field();
                                            echo method_field('DELETE');
                                            echo '<button type="submit" class="text-red-600 hover:text-red-800 text-sm" aria-label="Eliminar comentario">';
                                            echo '<i class="fas fa-trash-alt"></i>';
                                            echo '</button>';
                                            echo '</form>';
                                        }

                                        if($comment->replies->count()) {
                                            echo '<div class="mt-4 space-y-2">';
                                            $renderComments($comment->replies, $level + 1);
                                            echo '</div>';
                                        }

                                        echo '</div>';
                                    }
                                };
                            @endphp

                            @if ($post->comments->whereNull('parent_id')->count())
                                {!! $renderComments($post->comments->whereNull('parent_id')) !!}
                            @else
                                <p class="text-gray-500">No hay comentarios aún.</p>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>

    @include('partials.footer')

</body>
</html>
