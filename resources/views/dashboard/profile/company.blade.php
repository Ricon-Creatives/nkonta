@extends('dashboard.profile.index')

@section('content')

<div class="tab-pane fade show active" id="tabs-profileVertical" role="tabpanel">
    <h6 class="text-base text-right p-2 mr-3 font-bold text-gray-800 border-b">
        Change Your Password
    </h6>
    <div class="mx-auto px-4 py-7">
         <!-- Validation Errors -->
         <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{{ route('my-business.update', Auth::user()->currentTeam->name) }}" method="POST">
            @method('PATCH')
            @csrf
            <!--Row one-->
            <div class="flex flex-wrap -mx-2 my-6">
                    <!--My Business Nmae'.-->
                <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
                    <x-label for="" :value="__('Company Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                    <x-input id="" class="mt-1 w-full" type="text" name="name" value="{{  Auth::user()->currentTeam->name }}" required autofocus />
                </div>

            </div>

            <!--Button-->
            <div class="left-0 right-0 mt-5">
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
