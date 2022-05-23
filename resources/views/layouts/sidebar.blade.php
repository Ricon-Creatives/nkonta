<!-- component -->
<div class="flex flex-wrap bg-gray-100 w-full h-screen">
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:block md:w-1/12 sm:w-3/12 bg-indigo-900 p-2 z-10
     fixed h-full overflow-x-hidden">
        <div class="flex justify-center space-x-2 mb-11">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" >
                    <img src="{{ 'img/logo-03.png' }}" class="h-24 w-auto"/>
                </a>
            </div>

        </div>

        <ul class="space-y-2 text-sm mt">
            <li>
                <a href="{{ route('home') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400
                {{ request()->routeIs('home') ? ' bg-gray-400' : '' }} focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-home"></i>
                    </span>
                    <span class="">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transactions') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400
                {{ request()->routeIs('transactions') ? ' bg-gray-400' : '' }} focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-wallet"></i>
                    </span>
                    <span class="">Transactions</span>
                </a>
            </li>

            <li>
                <div x-data="{ show: false }"  @click.away="show = false" class="flex rounded-md font-medium hover:bg-gray-400
             focus:shadow-outline">
                <button @click="show = ! show" type="button" class="flex flex-col items-center space-x-3 p-2  text-white font-medium hover:text-yellow-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-700 transition duration-150 ease-in-out">
                    <span class="text-white text-3xl">
                     <i class="fa-solid fa-file self-center"></i>
                    </span>
                 <span class="">Reports</span>
                </button>
                <div x-show="show" class="absolute bg-white z-50 shadow-md">
                    <a href="{{ route('reports.revenue') }}" class="{{ request()->routeIs('reports.revenue') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Revenue Reports</span>
                    </a>
                    <a href="{{ route('reports.expenses') }}" class="{{ request()->routeIs('reports.expenses') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Expense Reports</span>
                    </a>
                    <a href="{{ route('reports.tax') }}" class="{{ request()->routeIs('reports.tax') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Tax Reports</span>
                    </a>
                </div>
                </div>
            </li>
            <li>
                <a href="{{ route('summary') }}"class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                {{ request()->routeIs('summary') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-pie"></i>
                    </span>
                    <span class="">Summary</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bal-sheet') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                 {{ request()->routeIs('bal-sheet') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-bar"></i>
                    </span>
                    <span class="">Bal.Sheet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profit-loss') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline
                 {{ request()->routeIs('profit-loss') ? ' bg-gray-400' : '' }}">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="">Prfoit&Loss</span>
                </a>
            </li>

            <li>
                <a href="{{ route('trade') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-cog"></i>
                    </span>
                    <span class="">Trade</span>
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
