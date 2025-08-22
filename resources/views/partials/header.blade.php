<header 
  class="fixed top-0 left-0 w-full bg-neutral-800 z-50 p-4" 
  x-data="{ navOpen: false }"
>
  <div class="max-w-[1500px] mx-auto px-4">
    <div class="flex items-center w-full gap-8">

      <!-- Logo -->
      <div class="flex-shrink-0 mr-auto">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logoSinFondo.png') }}" width="120px" />
        </a>
      </div>

      <!-- Botón mobile -->
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


      <!-- Navegación desktop -->
      <div class="hidden md:flex flex-grow justify-center text-lime-400">
        <div class="flex flex-col items-center text-center">
          <h1 class="text-3xl md:text-5xl text-lime-400 leading-tight">El rincón del dev</h1>
          <div class="flex text-xl gap-x-10 mt-3 text-lime-300 justify-center">
            <a href="{{ url('/') }}" class="transition-transform duration-300 hover:scale-125 
              {{ request()->is('/') ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Inicio
            </a>
            <a href="{{ route('type', 'Inicio') }}" class="transition-transform duration-300 hover:scale-125 
              {{ request()->routeIs('type') && request()->route('type') === 'Inicio' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Historias de inicio
            </a>
            <a href="{{ route('type', 'Tecnología') }}" class="transition-transform duration-300 hover:scale-125 
              {{ request()->routeIs('type') && request()->route('type') === 'Tecnología' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Tecnologías
            </a>
            <a href="{{ route('type', 'Experiencia') }}" class="transition-transform duration-300 hover:scale-125 
              {{ request()->routeIs('type') && request()->route('type') === 'Experiencia' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Experiencias
            </a>
            <a href="{{ route('type', 'Opinión') }}" class="transition-transform duration-300 hover:scale-125 
              {{ request()->routeIs('type') && request()->route('type') === 'Opinión' ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Opiniones
            </a>
            @auth
              <a href="{{ route('insert.show', ['id' => auth()->user()->id]) }}" 
                 class="transition-transform duration-300 hover:scale-125 
                 {{ request()->routeIs('insert.show') ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
                Crea tu post
              </a>
            @else
              <a href="{{ route('login.show') }}" 
                 class="transition-transform duration-300 hover:scale-125 text-lime-400">
                Crea tu post
              </a>
            @endauth
          </div>
        </div>
      </div>

      <!-- Perfil (desktop solo) -->
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
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Menú móvil desplegable -->
  <div 
    x-show="navOpen" 
    x-transition 
    class="md:hidden bg-neutral-900 text-lime-300 px-6 py-4 space-y-4 rounded-lg"
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
      <a href="{{ route('insert.show', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('insert.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Crea tu post</a>
      <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('profile') || request()->is('users/profile*') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Perfil</a>
      <a href="{{ route('user.posts', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('user.posts') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Tus posts</a>
      <a href="{{ route('logout.confirm') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('logout') || request()->is('users/logout*') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Cerrar sesión</a>
    @else
      <a href="{{ route('login.show') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('login.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Iniciar sesión</a>
      <a href="{{ route('register.show') }}" class="block px-4 py-2 hover:bg-lime-200 hover:text-black
      {{ request()->routeIs('register.show') ? 'text-lime-300 scale-105 underline' : 'text-lime-400' }}">Registro</a>
    @endauth
  </div>
</header>
