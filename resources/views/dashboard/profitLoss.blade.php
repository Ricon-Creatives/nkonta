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
    </x-slot>

     <!-- Link -->
     <div class="flex justify-between p-4">

        <a href="{{ route('download-profitloss-pdf') }}" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded-2xl shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
      Export PDF
      </a>
        </div>

       <!--Table-->
       <div class="flex flex-col px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
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
                          {{  ($book->type == 'Revenue') ?number_format($book->amount)  : '' }}
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
                          {{ number_format($sumSales) }}
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
                            {{ ($book->type == 'Expense') ? number_format($book->amount) : ''  }}
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
                            {{number_format($sumLoss) }}
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
