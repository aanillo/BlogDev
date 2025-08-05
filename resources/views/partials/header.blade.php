<header 
  class="fixed top-0 left-0 w-full bg-neutral-800 z-50 p-4" 
  x-data="{ navOpen: false }"
>
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between w-full gap-4">

      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo.png') }}" width="120px" />
        </a>
      </div>

      <!-- Botón mobile -->
      <button 
        @click="navOpen = !navOpen" 
        class="text-white md:hidden focus:outline-none"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Navegación -->
      <div class="hidden md:flex items-center justify-between w-full text-lime-400">

        <!-- Título y enlaces -->
        <div class="flex flex-col text-left ml-6">
          <h1 class="text-3xl text-center md:text-5xl text-lime-400 leading-tight">El rincón del dev</h1>
          <div class="flex text-xl gap-x-10 mt-3 text-lime-300">
            <a href="{{ url('/') }}"
            class="transition-transform duration-300 hover:scale-125 
              {{ request()->is('/') ? 'text-lime-300 scale-125 underline' : 'text-lime-400' }}">
              Inicio
            </a>
            <a>Historias de inicio</a>
            <a>Aprender tecnologías</a>
            <a>Experiencias</a>
            <a>Opiniones</a>
            <a>Participa</a>
          </div>
        </div>

        <!-- Perfil (a la derecha, alineado con el logo) -->
        <div class="ml-auto flex items-center h-full md:mr-4">
          <div class="relative" x-data="{ open: false }">
            <button 
      @click="open = !open" 
      class="flex items-center gap-2 text-lime-300 hover:text-lime-500 focus:outline-none"
      :class="open ? 'text-lime-500' : 'text-lime-300 hover:text-lime-500'">
      
      <i class="fas fa-user-circle text-6xl"></i>

      @auth
        <span class="text-2xl font-semibold">
          {{ Auth::user()->username }}
        </span>
      @endauth

    </button>

            <!-- Menú desplegable -->
            <div
              x-show="open"
              @click.away="open = false"
              x-transition
              class="absolute text-xl mt-2 w-48 bg-[#1f1b16] border border-lime-300 text-lime-300 rounded-lg shadow-lg py-2 z-50"
            >
              @guest
                <a href="{{ route('login.show') }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
                  Iniciar sesión
                </a>
                <a href="{{ route('register.show') }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
                  Registro
                </a>
              @endguest

              @auth
                <a
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
                  Perfil
                </a>
                <a
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
                  Tus posts
                </a>
                <a href="{{ route('logout.confirm') }}"
                   class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
                  Cerrar sesión
                </a>
                @endauth
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  </div>
</header>
