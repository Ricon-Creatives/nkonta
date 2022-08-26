<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="self-center">
            <div class="max-w-sm rounded overflow-hidden p-2 border-r">
                <div class="px-6 py-4">
                  <div class="text-sm mb-1 text-center">Bank 1</div>
                  <h1 class="font-bold text-gray-700 text-3xl text-center">
                      GHS {{ number_format($bank1,2) }}
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
                    GHS {{ number_format($bank2,2) }}
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
                    GHS - {{ number_format($pettyCash,2) }}
                </p>
            </div>
        </div>
    </div>
    <!-- ... -->
</div>
<!-- Grid -->

<div class=" bg-white">
<!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 mt-8 bg-white" id="cash">

      </div>
     <!-- Grid -->
       <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 mt-8 bg-white" id="inc-exp">

      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 mt-8 bg-white" id="sales">

      </div>
     <!-- Grid -->
    </div>
</x-app-layout>
