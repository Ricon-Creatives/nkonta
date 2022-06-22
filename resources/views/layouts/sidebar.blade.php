<!-- component -->
<div class="flex bg-gray-100 w-full h-screen">
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:block md:w-1/12 w-6/12">
    <div class=" bg-indigo-800 p-2 fixed h-full overflow-x-hidden z-50">
        <div class="flex justify-center space-x-2 mb-4">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" >
                    <img src="{{ asset('img/logo-03.png') }}" class="h-24 w-auto"/>
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

            <li class="relative">
                <div x-data="{ show: false }"  @click.away="show = false" class="flex flex-col items-center space-x-3 p-2 rounded-md font-medium
             focus:shadow-outline">
                <button  @click="show = ! show" type="button" class="flex flex-col items-center space-x-3 p-2 text-white font-medium hover:text-gray-700 transition duration-150 ease-in-out">
                    <span class="text-white text-3xl">
                     <i class="fa-solid fa-bar-chart"></i>
                    </span>
                 <span class="">Reports</span>
                </button>
                <!--Content-->
                <div x-show="show" x-cloak class="origin-top-right absolute"
                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="right: -11px;">
                <div class="p-2 z-50 fixed rounded-sm shadow-lg bg-indigo-800 focus:outline-none">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class=" space-y-2 text-sm font-medium text-white rounded-md shadow-inner w-full"
                    aria-label="submenu"
                  >
                    <li
                      class="px-2 py-0 transition-colors duration-150 text-white">
                      <a href="{{ route('reports.revenue') }}" class="{{ request()->routeIs('reports.revenue') ? ' text-blue-600' : '' }} focus:shadow-outline
                          text-left block text-sm leading-5 ">
                          <span class="">Revenue Reports</span>
                      </a>
                    </li>
                    <li
                    class="px-2 py-0 transition-colors duration-150 text-white">
                    <a href="{{ route('reports.expenses') }}" class="{{ request()->routeIs('reports.expenses') ? ' text-blue-600' : '' }} focus:shadow-outline
                      text-left block text-sm leading-5 ">
                      <span class="">Expense Reports</span>
                  </a>
                  </li>
                  <li
                  class="px-2 py-0 transition-colors duration-150 text-white">
                  <a href="{{ route('reports.tax') }}" class="{{ request()->routeIs('reports.tax') ? ' text-blue-600' : '' }} focus:shadow-outline
                      text-left block text-sm leading-5 ">
                      <span class="">Tax Reports</span>
                  </a>
                </li>
                <li
                class="px-2 py-0 transition-colors duration-150 text-white">
                <a href="{{ route('summary') }}" class="{{ request()->routeIs('summary') ? ' text-blue-600' : '' }} focus:shadow-outline
                  text-left block text-sm leading-5 ">
                  <span class="">Trial Balance</span>
              </a>
              </li>
              <li
                  class="px-2 py-0 transition-colors duration-150 text-white">
                  <a href="{{ route('bal-sheet') }}" class="{{ request()->routeIs('bal-sheet') ? ' text-blue-600' : '' }} focus:shadow-outline
                      text-left block text-sm leading-5 ">
                      <span class="">Balance Sheet</span>
                  </a>
              </li>
              <li
              class="px-2 py-0 transition-colors duration-150 text-white">
              <a href="{{ route('profit-loss') }}" class="{{ request()->routeIs('profit-loss') ? ' text-blue-600' : '' }} focus:shadow-outline
                  text-left block text-sm leading-5 ">
                  <span class="">Prfoit & Loss</span>
              </a>
              </li>
                  </ul>
                </div>`
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

          <!--  <li>
                <a href="{{ route('employee.index') }}" class="flex flex-col items-center space-x-3 text-white p-2 rounded-md font-medium hover:bg-gray-400 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-white text-3xl">
                <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="">Add User</span>
                </a>
            </li>-->

        </ul>
    </div>
    </div>


    <!-- Page Content -->
    <div :class="{'w-full': open, 'w-full': ! open}" class="md:w-11/12 w-full">
        <div @click="open = ! open" :class="{'block': open, 'hidden': ! open}" class="hidden absolute h-full bg-black opacity-60 w-full z-10">

        </div>
        @include('layouts.navigation')

        <div class="px-2 pt-2 pb-8 text-gray-500">
            {{ $header }}
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>

</div>
