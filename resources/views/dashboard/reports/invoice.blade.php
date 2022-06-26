<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">

      <!--Heading-->
   <x-slot name="header">
    </x-slot>

        <!--Form-->
        <div class="flex flex-col px-4">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white">
                    <!--Table-->
                    <table class="min-w-full">
                        <!--Invoice-->
                        <div class="w-full bg-white">
                            <ul class="font-bold">
                                <li class="flex justify-between p-3">
                                    Invoice No. {{$trade->id}}
                                   <span>
                                    Contact Person: {{ $trade->contact_person }}
                                   </span>
                                </li>
                                <li class="flex justify-between p-3">
                                  Supplier Name: {{ $trade->name }}
                                  <span>
                                    Contact No: {{ $trade->contact_no}}
                               </span>
                                </li>
                                <li class="flex items-center justify-between p-3">
                                    Contact Address: {{ $trade->address }}
                                    <span class="px-2 py-1 text-sm">
                                        Date: {{  \Carbon\Carbon::parse($trade->created_at)->format('D d-M-Y') }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <thead class="bg-white border-b border-gray-300">
                          <tr>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              ITEM NO.
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                ITEM NAME
                              </th>
                              <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                 QUANTITY
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                   UNIT PRICE (GHS)
                                  </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                             DISCOUNT(%)
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              TOTAL PRICE (GHS)
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($subtotal=0)
                            @foreach($trade->items as $index => $item)
                            @php($discount = $item->total * ($item->discount/100))

                            <tr class="bg-white border-b">
                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ $index +1 }}
                              </td>
                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ $item->item_name }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->qty }}
                            </td>
                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ number_format($item->price,2) }}
                              </td>
                              <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                  {{ $item->discount }}
                              </td>
                              <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                  {{number_format($item->total - $discount ,2)}}
                            </td>
                            </tr>
                            @php($subtotal += ($item->total - $discount))
                          @endforeach
                          @php($vat = number_format($subtotal * ($trade->vat/100),2))

                          <tr class="bg-white">
                            <td class="px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                              SUBTOTAL
                          </td>
                            <td class="px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="text-sm text-gray-900 px-4 py-0 whitespace-nowrap">
                            </td>
                            <td class="text-sm text-gray-900 px-4 py-0 font-bold whitespace-nowrap">
                                {{number_format($subtotal,2) }}
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold font-medium text-gray-900">
                             NHIS
                          </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 whitespace-nowrap">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 font-bold whitespace-nowrap">
                              -
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                             COVID
                          </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 whitespace-nowrap">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 font-bold whitespace-nowrap">
                              -
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                              VAT
                          </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 whitespace-nowrap">
                            </td>
                            <td class="text-sm text-gray-900 bg-white px-4 py-0 font-bold whitespace-nowrap">
                                {{ $vat }}
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class=" bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                              TOTAL
                          </td>
                            <td class=" bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                            </td>
                            <td class="text-sm text-gray-900  bg-white px-4 py-0 whitespace-nowrap">
                            </td>
                            <td class="text-sm text-gray-900  bg-white px-4 py-0 font-bold whitespace-nowrap">
                                {{ number_format($subtotal + $vat,2)}}
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
