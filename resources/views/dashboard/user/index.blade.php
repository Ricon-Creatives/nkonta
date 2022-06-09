<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  bg-white">

      <!--Heading-->
   <x-slot name="header">
    </x-slot>

     <!-- Grid -->
     <div class="grid grid-cols-1">
        <!-- Link -->
        <div class="flex justify-between p-4">
            <a  href="{{ route('employee.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
            focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
            Add User
            </a>

        </div>

  </div>
   <!--Table-->
   <div class="flex flex-col px-4">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <thead class="bg-white border-b border-gray-300">
              <tr>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                NAME
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
                <tr class="bg-white border-b">
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                      {{ auth()->user()->firm }}
                  </td>
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">

                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                </td>
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                  </td>
                  <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                  </td>

                  <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
                </td>
                <td class="text-sm text-gray-900 px-4 py-2 whitespace-nowrap">
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
