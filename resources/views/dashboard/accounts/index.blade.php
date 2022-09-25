<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1 bg-white">
     <!-- Grid -->
     <div class="grid grid-cols-1">
        <!-- Link -->
        @if(Auth::user()->isTeamOwner() || Auth::user()->hasRole('Manager'))
        <div class="flex justify-between p-4">
            <a  href="{{ route('company-accounts.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
            focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
            Add Account
            </a>
        </div>
        @else
        <h1 class="text-base text-left p-4 font-bold text-gray-800">
        Accounts
      </h1>
        @endif

  </div>
   <!--Table-->
   <div class="flex flex-col justify-center px-4">

    <div class="overflow-x-auto sm:-mx-4 lg:-mx-6">
      <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-4 lg:px-6">
        <div class="overflow-hidden">
          <table class="w-full">
            <thead class="bg-white border-b border-gray-300">
              <tr>
                  <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                      Code
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                        Name
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Type
                    </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Financial Statement
                  </th>
                  <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Action
                  </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                <tr class="bg-white border-b">
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $account->code }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{$account->name }}
                    </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{$account->type }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{$account->financial_statement }}
                </td>
                <td class="flex flex-row px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    <form method="get" action="{{route('company-accounts.edit',$account->id)}}">
                        @csrf
                    <button>
                        <i class="fa-solid fa-edit text-purple-900"></i>
                    </button>
                    </form>

                </td>
                </tr>
                @endforeach
            </tbody>
            {{ $accounts->links() }}
          </table>
        </div>
      </div>
    </div>
  </div>
    </div>

</x-app-layout>
