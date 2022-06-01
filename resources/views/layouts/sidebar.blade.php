<!-- component -->
<div class="flex flex-wrap bg-gray-100 w-full h-screen">
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:block md:w-2/12 sm:w-3/12 bg-indigo-900 p-2 z-10
     fixed h-full overflow-x-hidden">
        <div class="flex justify-center space-x-2 mb-4">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" >
                    <img src="{{ 'img/logo-03.png' }}" class="h-24 w-auto"/>
                </a>
            </div>

        </div>

        <ul class="space-y-2 text-sm mb-4">
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
                <div x-data="{ show: false }"  @click.away="show = false" class="flex flex-col items-center space-x-3 p-2 rounded-md font-medium hover:bg-gray-400
             focus:shadow-outline">
                <button @click="show = ! show" type="button" class="flex flex-col items-center space-x-3 p-2  text-white font-medium hover:text-yellow-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-700 transition duration-150 ease-in-out">
                    <span class="text-white text-3xl">
                     <i class="fa-solid fa-bar-chart"></i>
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
                    <a href="{{ route('summary') }}" class="{{ request()->routeIs('summary') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Trial Balance</span>
                    </a>
                    <a href="{{ route('bal-sheet') }}" class="{{ request()->routeIs('bal-sheet') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Balance Sheet</span>
                    </a>
                    <a href="{{ route('profit-loss') }}" class="{{ request()->routeIs('profit-loss') ? ' text-blue-600' : '' }} focus:shadow-outline
                        text-center block px-4 py-2 text-sm leading-5 ">
                        <span class="">Prfoit & Loss</span>
                    </a>
                </div>
                </div>
            </li>

            <li>
                <a href="{{ route('sales.index') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-white text-3xl">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="">Sales</span>
                </a>
            </li>
            <li>
                <a href="{{ route('purchases.index') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-white text-3xl">
                <i class="fa-solid fa-coins"></i>
                    </span>
                    <span class="">Purchases</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="hidden sm:block md:w-2/12  w-full"></div>

    <!-- Page Content -->
    <div :class="{'w-full': open, 'w-full': ! open}" class="md:w-10/12 w-full">
        <div @click="open = ! open" :class="{'block': open, 'hidden': ! open}" class="hidden bg-black opacity-60 w-full h-screen fixed">

        </div>
        @include('layouts.navigation')

        <div class="p-2 text-gray-500">
            {{ $header }}
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>

</div>
