<x-app-layout>
 <!-- Grid -->
 <div class="grid grid-cols-1  bg-white p-2">

    <!--Heading-->
    <x-slot name="header">
        <div class="bg-white p-4 mb-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
               {{ Str::upper(Auth::user()->company_name) }} BALANCE SHEET STATEMENT
            </h2>
            <p class="font-semibold text-lg text-gray-800 text-center"> AS OF
                {{!empty($data) ? \Carbon\Carbon::parse($data['from_date'])->format('d-M-Y').' To '.\Carbon\Carbon::parse($data['to_date'])->format('d-M-Y')
                : \Carbon\Carbon::today()->format('d-M-Y') }}
            </p>
        </div>
        <input class="hidden" id="header" value="BALANCE SHEET STATEMENT"/>
    </x-slot>

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
        <a  href="#" onclick="generate('balSheet','Balance-Sheet','header')" class="text-gray-700 block px-4 py-2 text-sm">
                    PDF
                   </a>
               <!-- <a href="#" onclick="htmlToCSV('balSheet','Balance-Sheet.csv')" class="text-gray-700 block px-4 py-2 text-sm">
                     CSV
                </a>-->
    </div>
    </div>

    <!-- Date Range -->
    <form method="GET" action="{{ route('search.balance-sheet') }}" class="p-2">
        @csrf
     <div class="hidden sm:flex sm:items-center sm:justify-between justify-center w-full">
         <div class="sm:flex">
             <x-input id="from" class="w-full py-1 rounded-r-none" type="date" name="from_date"
             :value="old('from_date')" required  />
             <div class="p-1">To</div>
             <x-input id="to" class="w-full py-1 rounded-none" type="date" name="to_date"
             :value="old('to_date')" required  />
         </div>

         <x-button class="px-2 py-2 rounded">
             Search
         </x-button>
     </div>
 </form>

    </div>

       <!--Table-->
       <div class="flex flex-col px-4 ">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full" id="balSheet">
                <thead class="bg-white border-b border-gray-300">
                  <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-center">
                        Code
                    </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-center">
                          Desc
                        </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-center">
                        BF
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-center">
                        Amount (GHS)
                    </th>
                </tr>
                </thead>
                <tbody>

                    @php($sumAssets=0)
                    @foreach($accounts as $item)
                    @if ( $item->type == 'Asset')
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900  text-center">
                    </td>
                    <td scope="col" class="text-sm font-medium text-gray-900 px-4 py-2 text-center">
                        {{number_format($item->amount,2)}}
                    </td>
                    </tr>
                    @php($sumAssets = $sumAssets + $item->amount)
                    @endif
                    @endforeach
                    <tr  class="bg-white border-b">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center ">
                            Total Assets
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">
                                <span class=" underline decoration-double">
                                    {{number_format($sumAssets,2) }}
                                    </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                            </td>

                        </tr>

                     @php($sumLiabilities = 0)
                    @foreach($accounts as $item)
                    @if ($item->type == 'Liability')
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                    </td>
                    <td  class="text-sm text-gray-900 text-center font-medium px-4 py-2">
                        {{number_format($item->amount,2)}}
                    </td>
                    </tr>
                    @php($sumLiabilities = $sumLiabilities + $item->amount)
                    @endif
                    @endforeach
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center ">
                            Total Liability
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                            <span class=" underline decoration-double">
                        {{ number_format($sumLiabilities,2) }}
                           </span>
                        </td>

                        </tr>

                    @php($sumEquity = 0)
                    @foreach($accounts as $item)
                    @if ($item->type == 'Equity')

                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                    </td>
                    <td  class="text-sm font-medium text-gray-900 px-4 py-2 text-center">
                        {{ number_format($item->amount,2)}}

                    </td>
                    </tr>
                    @php($sumEquity = $sumEquity + $item->amount)
                @endif
                @endforeach
                <tr  class="bg-white border-b">
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center ">
                        Total Equity
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">

                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 text-center">
                            <span class=" underline decoration-double">
                            {{ number_format($sumEquity,2)  }}
                            </span>
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
