<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex items-center justify-between">
                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!--Username -->
            <div>
                <x-label for="" :value="__('Industry')" />
                <select class="form-select appearance-none block text-base font-normal text-gray-600
                    bg-white bg-no-repeat transition ease-in-out mt-1 w-full
                    focus:text-gray-600 focus:bg-white focus:outline-none" name="industry" required>
                      <option disabled>Choose your industry</option>
                       @foreach($industries as $industry)
                       <option value="{{$industry->id }}"}>
                        {{ $industry->name }}
                       </option>
                      @endforeach
                </select></div>

            </div>

            <!--Company Name -->
            <div class="mt-2">
                <x-label for="company_name" :value="__('Company Name')" />

                <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus />
            </div>

            <div class="flex items-center justify-between">
                <!--Phone -->
            <div class="mt-2">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')"
                pattern="[0-1]{1}[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="eg. 0201234567" required autofocus />
            </div>

            <!--TIN -->
            <div class="mt-2">
                <x-label for="tin" :value="__('Tin No.')" />

                <x-input id="tin" class="block mt-1 w-full" type="text" name="tin_no" :value="old('tin')" required autofocus />
            </div>

            </div>

            <!-- Email Address -->
            <div class="mt-2">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="flex items-center justify-between">
            <!-- Password -->
            <div class="mt-2">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-2">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            </div>

            <div class="flex items-center justify-between mt-3 px-4">
                <a class="underline text-sm font-bold text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
