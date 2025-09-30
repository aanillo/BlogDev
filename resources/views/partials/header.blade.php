<header 
  class="fixed top-0 left-0 w-full bg-neutral-800 z-50 p-4" 
  x-data="{ navOpen: false }"
>
  <div class="max-w-[1500px] mx-auto px-4">
    <div class="flex items-center w-full gap-4">

      <!-- Logo -->
      <div class="flex-shrink-0 mr-auto border border-lime-300 rounded-full bg-neutral-700 hover:bg-neutral-800">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logoSinFondo.png') }}" width="120px" />
        </a>
      </div>


      <!-- Botón menú hamburguesa (solo móvil) -->
      <button 
        @click="navOpen = !navOpen" 
        class="md:hidden focus:outline-none text-lime-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" 
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Notificaciones SOLO móvil -->
      @auth
      <div class="relative mr-2 md:hidden" 
           x-data="{ notifOpen: false, unreadCount: {{ auth()->user()->unreadNotifications->count() }} }">
        <button 
          @click="
            notifOpen = !notifOpen;
            if(notifOpen && unreadCount > 0){
              fetch('{{ route('notifications.read') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
              }).then(() => { unreadCount = 0 });
            }
          " 
          class="relative flex items-center text-lime-300 hover:text-lime-500 focus:outline-none"
        >
          <i class="fas fa-bell text-2xl"></i>
          <template x-if="unreadCount > 0">
            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" 
                  x-text="unreadCount"></span>
          </template>
        </button>

        <!-- Dropdown notificaciones -->
        <div
          x-show="notifOpen"
          @click.away="notifOpen = false"
          class="absolute right-0 mt-4 w-80 bg-[#1f1b16] border border-lime-300 
                 text-lime-300 rounded-lg shadow-lg z-50"
        >
          <ul class="divide-y divide-neutral-700 max-h-96 overflow-y-auto">
  @forelse(auth()->user()->notifications as $notification)
    @php
      $data = $notification->data ?? [];
      $type = $data['type'] ?? '';
      $postId = $data['post_id'] ?? null;
      $user = $data['user'] ?? null;
      $comment = $data['comment'] ?? null;
      $message = $data['message'] ?? null;
      $reason = $data['reason'] ?? null;
      $postTitle = $data['post_title'] ?? null;
    @endphp

    <li class="p-3 hover:bg-lime-200 hover:text-black transition">
      @if($type === 'admin_action' || !$postId)
        <div>
          <i class="fas fa-exclamation-triangle text-red-500"></i>
          <strong>Notificación administrativa:</strong><br>
          {{ $message ?? $reason ?? 'Tu post ha sido eliminado por un administrador.' }}
          @if($postTitle)
            <br><em>{{ $postTitle }}</em>
          @endif
        </div>
      @elseif($postId)
        <a href="{{ route('show', ['id' => $postId]) }}">
          @if($type === 'reply')
            <strong>{{ $user }}</strong> respondió a tu comentario:
            "{{ \Illuminate\Support\Str::limit($comment, 40) }}"
          @else
            <strong>{{ $user }}</strong> comentó en tu post:
            "{{ \Illuminate\Support\Str::limit($comment, 40) }}"
          @endif
        </a>
      @else
        <div>
          <strong>Notificación:</strong> {{ json_encode($data) }}
        </div>
      @endif
    </li>
  @empty
    <li class="p-3 text-center text-lime-300">No tienes notificaciones</li>
  @endforelse
