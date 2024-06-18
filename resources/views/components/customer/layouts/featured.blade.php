 <!--NAVBAR-->
 <header class="header-inner absolute w-full z-20 text-white">
     <nav class="md:flex md:items-center md:justify-between w-[92%] mx-auto">
         <div class="flex justify-between items-center p-3 md:py-0">
             <a href="/" class="flex items-center text-xl gap-3 hover:text-yellow-primary group">
                 <svg width="40" class="aspect-ratio fill-white group-hover:fill-yellow-primary mb-1"
                     viewBox="0 0 267 217" xmlns="http://www.w3.org/2000/svg">
                     <path
                         d="M133.311 0C145.753 9.17773 163.308 33.8267 133.989 59C121.321 49.9679 103.449 25.5229 133.311 0Z" />
                     <path
                         d="M245.103 65.859C250.759 75.7114 256.65 100.365 234.962 120.157C229.147 110.413 223.034 85.9109 245.103 65.859Z" />
                     <path
                         d="M173.307 207.739C188.48 189.328 182.86 168.648 177.645 160C156.454 179.755 162.835 203.337 168.675 212.658C169.621 211.772 170.511 210.878 171.348 209.976C170.55 210.965 169.865 211.921 169.298 212.814C196.114 222.809 214.939 206.915 221 197.718C198.344 189.217 181.661 198.899 173.307 207.739Z" />
                     <path
                         d="M197.218 131.691C203.586 139.529 212.029 159.226 199.566 179.569C206.609 169.653 221.782 157.744 245.4 163.008C240.679 172.959 224.249 191.319 196.302 185.153C196.739 184.189 197.284 183.148 197.938 182.057C197.234 183.067 196.477 184.077 195.664 185.085C188.584 176.667 178.983 154.204 197.218 131.691Z" />
                     <path
                         d="M223.312 145.456C233.203 123.746 222.422 105.224 215.146 98.2211C199.79 122.788 212.057 143.914 220.11 151.406C220.795 150.306 221.423 149.212 221.999 148.124C221.483 149.286 221.069 150.386 220.752 151.396C249.242 154.11 263.312 133.885 266.786 123.433C242.702 121.086 229.093 134.756 223.312 145.456Z" />
                     <path
                         d="M21.6834 65C16.027 74.9325 10.1363 99.7858 31.8253 119.739C37.6405 109.916 43.7533 85.2147 21.6834 65Z" />
                     <path
                         d="M93.4824 208.032C78.3087 189.472 83.9288 168.624 89.1446 159.906C110.336 179.822 103.955 203.594 98.115 212.991C97.1689 212.098 96.2786 211.197 95.4414 210.288C96.2401 211.284 96.925 212.248 97.4922 213.149C70.6744 223.225 51.8484 207.201 45.7877 197.93C68.4443 189.36 85.1282 199.121 93.4824 208.032Z" />
                     <path
                         d="M69.571 131.367C63.2023 139.268 54.7585 159.126 67.2223 179.634C60.1796 169.637 45.0057 157.631 21.3864 162.938C26.1082 172.97 42.5388 191.479 70.4868 185.263C70.0493 184.292 69.5042 183.241 68.8508 182.142C69.5544 183.16 70.3116 184.178 71.1251 185.195C78.2052 176.708 87.8065 154.062 69.571 131.367Z" />
                     <path
                         d="M43.4758 145.244C33.5843 123.357 44.3657 104.685 51.6421 97.625C66.998 122.391 54.7305 143.689 46.6773 151.242C45.9928 150.133 45.3643 149.03 44.789 147.933C45.3046 149.104 45.7188 150.214 46.0355 151.232C17.5443 153.968 3.47386 133.578 1.52588e-05 123.041C24.0848 120.675 37.6942 134.456 43.4758 145.244Z" />
                     <path
                         d="M178.681 48.4946C179.648 63.9254 172.05 93.2174 133.92 86.939C132.696 71.4285 139.934 42.025 178.681 48.4946Z" />
                     <path
                         d="M87.4842 49.7848C102.513 46.1527 132.679 48.5488 133.117 87.1895C118.055 91.0884 87.8412 89.066 87.4842 49.7848Z" />
                     <path
                         d="M178.681 90.4946C179.648 105.925 172.05 135.217 133.92 128.939C132.696 113.428 139.934 84.025 178.681 90.4946Z" />
                     <path
                         d="M87.4842 91.7848C102.513 88.1527 132.679 90.5488 133.117 129.189C118.055 133.088 87.8412 131.066 87.4842 91.7848Z" />
                     <path
                         d="M137 169.378C172.462 173.615 179.621 145.501 178.681 130.495C139.934 124.025 132.696 153.428 133.92 168.939C134.046 168.96 134.172 168.98 134.297 169H133.115C132.58 130.541 102.488 128.159 87.4842 131.785C87.818 168.513 114.253 172.668 130 169.866V196H137V169.378Z" />
                 </svg>
                 <span class="cursor-pointer text-2xl">San Xavier</span>
             </a>
             <span class="text-3xl cursor-pointer mx-2 md:hidden block hover:text-yellow-primary">
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
             <li class="mx-5">

                 <livewire:customer.cart.cart-button />
             </li>
             <li>
                 @if (Route::has('customer.login'))
                     @if (Auth::guard('customer')->check())
                         <!-- SETTINGS DROPDOWN -->
                         <div class="sm:flex sm:items-center">
                             <div class="mx-1 relative">
                                 <x-dropdown align="left" width="w-40">
                                     <x-slot name="trigger">
                                         <button type="button"
                                             class="inline-flex items-center px-3 py-1.5 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-transparent hover:text-yellow-primary focus:outline-none focus:bg-transparent active:bg-transparent transition ease-in-out duration-150">
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
 <section class="h-500 relative bg-center bg-cover flex justify-center"
     style="background-image: url({{ asset('images/banner.png') }}">
     <div class="text-5xl text-center gap-5 text-yellow-secondary pt-28 absolute w-full h-full flex flex-col justify-center items-center top-0 left-0 z-10"
         style="font-family: 'Kreon', serif; font-weight: 300;">
         <h2>Proveedores de Panes para Tiendas y Negocios</h2>
         <p class="text-2xl">Suministramos productos frescos y de alta calidad directamente a su
             tienda.
         </p>
     </div>
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
