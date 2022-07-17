<x-app-layout>
    <!--Heading-->
 <x-slot name="header">
  </x-slot>
    <!-- Grid -->
    <div class="bg-white p-2 h-screen">
    <!--Form-->
    <div class="flex flex-col justify-center">
          <div class="w-full">
              <h1 class="text-base text-left p-3 font-bold text-gray-800">
                  Edit Employee
              </h1>
              <div class="mx-auto px-4 py-9">
              <form method="POST" class="w-9/12" action="{{ route('employee.update',$employee->id) }}">
                @method('PATCH')
                @csrf

                <div class="flex flex-wrap -mx-2 mb-6">
                    <!-- Name -->
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label for="Name" :value="__('Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="name" class="mt-1 w-full" type="text" value="{{ $employee->name }}" name="name" required autofocus disabled/>
                    </div>
                    <!-- Email Address -->
                    <div class="w-full md:w-1/2 px-3">
                      <x-label for="email" :value="__('Email')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="email" class="mt-1 w-full" type="email" name="email" value="{{ $employee->email }}" required autofocus disabled/>
                  </div>
                </div>

                <!--Company Name -->
                <div class="flex flex-wrap -mx-2 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label for="phone" :value="__('Phone')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="phone" class="mt-1 w-full" type="text" name="phone" value="{{ $employee->phone }}" required autofocus disabled/>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <x-label for="phone" :value="__('Change Role')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                        <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                        bg-white bg-no-repeat transition ease-in-out m-0 mt-1
                        focus:text-gray-600 focus:bg-white focus:outline-none" name="role" required>
                          <option selected>Select Role</option>
                          @foreach($roles as $role)
                          @if ( $role->name != 'Administrator')
                          <option value="{{$role->name}}" {{ $employee->hasRole($role->name) == $role->name ? 'selected':'' }}> {{$role->name}} </option>
                          @endif
                          @endforeach
                      </select>
                  </div>
                </div>

                <div class="flex items-center justify-between mt-5 px-4">
                    <x-button class="">
                        {{ __('Change') }}
                    </x-button>

                    <x-button class="" type="button" data-bs-toggle="modal" data-bs-target="#addModal">
                        {{ __('Remove Employee') }}
                    </x-button>
                </div>

              </form>
            </div>
         </div>
    </div>

    <!--Model-->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

            <div class="modal-body relative p-4">
                <div class="text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <span class="font-medium bg-yellow-100 text-center rounded-full p-2">
                            <i class="fa-solid fa-warning text-yellow-500 text-xl"></i>
                    </span>
                    <div class="mt-2">
                      <p class="text-base text-gray-700">Are you sure you want to remove {{ $employee->name }} from your account?
                    </p>
                    </div>
                  </div>
            </div>
            <div class="flex items-center justify-between border-t py-2 px-4">
                <x-button class="" data-bs-dismiss="modal" aria-label="Close">
                    {{ __('Cancel') }}
                </x-button>
                <form method="post" action="{{route('employee.destroy',$employee->id)}}">
                    @method('DELETE')
                    @csrf
                <x-button class="bg-red-500 hover:bg-red-300">
                    {{ __('Yes') }}
                </x-button>
                </form>
            </div>
          </div>
        </div>
      </div>

    </div>
</x-app-layout>
