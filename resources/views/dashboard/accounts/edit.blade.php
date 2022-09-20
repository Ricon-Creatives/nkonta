<x-app-layout>

    <!-- Grid -->
    <div class="bg-white p-2 h-screen">
    <!--Form-->
    <div class="flex justify-center">
          <div class="w-full">
              <h1 class="text-base text-left p-3 font-bold text-gray-800">
                  Edit Account
              </h1>
              <div class="mx-auto px-4 py-9">
              <form method="POST" class="w-9/12" action="{{ route('company-accounts.update',$account->id) }}">
                @method('PATCH')
                @csrf

                <div class="flex flex-wrap -mx-2 mb-6">
                    <!-- Name -->
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label for="Name" :value="__('Account Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="name" class="mt-1 w-full" type="text" value="{{ $account->name }}" name="name" required autofocus />
                    </div>
                    <!-- Email Address -->
                    <div class="w-full md:w-1/2 px-3">
                      <x-label for="email" :value="__('Code')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <x-input id="email" class="mt-1 w-full" type="email" name="code" value="{{ $account->code }}" required autofocus disabled/>
                  </div>
                </div>

                <!--Company Name -->
                <div class="flex flex-wrap -mx-2 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <x-label :value="__('Type')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                      <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                      bg-white bg-no-repeat transition ease-in-out m-0 w-full
                      focus:text-gray-600 focus:bg-white focus:outline-none" name="type" id="type" required>
                        <option value="Asset" {{ $account->type == 'Asset' ? 'selected' :'' }}>Asset</option>
                        <option value="Liability" {{ $account->type == 'Liability' ? 'selected' :'' }}>Liability</option>
                        <option value="Equity" {{ $account->type == 'Equity' ? 'selected' :'' }}>Equity</option>
                        <option value="Revenue" {{ $account->type == 'Revenue' ? 'selected' :'' }}>Revenue</option>
                        <option value="Expense" {{ $account->type == 'Expense' ? 'selected' :'' }}>Expense</option>
                    </select>
                </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label for="phone" :value="__('Financial Statement')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                        <x-input id="phone" class="mt-1 w-full" type="text" name="financial_statement" value="{{ $account->financial_statement }}" required autofocus />
                      </div>
                </div>

                <div class="flex items-center justify-between mt-5 px-4">
                    <x-button class="">
                        {{ __('Finish') }}
                    </x-button>
                </div>

              </form>
            </div>
         </div>
    </div>

    </div>
</x-app-layout>
