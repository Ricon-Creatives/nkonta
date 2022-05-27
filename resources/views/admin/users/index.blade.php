@extends('admin.layouts.index')
@section('main')

 <!-- With actions -->
 <div class="flex items-center sm:justify-between mb-4 mt-4">
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
         <th class="px-4 py-3">Username</th>
         <th class="px-4 py-3">Name</th>
         <th class="px-4 py-3">Email</th>
         <th class="px-4 py-3">Company Name</th>
         <th class="px-4 py-3">Role</th>
         <th class="px-4 py-3">Status</th>
         <th class="px-4 py-3">Last Login</th>
         <th class="px-2 py-3">Actions</th>
       </tr>
     </thead>
     <tbody
       class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
     >
     @foreach ($users as $user)
     <tr class="text-gray-700 dark:text-gray-400">
       <td class="px-4 py-3">
         {{ $user->username }}
       </td>
       <td class="px-4 py-3 text-sm">
        {{$user->name}}
       </td>
       <td class="px-4 py-3 text-xs">
        {{ $user->email }}
       </td>
       <td class="px-4 py-3 text-sm">
          {{ $user->company_name }}
       </td>
     <td class="px-2 py-3 text-sm">
         @foreach ( $user->roles as $role)
         {{$role->name }}
         @endforeach
     </td>
     <td class="px-4 py-3 text-sm">
         <span class="{{  ($user->locked) ? 'px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full
          dark:text-white dark:bg-orange-600' : ''  }}">
        {{ $user->locked }}
         </span>
     </td>
     <td class="px-4 py-3 text-sm">
        {{$user->last_login_at }}
     </td>
       <td class="px-4 py-3">
         <div class="flex items-center space-x-4 text-sm">
            <form method="get" action="{{route('user.edit',$user->id)}}">
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
   <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
       <nav aria-label="Table navigation">
           {{ $users->links() }}
     </nav>
   </span>
 </div>
 </div>
</div>
@endsection
