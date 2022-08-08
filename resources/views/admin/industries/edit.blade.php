@extends('admin.layouts.index')
@section('main')
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('industry.update',$industry->id) }}" enctype="form/html" method="POST">
    @method('PUT')
    @csrf
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input type="text"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Name" name="name" value="{{ $industry->name }}"
        />
      </label>

      <label class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Code</span>
        <input type="number"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Code" name="code"  value="{{ $industry->code }}"
        />
      </label>

      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
         Financial Statement
        </span>
        <select
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
         name="accounts[]" multiple>
         @foreach($accounts as $account)

         <option value="{{$account->id }}">
          {{ $account->name }}
         </option>
         @endforeach
        </select>
      </label>

      <div class="mt-4 p-4">
    <button type="submit"
    class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded
    active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
   Finish
    </button>

      </div>
    </form>

</div>

<!---->
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<h3 class="my-4 text-base font-semibold text-gray-700 dark:text-gray-200">
Remove Accounts
</h3>
<div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">Code</th>
          <th class="px-4 py-3">Name</th>
          <th class="px-4 py-3">Type</th>
          <th class="px-4 py-3">Financial Statement</th>
          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
      @foreach ($industry->accounts as $account)
      <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">
          {{ $account->code }}
        </td>
        <td class="px-4 py-3 text-sm">
         {{$account->name}}
        </td>
        <td class="px-4 py-3 text-xs">
         {{ $account->type }}
        </td>
        <td class="px-4 py-3 text-sm">
           {{ $account->financial_statement }}
        </td>
        <td class="px-4 py-3">
          <div class="flex items-center space-x-4 text-sm">
            <form method="post" action="{{route('account.remove',$account->id)}}">
             @method('post')
             @csrf
             <input type="hidden" value="{{ $industry->id }}" name="industryId"/>
            <button
              class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
              aria-label="Delete"
            >
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"
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
</div>
</div>
@endsection
