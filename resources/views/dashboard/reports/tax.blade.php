<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1 bg-white p-2">

      <!--Heading-->
    <div class="bg-white p-4 mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center" id="">
            {{   Str::upper(Auth::user()->company_name) }} TAX REPORT
        </h2>
        <p class="font-semibold text-lg text-gray-800 text-center"> AS OF
            {{!empty($data) ? \Carbon\Carbon::parse($data['from_date'])->format('d-M-Y').' To '.\Carbon\Carbon::parse($data['to_date'])->format('d-M-Y')
                : \Carbon\Carbon::today()->format('d-M-Y') }}
        </p>
    </div>
    <input class="hidden" id="header" value="TAX REPORT"/>

    <!-- Link -->
    <div class="flex justify-between p-4">
       <!-- Exports -->
       <div x-data="{ show: false }"  @click.away="show = false" class="inline-block text-left">
        <button @click="show = ! show" type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-white bg-purple-900 text-sm font-medium focus:outline-none
        focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
        Export
        <!-- Heroicon name: solid/chevron-down -->
        <svg class="-mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>


    <div x-show="show" x-transition x-cloak class="absolute bg-white z-10 shadow-md w-40">
        <a  href="#" onclick="generate('tax','Tax-Report','header')" class="text-gray-700 block px-4 py-2 text-sm">
                    PDF
                   </a>
               <!-- <a href="#" onclick="htmlToCSV('expenses','Expense-Report.csv')" class="text-gray-700 block px-4 py-2 text-sm">
                     CSV
                    </a>-->
    </div>
    </div>

    <!-- Date Range -->
    <form method="GET" action="{{ route('search.tax') }}">
        @csrf
    <div class="flex items-center justify-between">

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


              <table class="min-w-full" id="tax">
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
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-right">
                          AMOUNT (GHS)
                      </th>
                      </tr>
                  </thead>
                  <tbody>
                      @php($total = 0)
                      @foreach ($transactions as $tax)

                      <tr class="bg-white border-b">
                          <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $tax->reference_no}}
                          </td>
                          <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $tax->code}}
                          </td>
                          <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                              {{ $tax->name }}
                          </td>
                          <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $tax->description_to_debit}}
                      </td>
                      <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                         {{ number_format($tax->amount,2)}}
                      </td>

                      </tr>
                      @php($total += $tax->amount)
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
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
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
