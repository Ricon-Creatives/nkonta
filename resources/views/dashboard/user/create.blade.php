<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1">

      <!--Heading-->
   <x-slot name="header">
    </x-slot>
    <!--Form-->
    <div class="flex flex-col sm:px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="w-full sm:max-w-3xl mx-auto lg:px-8 bg-white shadow-sm">
            <div class="overflow-hidden">
              <h1 class="text-base text-center p-3 font-bold text-gray-800">
                  Add User
              </h1>
              <div class="mx-auto px-4 py-9">
              <form method="POST" class="w-full" action="{{ route('employee.store') }}">
                @csrf

                <div class="flex flex-wrap -mx-2 mb-6">
                    <!-- Name -->
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label for="Name" :value="__('Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="name" class="mt-1 w-full" type="text" name="name" required autofocus />
                    </div>
                    <!-- Email Address -->
                    <div class="w-full md:w-1/2 px-3">
                      <x-label for="email" :value="__('Email')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="email" class="mt-1 w-full" type="email" name="email" required autofocus />
                  </div>
                </div>

                <!--Company Name -->
                <div class="flex flex-wrap -mx-2 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label for="phone" :value="__('Phone')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="phone" class="mt-1 w-full" type="text" name="phone" required autofocus />
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <x-label for="phone" :value="__('Role')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                        <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                        bg-white bg-no-repeat transition ease-in-out m-0
                        focus:text-gray-600 focus:bg-white focus:outline-none" name="role" required>
                          <option selected>Select Role</option>
                          @foreach($roles as $role)
                          @if ( $role->name != 'Administrator')
                          <option value="{{$role->name}}"> {{$role->name}} </option>
                          @endif
                          @endforeach
                      </select>
                  </div>
                </div>

                <div class="flex items-center justify-center mt-5 px-4">
                    <x-button class="">
                        {{ __('Create') }}
                    </x-button>
                </div>

              </form>
            </div>
         </div>
          </div>
        </div>
    </div>

    </div>
</x-app-layout>
