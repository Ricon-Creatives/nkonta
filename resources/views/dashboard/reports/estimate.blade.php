<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1 p-2">
        <!--Form-->
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white">
                    <!--Table-->
                    <table class="min-w-full">
                        <!--Invoice-->
                        <div class="w-full bg-white">
                            <ul class="divide-x-2 font-bold">
                                <li class="flex justify-between p-3">
                                    Supplier Name: {{ $trade->name }}
                                   <span>
                                    Contact Person: {{ $trade->contact_person }}
                                   </span>
                                </li>
                                <li class="flex justify-between p-3">
                                    Contact Address: {{ $trade->address }}
                                  <span>
                                    Contact No: {{ $trade->contact_no}}
                               </span>
                                </li>
                                <li class="flex items-center justify-between p-3">
                                Date: {{  \Carbon\Carbon::parse($trade->created_at)->format('D d-M-Y') }}
                                </li>
                            </ul>
                        </div>

                        <thead class="bg-white border-b border-gray-300">
                          <tr>

                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                               QUANTITY
                              </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                ITEM NAME
                              </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                   UNIT PRICE (GHS)
                                  </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              TOTAL PRICE (GHS)
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($subtotal=0)
                            @foreach($trade->items as $item)
                            @php($discount = $item->total * ($item->discount/100))

                            <tr class="bg-white border-b">
                                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $item->qty }}
                                </td>

                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ $item->item_name }}
                            </td>
                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ number_format($item->price,2) }}
                              </td>

                              <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                  {{number_format($item->total - $discount ,2)}}
                            </td>
                            </tr>
                            @php($subtotal += $item->total)
                          @endforeach
                          @php($vat = $subtotal * ($trade->vat/100))

                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-medium text-gray-900">
                          </td>
                          <td class="text-sm text-gray-900 bg-white px-4 py-0 whitespace-nowrap">
                        </td>
                        <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                            SUBTOTAL
                        </td>
                            <td class="text-sm text-gray-900 bg-white font-bold px-4 py-0 whitespace-nowrap">
                                {{number_format($subtotal,2) }}
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                          </td>
                          <td class="text-sm text-gray-900 bg-white px-4 py-0 whitespace-nowrap">
                        </td>
                        <td class="bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                            VAT
                        </td>
                            <td class="text-sm text-gray-900 bg-white font-bold px-4 py-0 whitespace-nowrap">
                                {{ number_format($vat,2)}}
                          </td>
                          </tr>
                          <tr class="bg-white">
                            <td class=" bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                          </td>
                          <td class="text-sm text-gray-900 font-bold bg-white px-4 py-0 whitespace-nowrap">
                        </td>
                        <td class=" bg-white px-4 py-0 whitespace-nowrap text-sm font-bold text-gray-900">
                            TOTAL
                        </td>
                            <td class="text-sm text-gray-900 font-bold bg-white px-4 py-0 whitespace-nowrap">
                                {{ number_format($subtotal+$vat,2) }}
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
