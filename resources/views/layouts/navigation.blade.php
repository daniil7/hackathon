<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="text-sm">Главная</span>
                    </x-nav-link>
                </div>

                @if (Auth::user()->is_admin)
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('tanechka')" :active="request()->routeIs('tanechka')">
                        <span class="text-sm">Танечка</span>
                    </x-nav-link>
                </div>
                @endif
                
                <div class="flex items-center sm:ml-8">
                    <div x-data="{dropdownMenuCategories: false}" class="relative">
                        <!-- Dropdown toggle button -->
                        <button @click="dropdownMenuCategories = ! dropdownMenuCategories">
                            <span class="text-sm">Категории</span>
                        </button>
                        <!-- Dropdown list -->
                        <div x-show="dropdownMenuCategories" class="absolute right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                            @foreach (App\Models\Category::All() as $item)
                            <a href="{{ route('category', ['category' => $item->name]) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{$item->name}}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex items-center sm:ml-8">
                    <div x-data="{dropdownMenuCategories: false}" class="relative">
                        <!-- Dropdown toggle button -->
                        <button @click="dropdownMenuCategories = ! dropdownMenuCategories">
                            <span class="text-sm">Коллекции</span>
                        </button>
                        <!-- Dropdown list -->
                        <div x-show="dropdownMenuCategories" class="absolute right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                            @foreach (App\Models\Collection::All() as $item)
                            <a href="{{ route('collection', ['collection' => $item->name]) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{$item->name}}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- Log in/out Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Route::has('login'))
                        @auth

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div> {{Auth::user()->name}} </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('me')">
                                    Личный кабинет
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('cart')">
                                    Корзина
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        Выйти
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>


                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">

            @if (Route::has('login'))
                    @auth
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    @else
                        <div class="px-4">
                            <a href="{{ route('login') }}" class="font-medium text-base text-gray-800">Log in</a>
                        </div>
                        @if (Route::has('register'))
                        <div class="px-4 mt-3 space-y-1">
                            <a href="{{ route('register') }}" class="font-medium text-base text-gray-800">Register</a>
                        </div>
                        @endif
                    @endauth
            @endif

        </div>
    </div>
</nav>
