<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">

         <!--tabs-->
         <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-0 pl-0 mb-3 justify-center bg-gray-100" id="tabs-tab"
         role="tablist">
         <li class="nav-item" role="presentation">
         <a href="#tabs-home" class="nav-link text-indigo-900 block font-medium text-xs  leading-tight
             uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2
             hover:border-transparent hover:bg-gray-100 focus:border-transparent active" id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home"
             aria-selected="true">Income</a>
         </li>
         <li class="nav-item" role="presentation">
         <a href="#tabs-profile" class="nav-link text-indigo-900 block font-medium text-xs leading-tight uppercase
             border-x-0 border-t-0 border-b-2 px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100
             focus:border-transparent" id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
             aria-controls="tabs-profile" aria-selected="false">Expense</a>
         </li>
         <li class="nav-item" role="presentation">
             <a href="#tabs-profile" class="nav-link text-indigo-900 block font-medium text-xs leading-tight uppercase
               border-x-0 border-t-0 border-b-2 px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100
               focus:border-transparent" id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
               aria-controls="tabs-profile" aria-selected="false">Tax</a>
           </li>
         </ul>


    <div class="tab-content" id="tabs-tabContent">
        <div class="tab-pane fade show active" id="tabs-revenue" role="tabpanel" aria-labelledby="tabs-home-tab">
            @include('dashboard.reports.revenue')
        </div>
        <div class="tab-pane fade show active" id="tabs-expense" role="tabpanel" aria-labelledby="tabs-home-tab">
            @include('dashboard.reports.expense')
        </div>
        <div class="tab-pane fade show active" id="tabs-tax" role="tabpanel" aria-labelledby="tabs-home-tab">
            @include('dashboard.reports.tax')
        </div>
    </div>

    </div>
   </x-app-layout>