</ul>
          
        </div>
      </div>
      @endauth

      <!-- Navegación desktop -->
      <div class="hidden md:flex flex-grow justify-center text-lime-400">
        <div class="flex flex-col items-center text-center">
          <h1 class="text-3xl md:text-5xl text-lime-400 leading-tight">El rincón del dev</h1>
          <div class="flex text-xl gap-x-10 mt-3 text-lime-300 justify-center">
            <a href="{{ url('/') }}" class="transition-transform duration-1000 hover:scale-125 
              {{ request()->is('/') ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Inicio
            </a>
            <a href="{{ route('type', 'Inicio') }}" class="transition-transform duration-1000 hover:scale-125 
              {{ request()->routeIs('type') && request()->route('type') === 'Inicio' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Historias de inicio
            </a>
            <a href="{{ route('type', 'Tecnología') }}" class="transition-transform duration-1000 hover:scale-125
              {{ request()->routeIs('type') && request()->route('type') === 'Tecnología' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Tecnologías
            </a>
            <a href="{{ route('type', 'Experiencia') }}" class="transition-transform duration-1000 hover:scale-125
              {{ request()->routeIs('type') && request()->route('type') === 'Experiencia' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Experiencias
            </a>
            <a href="{{ route('type', 'Opinión') }}" class="transition-transform duration-1000 hover:scale-125
              {{ request()->routeIs('type') && request()->route('type') === 'Opinión' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Opiniones
            </a>
            @auth
              @if(auth()->user()->role !== 'admin')
                <a href="{{ route('insert.show', ['id' => auth()->user()->id]) }}" 
                   class="transition-transform duration-1000 hover:scale-125 
                   {{ request()->routeIs('insert.show') ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
                  Crea tu post
                </a>
              @endif
            @else
              <a href="{{ route('login.show') }}" 
                 class="transition-transform duration-300 hover:scale-125 text-lime-400">
                Crea tu post
              </a>
            @endauth
          </div>
        </div>
      </div>

      <!-- Perfil + Notificaciones en Desktop -->
      <div class="hidden md:flex flex-shrink-0 ml-auto items-center h-full md:mr-4">
        <div class="relative" x-data="{ open: false }">
          <button 
            @click="open = !open" 
            class="flex items-center gap-2 text-lime-300 hover:text-lime-500 focus:outline-none"
            :class="open ? 'text-lime-500' : 'text-lime-300 hover:text-lime-500'">
            <i class="fas fa-user-circle text-6xl"></i>
            @auth
              <span class="text-2xl font-semibold">{{ Auth::user()->username }}</span>
            @endauth
          </button>

          <!-- Menú desplegable perfil -->
          <div
            x-show="open"
            @click.away="open = false"
            class="absolute text-xl mt-2 w-48 bg-[#1f1b16] border border-lime-300 text-lime-300 rounded-lg shadow-lg py-2 z-50 -translate-x-20"
          >
            @guest
              <a href="{{ route('login.show') }}"
                 class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                 {{ request()->routeIs('login.show') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                Iniciar sesión
              </a>
              <a href="{{ route('register.show') }}"
                 class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                 {{ request()->routeIs('register.show') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                Registro
              </a>
            @endguest

            @auth
              @if(auth()->user()->rol === 'admin')
                <a href="{{ route('logout.confirm') }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                   {{ request()->routeIs('logout') || request()->is('users/logout*') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                   Cerrar sesión
                </a>
              @else
                <a href="{{ route('profile', ['id' => auth()->user()->id]) }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                   {{ request()->routeIs('profile') || request()->is('users/profile*') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                   Perfil
                </a>
                <a href="{{ route('user.posts', ['id' => auth()->user()->id]) }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                   {{ request()->routeIs('user.posts') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                   Tus posts
                </a>
                <a href="{{ route('logout.confirm') }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200
                   {{ request()->routeIs('logout') || request()->is('users/logout*') ? 'text-lime-300 underline' : 'text-lime-400' }}">
                   Cerrar sesión
                </a>
              @endif
            @endauth
          </div>
        </div>

        <!-- Notificaciones SOLO desktop -->
        @auth
        <div class="relative mr-6 ml-10 hidden md:flex" 
             x-data="{ notifOpen: false, unreadCount: {{ auth()->user()->unreadNotifications->count() }} }">
          <button 
            @click="
              notifOpen = !notifOpen;
              if(notifOpen && unreadCount > 0){
                fetch('{{ route('notifications.read') }}', {
                  method: 'POST',
                  headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(() => { unreadCount = 0 });
              }
            " 
            class="relative flex items-center text-lime-300 hover:text-lime-500 focus:outline-none"
          >
            <i class="fas fa-bell text-3xl"></i>
            <template x-if="unreadCount > 0">
              <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" 
                    x-text="unreadCount"></span>
            </template>
          </button>

          <!-- Dropdown notificaciones -->
          <div
            x-show="notifOpen"
            @click.away="notifOpen = false"
            class="absolute right-0 mt-10 w-80 bg-[#1f1b16] border border-lime-300 
                   text-lime-300 rounded-lg shadow-lg z-50"
          >
            
<ul class="divide-y divide-neutral-700 max-h-96 overflow-y-auto">
  @forelse(auth()->user()->notifications as $notification)
    @php
      $data = $notification->data ?? [];
      $type = $data['type'] ?? '';
      $postId = $data['post_id'] ?? null;
      $user = $data['user'] ?? null;
      $comment = $data['comment'] ?? null;
      $message = $data['message'] ?? null;
      $reason = $data['reason'] ?? null;
      $postTitle = $data['post_title'] ?? null;
    @endphp

    <li class="p-3 hover:bg-lime-200 hover:text-black transition">
      @if($type === 'admin_action' || !$postId)
        
        <div>
          <i class="fas fa-exclamation-triangle text-red-500"></i>
          <strong>Notificación administrativa:</strong><br>
          {{ $message ?? $reason ?? 'Tu post ha sido eliminado por un administrador.' }}
          @if($postTitle)
            <br><em>{{ $postTitle }}</em>
          @endif
        </div>
      @elseif($postId)
        
        <a href="{{ route('show', ['id' => $postId]) }}">
          @if($type === 'reply')
            <strong>{{ $user }}</strong> respondió a tu comentario:
            "{{ \Illuminate\Support\Str::limit($comment, 40) }}"
          @else
            <strong>{{ $user }}</strong> comentó en tu post:
            "{{ \Illuminate\Support\Str::limit($comment, 40) }}"
          @endif
        </a>
      @else
        
        <div>
          <strong>Notificación:</strong> {{ json_encode($data) }}
        </div>
      @endif
    </li>
  @empty
    <li class="p-3 text-center text-lime-300">No tienes notificaciones</li>
  @endforelse
</ul>


          </div>
        </div>
        @endauth
      </div>

    </div>
  </div>

  <!-- Menú móvil desplegable -->
  <div 
    x-show="navOpen" 
    x-transition 
    class="md:hidden bg-neutral-900 text-lime-300 px-6 py-2 space-y-2 rounded-lg"
  >
    <a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
    {{ request()->is('/') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">
    Inicio</a>
    <a href="{{ route('type', 'Inicio') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
    {{ request()->routeIs('type') && request()->route('type') === 'Inicio' ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">
    Historias de inicio</a>
    <a href="{{ route('type', 'Tecnología') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
    {{ request()->routeIs('type') && request()->route('type') === 'Tecnología' ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">
    Tecnologías</a>
    <a href="{{ route('type', 'Experiencia') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
    {{ request()->routeIs('type') && request()->route('type') === 'Experiencia' ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">
    Experiencias</a>
    <a href="{{ route('type', 'Opinión') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
    {{ request()->routeIs('type') && request()->route('type') === 'Opinión' ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">
    Opiniones</a>
    <hr>
    @auth
      @if(auth()->user()->rol === 'admin')
        <a href="{{ route('logout.confirm') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
        {{ request()->routeIs('logout') || request()->is('users/logout*') ? 'text-lime-300 underline' : 'text-lime-400' }}">
        Cerrar sesión</a>
      @else
        <a href="{{ route('insert.show', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
        {{ request()->routeIs('insert.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Crea tu post</a>
        <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
        {{ request()->routeIs('profile') || request()->is('users/profile*') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Perfil</a>
        <a href="{{ route('user.posts', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
        {{ request()->routeIs('user.posts') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Tus posts</a>
        <a href="{{ route('logout.confirm') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
        {{ request()->routeIs('logout') || request()->is('users/logout*') ? 'text-lime-300 underline' : 'text-lime-400' }}">Cerrar sesión</a>
      @endif
    @else
      <a href="{{ route('login.show') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('login.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Iniciar sesión</a>
      <a href="{{ route('register.show') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('register.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Registro</a>
    @endauth
  </div>
</header>
