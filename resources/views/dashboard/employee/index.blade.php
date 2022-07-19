<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1 bg-white">
     <!-- Grid -->
     <div class="grid grid-cols-1">
        <!-- Link -->
        @if(Auth::user()->isTeamOwner() || Auth::user()->hasRole('Manager'))
        <div class="flex justify-between p-4">
            <a  href="{{ route('employee.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
            focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
            Add Employee
            </a>

        </div>
        @else
        <h1 class="text-base text-left p-4 font-bold text-gray-800">
        Employees
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
                NAME
                </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Email
                  </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                  Phone
                </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Role
                  </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Last Login
                  </th>
                  <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                    Action
                  </th>
              </tr>
            </thead>
            <tbody>
                @forelse ( Auth::user()->currentTeam->users as $user)
                <tr class="bg-white border-b">
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                      {{$user->name }}
                  </td>
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $user->email }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{$user->phone }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    @foreach ($user->roles as $role)
                    {{$role->name }}
                    @endforeach</p>
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{$user->last_login_at }}
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                    @if(Auth::user()->isTeamOwner() || Auth::user()->hasRole('Manager'))
                    <a href="{{ route('employee.edit',$user->id) }}">
                        <i class="fa-solid fa-edit text-purple-900"></i>
                    </a>
                    @endif
                </td>
                </tr>
                @empty

                @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    </div>

</x-app-layout>
