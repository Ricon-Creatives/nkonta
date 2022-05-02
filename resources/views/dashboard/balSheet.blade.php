<x-app-layout>
 <!-- Grid -->
 <div class="grid grid-cols-1  bg-white">

    <!--Heading-->
    <x-slot name="header">
        <div class="bg-white p-4 mb-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
               MODEL COMPANY LIMITED BALANCE SHEET STATEMENT
            </h2>
            <p class="font-semibold text-lg text-gray-800 text-center"> AS OF .....</p>
        </div>
    </x-slot>

    <!-- Link -->
    <div class="flex justify-between p-4">

    <a href="{{ route('download-pdf') }}" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded-2xl shadow-sm hover:bg-purple-700 hover:shadow-lg
 focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
  Export PDF
  </a>
    </div>

       <!--Table-->
       <div class="flex flex-col px-4 ">
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

                    @php($sumAssets=0)
                    @foreach($accounts as $item)
                    @if ( $item->code >= 1000 &&  $item->code <= 1920)
                    <tr class="bg-white border-b">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900  text-left">
                    </td>
                    <td scope="col" class="text-sm font-medium text-gray-900 px-4 py-4">
                        {{number_format($item->amount)}}
                    </td>
                    <td scope="col" class="text-sm font-bold text-gray-900 px-4 py-4">

                    </td>
                    </tr>
                    @php($sumAssets = $sumAssets + $item->amount)
                    @endif
                    @endforeach
                    <tr  class="bg-white border-b">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">

                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 ">
                            Total Assets
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">
                                <span class=" underline decoration-double">
                                    {{number_format($sumAssets) }}
                                    </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">

                            </td>

                        </tr>

                     @php($sumLiabilities = 0)
                    @foreach($accounts as $item)
                    @if ($item->code >= 2100 && $item->code <= 2600)
                    <tr class="bg-white border-b">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    </td>
                    <td class="text-sm font-medium text-gray-900 px-4 py-4 text-left">
                    </td>
                    <td  class="text-sm text-gray-900 font-medium px-4 py-4">
                        {{number_format($item->amount)}}
                    </td>
                    </tr>
                    @php($sumLiabilities = $sumLiabilities + $item->amount)
                    @endif
                    @endforeach
                    <tr class="bg-white border-b">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">

                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 ">
                            Total Liability
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">
                        </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">

                                <span class=" underline decoration-double">
                            {{ number_format($sumLiabilities) }}
                               </span>
                            </td>
                        </tr>

                    @php($sumEquity = 0)
                    @foreach($accounts as $item)
                    @if ($item->code >= 2700 && $item->code <= 3200)

                    <tr class="bg-white border-b">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->code }}
                        </td>
                      <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    </td>
                    <td  class="text-sm font-medium text-gray-900 px-4 py-4">

                    </td>
                    <td  class="text-sm font-medium text-gray-900 px-4 py-4 text-left">
                        {{ number_format($item->amount)}}

                    </td>
                    </tr>
                    @php($sumEquity = $sumEquity + $item->amount)
                @endif
                @endforeach
                <tr  class="bg-white border-b">
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">

                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 ">
                        Total Equity
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">

                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">

                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-left">
                            <span class=" underline decoration-double">
                            {{ number_format($sumEquity)  }}
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
