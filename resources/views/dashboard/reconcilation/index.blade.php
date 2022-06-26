<x-app-layout>

    <!--Heading-->
 <x-slot name="header">
  </x-slot>
<!-- Grid -->
<div class="grid grid-cols-1 bg-white">

<!-- Link -->
  <div class="flex justify-end p-4">
<form enctype="multipart/form-data"  method="POST" action="{{ route('reconcilation.store') }}">
  @csrf
<div class="flex flex-row items-center justify-center">
    <x-input id="month" class="block w-full py-1 rounded-none" type="month" name="to_month"  required  />

  <x-input id="type" type="file" name="file" class="block w-full rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
   focus:ring-opacity-50 py-1 mx-1" required autofocus />
<button type="submit" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
  focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
  Go
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
                      </th>
                      <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                        CREDIT
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
                </table>

          </div>
        </div>
      </div>
    </div>
   </div>

</div>
</x-app-layout>
