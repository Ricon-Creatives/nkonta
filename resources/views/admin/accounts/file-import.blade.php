@extends('admin.layouts.index')
@section('main')
<h4
class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
>
Import
</h4>
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('file-import') }}" enctype="multipart/form-data"  method="POST">
    @csrf

    <div
    class="px-4 py-3 mb-8 dark:bg-gray-800">

    <label class="block mt-4 text-sm">
      <div
        class="relative text-gray-500 focus-within:text-purple-600"
      >
        <input
          class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
          type="file" name="file"
        />
        <button
          class="absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
         Browse
        </button>
      </div>
    </label>
  </div>

      <div class="mt-4 p-4">
    <button type="submit"
    class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg
    active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
    Import
    </button>

      </div>

    </form>
</div>
@endsection
