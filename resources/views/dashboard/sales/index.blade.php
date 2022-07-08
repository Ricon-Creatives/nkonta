@if(session()->has('message'))
<div class="absolute right-0 p-1">
    <div class="flex items-center px-4 py-4 rounded  text-slate-800 bg-slate-300" role="alert">
        <p>{{ session()->get('message') }}</p>
    </div>
  </div>
@endif
<x-app-layout>
          <!--Heading-->
       <x-slot name="header">
        </x-slot>
    <!-- Grid -->
    <div class="grid grid-cols-1 bg-white p-2">

    <!-- Link -->
        <div class="flex justify-between p-4">
            <a  href="{{ route('sales.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
    focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
    Add Sales
    </a>

    <form method="GET" action="{{ route('search.sales') }}">
        @csrf
      <div class="flex flex-row items-center justify-center">
        <x-input id="type" type="text" name="search" class="block w-full rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
         focus:ring-opacity-50 py-1 mx-1" placeholder="Search..." required autofocus />
    <button type="submit" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
        focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
        Search
        </button>
    </div>
    </form>

        </div>
         <!--Form-->
         <div class="flex flex-col px-4">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <div class="mx-auto pb-10">
                      <!--Table-->
                      <table class="min-w-full">
                        <thead class="bg-white border-b border-gray-300">
                          <tr>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              NAME
                            </th>
                              <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                  ADDRESS
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                 CONTACT NO.
                                </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              DUE DATE (days)
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                              DATE
                            </th>
                            <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                                ACTIONS
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($sales as $trade)

                           <tr class="bg-white border-b">
                               <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                   {{ $trade->name }}
                              </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $trade->address }}
                            </td>
                              <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                  {{ $trade->contact_no }}
                              </td>
                              <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                  {{ $trade->due_date }}
                              </td>

                              <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                  {{  \Carbon\Carbon::parse($trade->created_at)->format('D d-M-Y') }}
                            </td>
                            <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                                <div x-data="{ show: false }"  @click.away="show = false" class="relative inline-block text-left mb-2">
                                    <button @click="show = ! show" type="button" class="flex items-center text-sm font-medium hover:text-yellow-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-700 transition duration-150 ease-in-out">
                                    <span class="">view</span>
                                    </button>
                                    <div x-show="show" class="absolute bg-white z-50 shadow-md w-40">
                                        <a class="block px-3 py-1" href="{{ route('sales.show',$trade->id) }}">Invoice</a>
                                        @if ($trade->type == 'Selling')
                                        <a class="block px-3 py-1" href="{{ route('show.estimate',['id' => $trade->id]) }}">Estimate</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                        </tbody>
                        {{ $sales->links() }}
                      </table>

                </div>
              </div>
            </div>
          </div>
         </div>

    </div>
</x-app-layout>
