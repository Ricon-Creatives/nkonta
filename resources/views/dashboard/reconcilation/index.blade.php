<x-app-layout>

    <!--Heading-->
 <x-slot name="header">
  </x-slot>
<!-- Grid -->
<div class="grid grid-cols-1 bg-white p-2">
<!-- Link -->
  <div class="flex justify-end p-4">
<form enctype="multipart/form-data"  method="POST" action="{{ route('reconcilation.store') }}">
  @csrf
<div class="flex flex-row items-center justify-center">
    <x-input id="month" class="block w-full py-1 rounded-none" type="date" name="to_month" placeholder="e.g june 2022"  required  />

  <x-input id="type" type="file" name="file" class="block w-full rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
   focus:ring-opacity-50 focus:outline-none py-1 mx-1" required autofocus />
<button type="submit" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
  focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
  Go
  </button>
</div>
</form>
  </div>


  <!--Form-->
  <div class="flex flex-col px-4">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
          <!----->
        <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-0 mb-4 justify-center" id="tabs-tab"
        role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#tabs-matched" class="nav-link block font-medium text-xs focus:outline-none
                uppercase px-6 py-3 my-2 hover:bg-gray-100 active
                " id="tabs-matched-tab" data-bs-toggle="pill" data-bs-target="#tabs-matched" role="tab" aria-controls="tabs-matched"
                aria-selected="true">Matched</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tabs-unmatched" class="nav-link block font-medium text-xs focus:outline-none uppercase
                px-6 py-3 my-2 hover:bg-gray-100" id="tabs-unmatched-tab" data-bs-toggle="pill" data-bs-target="#tabs-unmatched" role="tab"
                aria-controls="tabs-unmatched" aria-selected="false">Unmatched</a>
            </li>
        </ul>
        <!--Content--->
        <div class="tab-content" id="tabs-tabContent">
            <div class="tab-pane fade show active" id="tabs-matched" role="tabpanel" aria-labelledby="tabs-matched-tab">
             @include('dashboard.reconcilation.matched')
            </div>
            <div class="tab-pane fade" id="tabs-unmatched" role="tabpanel" aria-labelledby="tabs-unmatched-tab">
                @include('dashboard.reconcilation.unmatched')
            </div>
        </div>
      </div>
    </div>
   </div>

</div>
</x-app-layout>
