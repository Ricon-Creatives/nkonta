@extends('dashboard.profile.index')

@section('content')
<div class="tab-pane fade show active" id="tabs-homeVertical" role="tabpanel">
    <h6 class="text-base text-right p-2 mr-3 font-bold text-gray-800 border-b">
        Edit Your Profile
    </h6>
    <div class="mx-auto px-4 py-7">
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('account.update',Auth::user()->id) }}" method="POST">
            @csrf
            <!--Row one-->
            <div class="flex flex-wrap -mx-2 mb-6">
                    <!--Name.-->
                <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
                    <x-label for="" :value="__('Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                    <x-input id="name" class="mt-1 w-full" type="text" name="name"  value="{{ Auth::user()->name }}" required autofocus />
                </div>
                <!--Username-->
                <div class="w-full md:w-1/2 px-1">
                    <x-label for="" :value="__('Username')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                    <x-input id="username" class="mt-1 w-full" type="text" name="username" value="{{ Auth::user()->username }}" required autofocus />
                </div>
            </div>
            <!--Row one-->
            <div class="flex flex-wrap -mx-2 mb-6">
                <!--Email-->
              <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
                <x-label for="Empolyee TIN" :value="__('Email')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                <x-input id="email" class="mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required autofocus />
              </div>
              <!--Phone-->
              <div class="w-full md:w-1/2 px-1">
                <x-label for="" :value="__('Phone')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                <x-input id="phone" class="mt-1 w-full" type="tel" name="phone" pattern="[0-3]{3}[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="eg. 233501234567"
                value="{{ Auth::user()->phone }}" required autofocus />
            </div>
            </div>
            <!--Row one-->
            <div class="flex flex-wrap -mx-2 mb-6">
                <!--Tin-->
              <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
                <x-label for="" :value="__('Tin Number')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                <x-input id="tin_no" class="mt-1 w-full" type="text" name="tin_no" value="{{ Auth::user()->tin_no }}"  autofocus />
              </div>
            </div>
            <!--Row two-->
            <div class="flex flex-wrap -mx-2 mb-6">
              <!--Company-->
              <div class="w-full md:w-1/2 px-1">
                <x-label for="" :value="__('Company Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                <x-input id="company_name" class="mt-1 w-full" type="text" name="company_name"
                value="{{ Auth::user()->company_name}}" required autofocus />
            </div>
            </div>

            <!--Button-->
            <div class="left-0 right-0 mt-4">
                <div class="max-w-5xl mx-auto p-3">
                    <div class="flex">
                            <button type="submit" name="next" value="Next"
                                class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
                                focus:shadow-lg focus:outline-none focus:ring-0">
                            Update
                        </button>
                        </div>
                    </div>
                </div>

          </form>
        </div>
</div>
@endsection
