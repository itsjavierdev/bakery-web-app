 <!--NAVBAR-->
 <header class="header-inner absolute w-full z-20 text-white">
     <nav class="md:flex md:items-center md:justify-between w-[92%] mx-auto">
         <div class="flex justify-between items-center ">
             <a href="/" class="flex items-center text-xl">
                 <img class="w-16 cursor-pointer p-3" src="{{ asset('logo/logo.PNG') }}" alt="...">
                 <span class="cursor-pointer hover:text-yellow-primary">San Xavier</span>
             </a>
             <span class="text-3xl cursor-pointer mx-2 md:hidden block">
                 <i class="icon-bars text-2xl" id="menu" name="menu" onclick="Menu(this)"></i>
             </span>
         </div>
         <ul id="menu-list"
             class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-transparent max-md:bg-brown-primary w-full left-0 md:w-auto py-4 pl-4 top-[-400px] transition-all ease-in duration-300 md:duration-0">
             <li class="mx-4 my-6 md:my-0">
                 <a href="/" class="text-medium hover:text-yellow-primary">Inicio</a>
             </li>
             <li class="mx-4 my-6 md:my-0">
                 <a href="{{ route('customer.shop') }}" class="text-medium hover:text-yellow-primary">Tienda</a>
             </li>
             <livewire:customer.cart.cart-button />
             <li>
                 @if (Route::has('customer.login'))
                     @if (Auth::guard('customer')->check())
                         <!-- SETTINGS DROPDOWN -->
                         <div class="sm:flex sm:items-center">
                             <div class="mx-1 relative">
                                 <x-dropdown align="left" width="w-40">
                                     <x-slot name="trigger">
                                         <button type="button"
                                             class="inline-flex items-center px-3 py-1.5 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-brown-primary hover:text-yellow-primary focus:outline-none focus:bg-brown-secondary active:brown-secondary transition ease-in-out duration-150">
                                             {{ Auth::guard('customer')->user()->customer->name }}

                                             <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                             </svg>
                                         </button>
                                     </x-slot>

                                     <x-slot name="content">
                                         <!-- Account Management -->
                                         <div class="block px-4 py-2 text-xs text-gray-400">
                                             {{ __('Manage Account') }}
                                         </div>

                                         <x-dropdown-link href="{{ route('customer.addresses') }}">
                                             Mis direcciones
                                         </x-dropdown-link>

                                         <div class="border-t border-gray-200"></div>

                                         <!-- Authentication -->
                                         <form method="POST" action="{{ route('customer.logout') }}" x-data>
                                             @csrf

                                             <x-dropdown-link href="{{ route('customer.logout') }}"
                                                 @click.prevent="$root.submit();">
                                                 {{ __('Log Out') }}
                                             </x-dropdown-link>
                                         </form>
                                     </x-slot>
                                 </x-dropdown>
                             </div>
                         </div>
                     @else
                         <a href="{{ route('customer.login') }}"
                             class="text-medium hover:text-yellow-primary md:ml-5 ml-4 ">Iniciar
                             Sesión</a>
                     @endif
                     </div>
                 @endif
             </li>
         </ul>
     </nav>
 </header>
 <!--IMAGE HEADER-->
 <section
     class="h-500 relative bg-center bg-cover {{ $featured->has_filter ? 'content-banner' : '' }} flex justify-center"
     style="background-image: url({{ asset('storage/featured/720/' . $featured->image) }});">
     @if ($featured->title)
         <p class="text-6xl text-center text-white pt-60 absolute w-full h-full justify-center items-center top-0 left-0 z-10"
             style="font-family: 'Caveat', cursive;">{{ $featured->title }}</p>
     @endif
     @if ($featured->product_id)
         <a href="" class="w-full h-full absolute justify-center items-center top-0 left-0 z-10">
         </a>
     @endif
 </section>

 @push('js')
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script>
         function Menu(e) {
             let list = document.getElementById("menu-list");
             let icon = document.getElementById("menu");
             e.name === "menu" ?
                 ((e.name = "close"),
                     list.classList.add("top-[0px]"),
                     list.classList.add("opacity-100"),
                     list.classList.add("pt-12"),
                     icon.classList.remove("icon-bars"),
                     icon.classList.add("icon-x")) :
                 ((e.name = "menu"),
                     list.classList.remove("top-[0px]"),
                     list.classList.remove("opacity-100"),
                     list.classList.remove("pt-12"),
                     icon.classList.remove("icon-x"),
                     icon.classList.add("icon-bars"));
         }
         $(function() {
             var navbar = $('.header-inner');
             $(window).scroll(function() {
                 if ($(window).scrollTop() <= 40) {
                     navbar.removeClass(
                         'bg-brown-primary sticky top-0 shadow-md transition-all duration-200');
                 } else {
                     navbar.addClass('bg-brown-primary sticky top-0 shadow-md transition-all duration-200');
                 }
             });
         });
     </script>
 @endpush
