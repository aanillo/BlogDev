<header class="fixed top-0 left-0 w-full bg-[#322411] z-50 p-4" x-data="{ navOpen: false }">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between w-full gap-4">
      
      <div class="flex-shrink-0">
        <a  href="{{ route('home') }}">
          <img src="{{ asset('img/LogoInicial.jpg') }}" width="120px" />
        </a>
      </div>

      
      <button @click="navOpen = !navOpen" class="text-white md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      
      <div class="hidden md:flex md:items-center md:gap-8 w-full justify-between">
        <div class="flex flex-col text-left ml-48">
          <a class="text-white">
            <h1 class="text-4xl md:text-5xl text-white leading-tight">Libreros</h1>
          </a>
          <div class="flex gap-12 mt-3">
            <a href="{{ route('books') }}"
              class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                      {{ request()->is('books*', 'purchases*') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Libros
            </a>

            <a href="{{ route('writers') }}"
              class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                      {{ request()->is('writers*') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Autores
            </a>

          </div>
        </div>

        
        <div class="flex flex-col md:mr-24 text-left">
          <h2 class="text-xl md:text-2xl text-white mb-6">El rincón de los lectores más apasionados</h2>
          <div class="flex items-center gap-8">
          <a href="{{ route('profile', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                    {{ request()->routeIs('profile') || request()->is('users/profile*') ? 'text-amber-200 scale-125' : 'text-white' }}">
              {{ auth()->user()->username }}
          </a>

          <a href="{{ route('user.purchases', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                    {{ request()->routeIs('user.purchases') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Historial
          </a>

          <a href="{{ route('cart.index', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-125 
                    {{ request()->routeIs('cart.index') ? 'text-amber-200 scale-125' : 'text-white' }}">
              Carrito
          </a>

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
      <a href="{{ route('books') }}"
              class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                      {{ request()->is('books*', 'purchases*') ? 'text-amber-200' : 'text-white' }}">
              Libros
            </a>

            <a href="{{ route('writers') }}"
              class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                      {{ request()->is('writers*') ? 'text-amber-200' : 'text-white' }}">
              Autores
            </a>
      <hr class="border-white my-2" />
        
      <a href="{{ route('profile', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                    {{ request()->routeIs('profile') || request()->is('users/profile*') ? 'text-amber-200' : 'text-white' }}">
              {{ auth()->user()->username }}
          </a>

          <a href="{{ route('user.purchases', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                    {{ request()->routeIs('user.purchases') ? 'text-amber-200' : 'text-white' }}">
              Historial
          </a>

          <a href="{{ route('cart.index', ['id' => auth()->user()->id]) }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                    {{ request()->routeIs('cart.index') ? 'text-amber-200' : 'text-white' }}">
              Carrito
          </a>

          <a href="{{ route('logout.confirm') }}"
            class="text-xl md:text-xl transition-transform duration-300 hover:scale-105 
                    {{ request()->routeIs('logout.confirm') ? 'text-amber-200' : 'text-white' }}">
              Cerrar sesión
          </a>
    </div>

  </div>
</header>


<div class="fixed mt-[135px] w-full bg-amber-200 text-black py-2 z-50 flex justify-center items-center">
    <h2 class="text-2xl font-semibold">Bienvenid@ {{ auth()->user()->username }}</h2>
</div>

