<x-app-layout>

    <!-- Grid -->
    <div class="bg-white p-2 h-screen">
    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3">
    <!--Form-->
    <div class="flex justify-center col-span-2">
          <div class="w-full">
              <h1 class="text-base text-left p-3 font-bold text-gray-800">
                  Edit Account
              </h1>
              <div class="flex justify-center mx-auto px-4 py-9 md:border-r">
              <form method="POST" class="w-full" action="{{ route('company-accounts.update',$account->id) }}">
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
                                <x-label :value="__('Financial Statement')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                                bg-white bg-no-repeat transition ease-in-out m-0 w-full
                                focus:text-gray-600 focus:bg-white focus:outline-none" name="financial_statement" required>
                                  <option value="Asset" {{ $account->financial_statement == 'Balance Sheet' ? 'selected' :'' }}>Balance Sheet</option>
                                  <option value="Liability" {{ $account->financial_statement == 'Income Statement' ? 'selected' :'' }}>Income Statement</option>
                              </select>
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

        <div class="w-full flex content-center">
            <div class="flex flex-col justify-center mx-auto px-4 py-9">
            <h3 class="text-base text-gray-600 m-0">Deleting this account may affect transactions</h3>
            <div class="flex flex-row items-center m-0">
            <p class="text-base text-left p-3 m-0 font-bold text-red-600">
                Delete Account
            </p>
            <span class="mx-1">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deletePopup">
                        <i class="fa-solid fa-trash text-red-600"></i>
                    </button>
            </span>
        </div>
                </div>
            </div>
    </div>
        <!--Modal-->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="deletePopup" tabindex="-1" aria-labelledby="deletePopup" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered relative w-auto">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-body relative p-4">
                    <div class="text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <span class="font-medium bg-yellow-100 text-center rounded-full p-2">
                                <i class="fa-solid fa-warning text-yellow-500 text-xl"></i>
                        </span>
                        <div class="mt-2">
                        <p class="text-base text-gray-700">Are you sure you want to delete this account?
                        </p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between border-t py-2 px-4">
                    <x-button class="" data-bs-dismiss="modal" aria-label="Close">
                        {{ __('Cancel') }}
                    </x-button>
                    <form method="post" action="{{ route('company-accounts.destroy',$account->id) }}">
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
