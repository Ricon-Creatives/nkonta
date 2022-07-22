@extends('admin.layouts.index')
@section('main')
<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('transaction.update',$transaction->id) }}" enctype="form/html" method="POST">
    @method('PUT')
    @csrf

    <h4
    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
  >
   Reference No: {{ $transaction->reference_no }}
  </h4>

  <div class="flex flex-wrap mb-5">
    <h5 class="text-md font-semibold text-gray-600 dark:text-gray-300">
            Date Created: {{\Carbon\Carbon::parse($transaction->created_at)->format('D d-M-Y')}}
        </h5>
</div>

    <div class="flex flex-wrap mb-5">
    <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
              Account
            </span>
            <select name="account"
              class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            required>
            @foreach($accounts as $account)
            <option value="{{$account->id }}" {{$transaction->account_id == $account->id ? 'selected= selected' : '' }}>
            {{ $account->name }}</option>
                 @endforeach
            </select>
          </label>

    </div>
    <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
              Category
            </span>
            <select name="category"
              class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
             required>
            @foreach($accounts as $account)
            <option value="{{$account->id }}" {{$transaction->category_id == $account->id ? 'selected= selected' : '' }}>
            {{ $account->name }}</option>
                 @endforeach
            </select>
          </label>

    </div>
    </div>
    <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Narration To Debit</span>
                <textarea name="description_to_debit"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                >{{ $transaction->description_to_debit }}</textarea>
              </label>
        </div>
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Narration To Credit</span>
                <textarea name="description_to_credit"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                >{{ $transaction->description_to_credit }}</textarea>
              </label>
        </div>
    </div>
    <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Amount</span>
            <input type="number" step="any"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              name="amount" value="{{ $transaction->amount }}"
            />
          </label>
        </div>
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Company Name</span>
            <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               name="company_name" value="{{ $transaction->company_name }}"
            />
          </label>
        </div>
     </div>

     <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Contact Address</span>
            <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               name="contact_address" value="{{ $transaction->contact_address }}"
            />
          </label>
        </div>

        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Expcted Payment Date</span>
                <input type="date"
                  class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="expected_payment_date" value="{{ $transaction->expected_payment_date }}"
                />
              </label>
            </div>
     </div>

     <div class="mt-4 p-4">
        <button type="submit"
        class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg
        active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Update
        </button>

    </div>
</form>
</div>
@endsection
