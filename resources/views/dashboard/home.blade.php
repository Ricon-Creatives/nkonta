<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Menu') }}
        </h2>
    </x-slot>-->


    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="self-center">
            <div class="max-w-sm rounded overflow-hidden p-2 border-r">
                <div class="px-6 py-4">
                  <div class="text-sm mb-1 text-center">TOTAL INCOME</div>
                  <h1 class="font-bold text-gray-700 text-3xl text-center">
                      GH&#8373;{{ number_format($totalRevenue,2) }}
                </h1>
                </div>

              </div>
        </div>
        <!-- ... -->
        <div class="self-center">
            <div class="max-w-sm rounded overflow-hidden p-2 border-r">
                <div class="px-6 py-4">
                  <div class="text-sm mb-1 text-center">TOTAL EXPENSES</div>
                  <p class="font-bold text-gray-700 text-3xl text-center">
                    GH&#8373;{{ number_format($totalExpense,2) }}
                  </p>
                </div>
              </div>
        </div>
        <!-- ... -->
        <div class="">
            <div class="max-w-sm rounded overflow-hidden p-2">
                <div class="px-6 py-4">
                  <div class="text-sm mb-1 text-center">DEBTS DUE</div>
                  <p class="font-bold text-gray-700 text-3xl text-center">
                    GH&#8373;25K
                  </p>
                </div>
              </div>
        </div>
        <!-- ... -->
      </div>
     <!-- Grid -->

     <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 mt-8 bg-white">
        <div class="col-span-2 p-2 mx-1">
            <h3 class="font-bold text-center text-lg">Income And Expenditure</h3>
            <div class=" flex items-center justify-center mt-4">
                <div id="inc-exp" class="w-10/12">

                </div>
            </div>
        </div>

        <!-- ... -->
        <div class="p-2">
            <div class="flex justify-between">
                <h3 class="font-bold text-lg">Activities</h3> <button class="border rounded-3xl px-3 py-1 text-sm">view all</button>
            </div>
            <ul class="list-disc p-3 mt-4">
                <li>Now this is a story all about how, my life got flipped turned upside down</li>
                <!-- ... -->
                <li>Now this is a story all about how, my life got flipped turned upside down</li>
                <li>Now this is a story all about how, my life got flipped turned upside down</li>
              </ul>
        </div>
        <!-- ... -->
      </div>
     <!-- Grid -->

</x-app-layout>
