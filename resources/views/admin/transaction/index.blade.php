@extends('admin.layouts.index')
@section('main')

 <!-- With actions -->
 <div class="flex items-center mb-4 mt-4">
<!--<a href=""
class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg
active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
Add Account
</a>-->
   <!--
<div class="mx-2">

<a href="{{ route('file-export') }}"
class="px-4 py-2 font-medium leading-5 text-sm transition-colors duration-150 text-purple-600 border border-transparent rounded-lg
active:text-gray-700 hover:text-gray-700 focus:outline-none focus:shadow-outline-purple">
Export
</a>
<a href="{{ route('file-import-export') }}"
class="px-4 py-2 font-medium leading-5 text-sm transition-colors duration-150 text-purple-600 border border-transparent rounded-lg
active:text-gray-700 hover:text-gray-700 focus:outline-none focus:shadow-outline-purple">
Import</a>
</div>
-->
</div>

<div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap">
     <thead>
       <tr
         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
       >
       <th class="px-4 py-3">Date</th>
         <th class="px-4 py-3">Code</th>
         <th class="px-4 py-3">Account</th>
         <th class="px-4 py-3">Ref_no</th>
         <th class="px-4 py-3">Description</th>
         <th class="px-4 py-3">Debit</th>
         <th class="px-4 py-3">Credit</th>
         <th class="px-4 py-3">BY</th>
       </tr>
     </thead>
     <tbody
       class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
     >
     @foreach ($transactions as $transaction)
     <tr class="text-gray-700 dark:text-gray-400">
       <td class="px-4 py-3">
        {{ \Carbon\Carbon::parse($transaction->date)->format('D d-M-Y') }}
       </td>
       <td class="px-4 py-3 text-sm">
        {{$transaction->account->code }}
       </td>
       <td class="px-4 py-3 text-xs">
        {{ $transaction->account->name}}
       </td>
       <td class="px-4 py-3 text-sm">
        {{ $transaction->reference_no }}
       </td>
       <td class="px-4 py-3 text-sm">
        {{($transaction->type == 'debit') ? $transaction->description_to_debit : $transaction->description_to_credit}}
       </td>
       <td class="px-4 py-3 text-sm">
        {{ ($transaction->type == 'debit') ? number_format($transaction->amount,2) : "" }}
    </td>
    <td class="px-4 py-3 text-sm">
        {{ ($transaction->type == 'credit') ? number_format($transaction->amount,2) : "" }}
    </td>
    <td class="px-4 py-3 text-sm">
        {{ $transaction->team->name }}
    </td>
       <td class="px-4 py-3">
         <div class="flex items-center space-x-4 text-sm">
            <form method="get" action="{{route('transaction.edit',$transaction->id)}}">
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
           {{ $transactions->links() }}
     </nav>
   </span>
 </div>
 </div>
</div>
@endsection
