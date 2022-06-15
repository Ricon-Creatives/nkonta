@extends('admin.layouts.index')
@section('main')

 <!-- With actions -->
 <div class="flex items-center mb-4 mt-4">
 </div>


<div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
          <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Type</th>
            <th class="px-4 py-3">Contact No.</th>
            <th class="px-4 py-3">Due Date(in days)</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">BY</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
        >
        @foreach ($trades as $trade)
        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">
           {{ $trade->name }}
          </td>
          <td class="px-4 py-3 text-sm">
           {{ $trade->type }}
          </td>
          <td class="px-4 py-3 text-xs">
           {{  $trade->contact_no}}
          </td>
          <td class="px-4 py-3 text-sm">
           {{$trade->due_date}}
          </td>
          <td class="px-4 py-3 text-sm">
            {{ \Carbon\Carbon::parse($trade->created_at)->format('D d-M-Y') }}
       </td>
       <td class="px-4 py-3 text-sm">
           {{ $trade->user->name }}
       </td>
          <td class="px-4 py-3">
            <div class="flex items-center space-x-4 text-sm">
                <div x-data="{ show: false }"  @click.away="show = false" class="relative inline-block text-left mb-2">
                    <button @click="show = ! show" type="button" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                    <span class=""><i class="fa-solid fa-eye"></i></span>
                    </button>
           <div x-show="show" class="absolute bg-white z-50 shadow-md w-40">
               <form method="get" action="{{route('trade.show',$trade->id)}}">
                @csrf
           <button
             class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
             aria-label="Edit"
           > Invoice
           </button>
            </form>
            @if ($trade->type == 'Selling')
            <form method="get" action="{{route('show.estimate',$trade->id)}}">
                @csrf
           <button
             class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
             aria-label="Edit"
           > Estimate
           </button>
            </form>
            @endif
           </div>
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
              {{ $trades->links() }}
        </nav>
      </span>
    </div>
    </div>
   </div>
 @endsection
