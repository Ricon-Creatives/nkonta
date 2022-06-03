<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">

      <!--Heading-->
   <x-slot name="header">
    <div class="bg-white p-4 mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center" id="">
           MODEL COMPANY LIMITED EXPENSE REPORT
        </h2>
        <p class="font-semibold text-lg text-gray-800 text-center"> AS OF .....</p>
    </div>
    <input class="hidden" id="header" value="EXPENSE REPORT"/>
    </x-slot>

    <!-- Link -->
    <div class="flex justify-between p-4">

       <!-- Exports -->
   <div class="inline-block text-left">
        <x-dropdown align="right" width="full">
            <x-slot name="trigger">
                <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-white bg-purple-900 text-sm font-medium focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                Export
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            </x-slot>

            <x-slot name="content" class="w-full origin-top-right absolute right-0 mt-1 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <a  href="#" onclick="generate('expenses','Expense-Report','header')" class="text-gray-700 block px-4 py-2 text-sm">
                    PDF
                   </a>
               <a href="#" onclick="htmlToCSV('expenses','Expense-Report.csv')" class="text-gray-700 block px-4 py-2 text-sm">
                     CSV
                    </a>
            </x-slot>
        </x-dropdown>
    </div>

     <!-- Date Range -->
     <form method="GET" action="{{ route('search.expense') }}">
        @csrf
    <div class="flex items-center justify-between">
        <input class="hidden" type="text" value="Expense" name="type"  required  />
      <x-input id="from" class="block w-full py-1 rounded-r-none" type="date" name="from_date"  required  />
      <span class="p-1 ">To</span>
      <x-input id="to" class="block w-full py-1 rounded-none" type="date" name="to_date"  required  />
      <x-button class="px-2 rounded-l-none">
          {{ __('Search') }}
      </x-button>
  </div>
</form>
      </div>

         <!--Table-->
         <div class="flex flex-col px-4 ">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">


              <table class="min-w-full" id="expenses">
                  <thead class="bg-white border-b border-gray-300">
                      <tr>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                          REF_NO
                      </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                         CODE
                      </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                        ACCOUNT
                      </th>
                          <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              DESC
                          </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                          AMOUNT
                      </th>
                      </tr>
                  </thead>
                  <tbody>
                      @php($total = 0)
                      @foreach ($transactions as $expense)

                      <tr class="bg-white border-b">
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $expense->reference_no}}
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $expense->code}}
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                              {{ $expense->name }}
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $expense->description_to_debit }}

                      </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                         {{ number_format($expense->amount,2)}}
                      </td>

                      </tr>
                      @php($total += $expense->amount)
                      @endforeach
                      <tr class="bg-white border-b">
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900">
                              Total
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900">
                         {{ number_format($total,2)}}
                      </td>

                      </tr>
                  </tbody>
                  {{ $transactions->links() }}
              </table>

          </div>
      </div>
    </div>
  </div>
    </div>
  </x-app-layout>
