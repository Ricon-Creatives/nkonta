<nav class="border-gray-100 h-11">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end h-8">
           <!-- <div class="flex">
                 Navigation Links
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
            </div>-->

            <!-- Settings Dropdown -->
         <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Notifications -->
                <div x-data="{ show: false }"  @click.away="show = false" class="relative mx-3">
                        <button @click="show = ! show" class="relative flex items-center text-lg font-medium text-yellow-500 hover:text-yellow-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-700 transition duration-150 ease-in-out">
                            <i class="fa-solid fa-bell"></i>
                            @if(auth()->user()->unreadnotifications->count())
                            <span
                            aria-hidden="true"
                            class="absolute top-0 right-0 text-xs inline-block p-1 w-3 h-3 bg-red-600 border-2 border-white rounded-full"
                          ></span>
                          @endif
                        </button>
                        <div x-show="show" x-cloak class="absolute right-4 bg-white z-10 shadow-md w-56">
                            <ul x-transition:leave="transition ease-in duration-150" class="p-2 mt-2">
                                @forelse (auth()->user()->unreadnotifications as $notification)
                                @if ($notification->type == 'App\Notifications\SendInvite')
                                <li class="flex">
                                    <div class="w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800">
                                        <span> {{ $notification->data['message']}}</span>
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-green-600 bg-green-100 rounded-full">
                                        <i class="fa-solid fa-handshake"></i>
                                     </span>
                                    </div>
                                @else
                                <li class="flex">
                                  <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
                                    <span>Messages</span>
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                      13
                                    </span>
                                  </a>
                                </li>
                                @endif
                                {{ $notification->markAsRead()}}
                                @empty
                                <li>
                                    <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:text-gray-600 text-gray-500" href="#">
                                    No new Notifications
                                    </a>
                                  </li>
                                @endforelse
                              </ul>
                        </div>
                </div>

                <div x-data="{ show: false }"  x-cloak  @click.away="show = false" class="relative">
                    <button @click="show = ! show" type="button" class="flex items-center text-base font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div class="pr-2">{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="show" class="absolute bg-white z-10 shadow-md w-36 right-1">

                        @can('view')
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Admin') }}
                        </x-dropdown-link>
                        @endcan
                        <x-dropdown-link :href="route('profile')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Mobile Links -->
            <div class="flex items-center sm:hidden">
                <!-- Notifications -->
                <div class="mx-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content" class="w-full">
                            <!-- Authentication -->

                        </x-slot>
                    </x-dropdown>
                </div>

                 <!-- Profile -->
                 <div x-data="{ show: false }"  @click.away="show = false" class="relative">
                    <button @click="show = ! show" type="button" class="flex items-center text-base font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div class="pr-2">{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="show" class="absolute bg-white z-10 shadow-md w-40">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Admin') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>


                <!-- Hamburger -->
                <button @click="open = ! open" class="inline-flex items-end justify-end p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="hidden sm:hidden">
       <!-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>-->


    </div>
</nav>
