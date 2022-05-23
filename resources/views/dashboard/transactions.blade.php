<x-app-layout>

  <x-slot name="header">
    </x-slot>

     <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">
        <!-- Link -->
        <div class="flex justify-between p-4">
            <button type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#addModal">
      Add Transaction
      </button>
        <button type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#invoiceModal">
      Create Invoice
      </button>
        </div>

        <!-- Select
            <div class="flex justify-start px-3">
                <div class="mb-1">
                  <select class="form-select appearance-none border-0 block py-1.5 text-base font-normal text-gray-700
                    bg-white bg-no-repeat transition ease-in-out m-0
                    focus:text-gray-700 focus:bg-white focus:outline-none" aria-label="Default select example">
                      <option selected>All transactions</option>
                      <option value="1">Income</option>
                      <option value="2">Expense</option>
                      <option value="3">Transfer</option>
                  </select>
                </div>
              </div>-->

         <!-- Buttons
         <div class="md:flex md:justify-between p-4 mx-2">
            <h5 class="text-base">Account Balance</h5>
            <div class="flex flex-row items-center justify-center">
                <h6 class="text-base">Balance:  +gh<span class="text-xs">&#8373;</span>50,000</h6>
                <span class="mx-2">&nbsp;|&nbsp;</span>
                <h6 class="text-base">Available:  +gh<span class="text-xs">&#8373;</span>55,000</h6>

            </div>
        </div>-->


       <!--Table-->
       <div class="flex flex-col px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="bg-white border-b border-gray-300">
                  <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                      DATE
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                        CODE
                      </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                          ACCOUNTS
                        </th>
                        <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                            REF_NO.
                          </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                      DESCRIPTION
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                      DEBIT
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                      CREDIT
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)

                    <tr class="bg-white border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ $transaction->date }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $transaction->account->code }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $transaction->account->name }}
                    </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ $transaction->reference_no }}
                      </td>
                      <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
                       {{($transaction->type == 'debit') ? $transaction->description_to_debit : $transaction->description_to_credit}}
                      </td>

                      <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
                          {{ ($transaction->type == 'debit') ? number_format($transaction->amount,2) : "" }}
                    </td>
                    <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap">
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


</x-app-layout>
