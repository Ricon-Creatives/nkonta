@extends('dashboard.employee.index')

@section('content')

<div class="tab-pane fade show active" id="tabs-homeVertical" role="tabpanel">
   <!--Table-->
   <div class="flex flex-col px-4">
    <div class="overflow-x-auto sm:-mx-4 lg:-mx-6">
      <div class="py-2 inline-block max-w-sm sm:px-4 lg:px-6">
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
                    Role
                  </th>
                <th scope="col" class="text-sm font-bold text-gray-900 px-4 py-2 text-left">
                  Last Login
                </th>
              </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b">
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                  </td>
                  <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                </td>
                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                </td>
                </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
