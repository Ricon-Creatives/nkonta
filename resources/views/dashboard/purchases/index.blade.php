<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1">

      <!--Heading-->
   <x-slot name="header">
    </x-slot>

    <!-- Link -->
        <div class="flex justify-between p-4">
            <a  href="{{ route('purchases.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
    focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
    Add New
    </a>

        </div>
         <!--Form-->
         <div class="flex flex-col px-4">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden bg-white">
                <div class="mx-auto px-4 py-10">
                      <!--Table-->
                      <table class="min-w-full">
                        <thead class="bg-white border-b border-gray-300">
                          <tr>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                              NAME
                            </th>
                              <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                  ADDRESS
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                 CONTACT NO.
                                </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                              DUE DATE (days)
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                              DATE
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                ACTIONS
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($purchases as $trade)

                           <tr class="bg-white border-b">
                               <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                   {{ $trade->name }}
                              </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $trade->address }}
                            </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ $trade->contact_no }}
                              </td>
                              <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
                                  {{ $trade->due_date }}
                              </td>

                              <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
                                  {{  \Carbon\Carbon::parse($trade->created_at)->format('D d-M-Y') }}
                            </td>
                            <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
                                <div x-data="{ show: false }"  @click.away="show = false" class="relative inline-block text-left mb-2">
                                    <button @click="show = ! show" type="button" class="flex items-center text-sm font-medium hover:text-yellow-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-700 transition duration-150 ease-in-out">
                                    <span class="pr-2">view</span>
                                    </button>
                                    <div x-show="show" class="absolute bg-white z-10 shadow-md w-40">
                                        <a class="block px-3 py-2" href="{{ route('purchases.show',$trade->id) }}">Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                        </tbody>
                        {{ $purchases->links() }}
                      </table>

                </div>
              </div>
            </div>
          </div>
         </div>

    </div>
</x-app-layout>
