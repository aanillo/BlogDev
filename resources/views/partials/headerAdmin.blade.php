<header 
  class="fixed top-0 left-0 w-full bg-neutral-800 z-50 p-4" 
  x-data="{ navOpen: false }"
>
  <div class="max-w-[1500px] mx-auto px-4">
    <div class="flex items-center justify-between w-full">

      <!-- Logo -->
      <div class="flex-shrink-0 border border-lime-300 rounded-full bg-neutral-700 hover:bg-neutral-800">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logoSinFondo.png') }}" width="120px" />
        </a>
      </div>

      <!-- Título central -->
      <h1 class="hidden md:block text-3xl md:text-5xl text-lime-400 text-center flex-grow">
        El rincón del dev
      </h1>

      <!-- Botón menú hamburguesa (solo móvil) -->
      <button 
        @click="navOpen = !navOpen" 
        class="md:hidden focus:outline-none text-lime-300 ml-auto"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" 
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Perfil desktop -->
      <div class="hidden md:flex items-center ml-auto">
        <div class="relative" x-data="{ open: false }">
          <button 
            @click="open = !open" 
            class="flex items-center gap-2 text-lime-300 hover:text-lime-500 focus:outline-none"
            :class="open ? 'text-lime-500' : 'text-lime-300 hover:text-lime-500'">
            <i class="fas fa-user-circle text-5xl"></i>
            <span class="text-2xl font-semibold">{{ Auth::user()->username }}</span>
          </button>

          <!-- Menú desplegable -->
          <div
            x-show="open"
            @click.away="open = false"
            class="absolute right-0 mt-2 w-48 bg-[#1f1b16] border border-lime-300 
                   text-lime-300 rounded-lg shadow-lg py-2 z-50"
          >
            <a href="{{ route('logout.confirm') }}"
               class="block px-4 py-2 hover:bg-lime-200 hover:text-black transition duration-200">
               Cerrar sesión
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Menú móvil desplegable -->
  <div 
    x-show="navOpen" 
    x-transition 
    class="md:hidden bg-neutral-900 text-lime-300 px-6 py-2 space-y-2 rounded-lg mt-2"
  >
    <div class="flex flex-col items-start">
      <span class="block px-4 py-2 text-lime-400 font-semibold">
        {{ Auth::user()->username }}
      </span>
      <a href="{{ route('logout.confirm') }}" 
         class="block px-4 py-2 hover:bg-lime-200 hover:text-black">
        Cerrar sesión
      </a>
    </div>
  </div>
</header>
