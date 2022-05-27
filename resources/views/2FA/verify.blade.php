<x-guest-layout>
    @if(session()->has('message'))
    <div class="absolute right-0 p-1">
        <div class="flex items-center px-4 py-4 rounded  text-slate-800 bg-slate-300" role="alert">
            <p>{{ session()->get('message') }}</p>
        </div>
      </div>
    @endif

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('If you didn\'t receive the SMS code, we will gladly send you another.') }}
        </div>

        <div class="mt-4">
            <form method="POST" action="{{ route('verify.send') }}">
                @csrf
                 <!-- Email Address -->
            <div class="mb-4 flex items-center justify-center">

                <x-input id="token" class="block mt-1 w-full" type="text" name="token" placeholder="Enter Code"
                :value="old('token')" required autofocus />
            </div>

                <div class="flex justify-between mx-1">
                    <x-button>
                        {{ __('SEND') }}
                    </x-button>

                    <a href="{{ route('verify.resend') }}" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded-md shadow-sm hover:bg-purple-700 hover:shadow-lg
                    focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
                   {{ __('RESEND') }}
                     </a>
                </div>
            </form>


        </div>
    </x-auth-card>
</x-guest-layout>
