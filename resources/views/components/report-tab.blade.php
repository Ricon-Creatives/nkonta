<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">

          <!--Heading-->
       <x-slot name="header">
        <div class="">
        </div>
        </x-slot>

         <!--tabs-->
         <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-0 pl-0 mb-3 justify-center bg-gray-100">
         <li class="nav-item">
         <a href="{{ route('reports.revenue') }}" class="nav-link block font-medium text-xs  leading-tight
             uppercase border-0 border-t-0 border-b px-6 py-3 my-2 bg-transparent
             hover:border-b-blue-600 border-b-blue-600 {{ request()->routeIs('reports.revenue')  ? 'text-blue-600' : '' }}">
             Revenue</a>
         </li>
         <li class="nav-item">
         <a href="{{ route('reports.expenses') }}" class="nav-link {{ request()->routeIs('reports.expenses') ? 'text-blue-600' : '' }} block font-medium text-xs leading-tight uppercase
             border-0 border-t-0 border-b px-6 py-3 my-2 hover:border-b-blue-600 bg-transparent
             focus:border-b-blue-600"  >Expense</a>
         </li>
         <li class="nav-item">
             <a href="{{ route('reports.tax') }}" class="nav-link {{ request()->routeIs('reports.tax') ? 'text-blue-600' : '' }} block font-medium text-xs leading-tight uppercase
               border-0 border-b px-6 py-3 my-2 hover:border-b-blue-600 bg-transparent
               focus:border-b-blue-600">Tax</a>
           </li>
         </ul>


    <div class="tab-content" id="tabs-tabContent">
       {{ $slot }}
    </div>

    </div>
 </x-app-layout>
