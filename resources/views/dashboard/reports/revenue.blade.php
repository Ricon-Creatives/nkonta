
       <!--Heading-->
       <x-slot name="header">
        <div class="bg-white p-4 mb-3">
           revenus
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
                        REF_NO
                    </th>
                        <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                            DESC
                        </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-4 text-left">
                        AMOUNT
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
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            $debit->reference_no
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        $debit->description
                    </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            number_format($debit->amount,2)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        $debit->account->name
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        $credit->account->name
                    </td>

                    </tr>
                </tbody>
            </table>

        </div>
    </div>
  </div>
</div>
