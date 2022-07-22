<x-app-layout>
    <div class="bg-white p-2 h-screen">
        <!--Form-->
        <div class="flex justify-center">
            <div class="w-full p-4">
         <form method="post" action="{{ route('transaction.update',$transaction->id) }}" >
            @method('PUT')
            @csrf
            <h4
            class="mb-4 text-lg font-semibold text-gray-900">
           Edit Transaction
          </h4>

           <!--Row one-->
        <div class="flex flex-wrap -mx-2 mb-6">
            <!--Staff No.-->
        <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
            <x-label for="Staff No." :value="__('Account *')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
            <select name="account" class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0 sm:w-10/12 w-full
            focus:text-gray-600 focus:bg-white focus:outline-none" required>
          @foreach($accounts as $account)
          <option value="{{$account->id }}" {{$transaction->account_id == $account->id ? 'selected= selected' : '' }}>
          {{ $account->name }}</option>
               @endforeach
          </select>
        </div>
        <!--Name of Employee-->
        <div class="w-full md:w-1/2 px-1">
            <x-label for="Name of Employee" :value="__('Category *')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
            <select name="category" class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0 sm:w-10/12 w-full
            focus:text-gray-600 focus:bg-white focus:outline-none" required>
            @foreach($accounts as $account)
            <option value="{{$account->id }}" {{$transaction->category_id == $account->id ? 'selected= selected' : '' }}>
            {{ $account->name }}</option>
                 @endforeach
            </select>
        </div>
       </div>
        <!--Row two-->
        <div class="flex flex-wrap -mx-2 mb-6">
            <!--Staff No.-->
        <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
            <x-label for="Staff No." :value="__('Narration To Debit')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
            <textarea name="description_to_debit" class="orm-control block sm:w-10/12 w-full mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
            rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3"
                >{{ $transaction->description_to_debit }}</textarea>
        </div>
        <!--Name of Employee-->
        <div class="w-full md:w-1/2 px-1">
            <x-label for="Name of Employee" :value="__('Narration To Credit')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
            <textarea name="description_to_credit" class="orm-control block sm:w-10/12 w-full mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
            rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3"
                >{{ $transaction->description_to_credit }}</textarea>
        </div>
       </div>
       <!--Row three-->
       <div class="flex flex-wrap -mx-2 mb-6">
        <!--Amount.-->
    <div class="w-full md:w-1/2  px-1 mb-6 md:mb-0">
        <x-label for="Staff No." :value="__('Amount *')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
        <x-input id="staff" class="mt-1 sm:w-10/12 w-full" type="number" step="any" name="amount" value="{{ $transaction->amount }}" required autofocus />
    </div>
   </div>

        <div class="flex items-center justify-start mt-5">
            <x-button class="">
                {{ __('Finish') }}
            </x-button>

        </div>
         </form>
        </div>
        </div>
    </div>
</x-app-layout>
