
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
              @foreach($unmatched as $transaction)

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
