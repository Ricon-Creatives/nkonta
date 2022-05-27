@extends('admin.layouts.index')
@section('main')
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('account.create') }}" enctype="form/html" method="POST">
    @csrf
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input type="text"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Name" name="name"
        />
      </label>

      <label class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Code</span>
        <input type="number"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Code" name="code"
        />
      </label>

      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
          Type
        </span>
        <select
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
         name="type">
          <option value="Asset">Asset</option>
          <option value="Liability">Liability</option>
          <option value="Equity">Equity</option>
        </select>
      </label>

      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
         Financial Statement
        </span>
        <select
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
         name="financial_statement">
          <option>Asset</option>
          <option>Liability</option>
          <option>Equity</option>
        </select>
      </label>

      <div class="mt-4 p-4">
    <button type="submit"
    class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg
    active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
    Save
    </button>

      </div>

    </form>
</div>
@endsection
