    <!--Form-->
    <form method="POST" action="{{ route('add.transaction') }}">
        @csrf

        <div class=" flex-row items-center justify-center mt-2">
           <x-input id="type" class="block mt-1 w-full" type="text" name="search"
            placeholder="Search..." autofocus />
       </div>

       <div class="flex items-center justify-center w-full mt-3">
            <x-input id="from" class="w-full py-1 rounded-r-none" type="date" name="from_date"
            :value="old('from_date')" />
            <div class="p-2">To</div>
            <x-input id="to" class="w-full py-1 rounded-none" type="date" name="to_date"
            :value="old('to_date')" />

    </div>

    <div
            class="flex flex-shrink-0 flex-wrap items-center p-2 border-0 mt-3 rounded-b-md">
    <x-button class="px-2 py-2 rounded">
        Search
    </x-button>
    </div>
    </form>
