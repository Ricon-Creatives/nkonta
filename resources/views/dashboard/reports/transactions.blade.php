@if(session()->has('message'))
<div class="absolute right-0 p-1">
    <div class="flex items-center px-4 py-4 rounded  text-slate-800 bg-slate-300" role="alert">
        <p>{{ session()->get('message') }}</p>
    </div>
  </div>
@endif
<x-app-layout>

  <x-slot name="header">
    <input class="hidden" id="header" value="TRANSACTIONS"/>
    </x-slot>

     <!-- Grid -->
    <div class="grid grid-cols-1 bg-white p-2">
        <!-- Link -->
        <div class="sm:flex sm:justify-between p-4">
            <button type="button" class="inline-block px-6 py-2.5 bg-purple-900 mb-2 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#addModal">
      Add Transaction
      </button>

       <!-- Exports
     <div x-data="{ show: false }"  @click.away="show = false" class="inline-block text-left">
        <button @click="show = ! show" type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-white bg-purple-900 text-sm font-medium focus:outline-none
        focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
        Export

        <svg class="-mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="show" x-transition x-cloak class="absolute bg-white z-10 shadow-md w-40">
        <a  href="#" onclick="generate('transact','Transactions','header')" class="text-gray-700 block px-4 py-2 text-sm">
            PDF
           </a>
        <!--<a href="#" onclick="htmlToCSV('proloss','Profit-Loss.csv')" class="text-gray-700 block px-4 py-2 text-sm">
             CSV
        </a>
</div>
</div>-->

       <!-- <button type="button" class="inline-block px-6 py-2.5 bg-purple-900  text-white font-bold text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 border border-black active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#search">
      Search
      <i class="fa-solid fa-search"></i>
      </button>-->
          <!--Form-->
    <form method="GET" action="{{ route('search.transaction') }}">
        <div class="flex flex-row items-center justify-center">
        @csrf
        <x-input id="type" type="text" name="search" class="block w-full rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
         focus:ring-opacity-50 py-1 sm:mx-1" placeholder="Search..." required autofocus />
    <button type="submit" class="inline-block px-4 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
        focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
        <i class="fa-solid fa-search"></i>
        </button>
    </div>
    </form>
    </div>


       <!--Table-->
       <div class="flex flex-col px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full" id="transact">
                <thead class="bg-white border-b border-gray-300">
                  <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                      DATE
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                        CODE
                      </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                          ACCOUNTS
                        </th>
                        <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                            REF_NO.
                          </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                      DESCRIPTION
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                      DEBIT
                      (GHS)
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                      CREDIT
                      (GHS)
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)

                    <tr class="bg-white border-b">
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ \Carbon\Carbon::parse($transaction->date)->format('D d-M-Y') }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $transaction->account->code }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $transaction->account->name }}
                    </td>
                      <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ $transaction->reference_no }}
                      </td>
                      <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                       {{($transaction->type == 'debit') ? $transaction->description_to_debit : $transaction->description_to_credit}}
                      </td>

                      <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                          {{ ($transaction->type == 'debit') ? number_format($transaction->amount,2) : "" }}
                    </td>
                    <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                        {{ ($transaction->type == 'credit') ? number_format($transaction->amount,2)  : "" }}
                      </td>
                    </tr>

                  @endforeach

                </tbody>
                {{ $transactions->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>


    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-modal="true" role="dialog">
      <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

          <div class="modal-body relative p-4">
              @include('partials.tab.tabForms')
          </div>

        </div>
      </div>
    </div>

    <!--Search-->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="search" tabindex="-1" aria-labelledby="search" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

            <div class="modal-body relative p-4">
                @include('partials.search.index')
            </div>

          </div>
        </div>
      </div>


</x-app-layout>
