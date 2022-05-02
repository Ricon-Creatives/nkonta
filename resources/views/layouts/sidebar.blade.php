<!-- component -->
<div class="flex flex-wrap bg-gray-100 w-full h-screen">
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:block md:w-1/12 sm:w-3/12 bg-indigo-900 p-2 z-10
     fixed h-full">
        <div class="flex justify-center space-x-2 mb-16 bg-white">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-white">
                    <x-application-logo class="h-20 w-auto" />
                </a>
            </div>

        </div>

        <ul class="space-y-2 text-sm mt">
            <li>
                <a href="{{ route('home') }}" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400
                {{ request()->routeIs('home') ? ' bg-gray-400' : '' }} focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-home"></i>
                    </span>
                    <span class="hidden">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transactions') }}" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400
                {{ request()->routeIs('transactions') ? ' bg-gray-400' : '' }} focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-wallet"></i>
                    </span>
                    <span class="hidden">Transactions</span>
                </a>
            </li>
             <li>
                <a href="{{ route('reports') }}" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400
                {{ request()->routeIs('reports') ? ' bg-gray-400' : '' }} focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <span class="hidden">Reports</span>
                </a>
            </li>
            <li>
                <a href="{{ route('summary') }}"class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                {{ request()->routeIs('summary') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-pie"></i>
                    </span>
                    <span class="hidden">Summary</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bal-sheet') }}" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                 {{ request()->routeIs('bal-sheet') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-bar"></i>
                    </span>
                    <span class="hidden">My profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profit-loss') }}" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                 {{ request()->routeIs('profit-loss') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="hidden">My profile</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex flex-col items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-cog"></i>
                    </span>
                    <span class="hidden">Settings</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="md:w-1/12  w-full"></div>



    <!-- Page Content -->
    <div :class="{'w-full': open, 'w-full': ! open}" class="md:w-11/12 w-full">
        <div @click="open = ! open" :class="{'block': open, 'hidden': ! open}" class="hidden bg-black opacity-60 w-full h-screen fixed">

        </div>
        @include('layouts.navigation')

        <div class="p-3 text-gray-500">
            {{ $header }}
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>

</div>
