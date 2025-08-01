<header class="fixed top-0 left-0 w-full bg-[#322411] z-50 p-4" x-data="{ navOpen: false }">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between w-full gap-4">
      
      <div class="flex-shrink-0">
        <a href="{{ route('home') }}">
          <img src="{{ asset('img/LogoInicial.jpg') }}" width="120px" />
        </a>
      </div>

      <div class="text-center md:flex-grow">
        <h1 class="text-4xl md:text-5xl lg:text-6xl text-white mb-1">ADMIN</h1>
      </div>

      
      <button @click="navOpen = !navOpen" class="text-white md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>


        
        <div class="flex flex-col md:mr-24 text-left">
          <h2 class="text-lg md:text-xl text-white mb-1">El rincón de los lectores más apasionados</h2>
          <div class="flex items-center gap-6 mt-3">
            <a href="{{ route('logout.confirm') }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                    {{ request()->routeIs('logout.confirm') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Cerrar sesión
          </a>
          </div>
        </div>
      </div>
    </div>


    
    <div x-show="navOpen" class="md:hidden mt-24 flex flex-col gap-4 text-white">
      <hr class="border-white my-2" />
      <a href="{{ route('logout.confirm') }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                    {{ request()->routeIs('logout.confirm') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Cerrar sesión
          </a>
    </div>

  </div>
</header>




