@extends('admin.tools.roles.index')
@section('content')

<div x-show="activeTab === 1">
    <table class="w-full whitespace-no-wrap">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
          <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Users</th>
            <th class="px-4 py-3">Permission</th>
            <th class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
        >
        @foreach ($roles as $role)

        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">
              {{ $role->name }}
          </td>
          <td class="px-4 py-3 text-sm">

          </td>
          <td class="px-4 py-3 text-sm">

          </td>

          <td class="px-4 py-3">
            <div class="flex items-center space-x-4 text-sm">
               <form method="get" action="">
                   @csrf
              <button
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Edit"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                  ></path>
                </svg>
              </button>
               </form>

            </div>
          </td>
        </tr>
        @endforeach

       </tbody>
   </table>
      <div
      class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t
      dark:border-gray-700 bg-white sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800" >
      <!-- Pagination -->
      <span class="col-span-2"></span>
      <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
          <nav aria-label="Table navigation">
        </nav>
      </span>
    </div>
 </div>

@endsection
