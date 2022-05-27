@extends('admin.layouts.index')
@section('main')
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('role.store')}}" enctype="form/html" method="POST">
    @csrf

    <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Name
                </span>
                <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              name="role_name"
            />
              </label>

        </div>
    </div>

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
