<x-app-layout>
 <!-- Grid -->
 <div class="grid grid-cols-1  bg-white">

     <!--Heading-->
     <x-slot name="header">
        <div class="bg-white p-4 mb-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
               MODEL COMPANY LIMITED INCOME STATEMENT
            </h2>
            <p class="font-semibold text-lg text-gray-800 text-center"> FOR PERIOD ENDING .....</p>
        </div>
        <input class="hidden" id="header" value="INCOME STATEMENT"/>
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
                <a  href="#" onclick="generate('proloss','Income-Statement','header')" class="text-gray-700 block px-4 py-2 text-sm">
                    PDF
                   </a>
                <!--<a href="#" onclick="htmlToCSV('proloss','Profit-Loss.csv')" class="text-gray-700 block px-4 py-2 text-sm">
                     CSV
                </a>-->
            </x-slot>
        </x-dropdown>
    </div>

        </div>

       <!--Table-->
       <div class="flex flex-col px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full" id="proloss">
                <thead class="bg-white border-b border-gray-300">
                  <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                     Code
                    </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                          Desc
                        </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                        BF
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                       DR
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                        CR
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @php($sumSales=0)
                    @php($sumLoss = 0)

                    @foreach ($books as $book)
                    <!--Income-->
                    @if ($book->type == 'Revenue')
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                 {{ $book->code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ $book->name }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                    </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{  ($book->type == 'Revenue') ? number_format($book->amount,2)  : '' }}
                      </td>
                      </tr>

                      @php($sumSales = $sumSales + $book->amount)
                    @endif
                    @endforeach
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                             Total Sales
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                    </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 underline decoration-double">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 underline decoration-double">
                          {{ number_format($sumSales,2) }}
                      </td>
                      </tr>

                      <!--Expense-->
                      @foreach ($books as $book)
                      @if ($book->type == 'Expense')
                      <tr class="bg-white border-b">
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                   {{ $book->code }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $book->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ ($book->type == 'Expense') ? number_format($book->amount,2) : ''  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        </td>
                    </tr>

                    @php($sumLoss = $sumLoss + $book->amount)
                    @endif
                    @endforeach
                    <tr class="bg-white border-b">
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                               Total
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                      </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 underline decoration-double">
                            {{number_format($sumLoss,2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 underline decoration-double">
                        </td>
                        </tr>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
 </div>
</x-app-layout>
