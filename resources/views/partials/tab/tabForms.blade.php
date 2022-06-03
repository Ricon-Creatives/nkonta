 <!--tabs-->
 <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-3 justify-center" id="tabs-tab"
 role="tablist">
 <li class="nav-item" role="presentation">
   <a href="#tabs-home" class="nav-link text-indigo-900 block font-medium text-xs  leading-tight
     uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2
     hover:border-transparent hover:bg-gray-100 focus:border-transparent active" id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home"
     aria-selected="true">Income</a>
 </li>
 <li class="nav-item" role="presentation">
   <a href="#tabs-profile" class="nav-link text-indigo-900 block font-medium text-xs leading-tight uppercase
     border-x-0 border-t-0 border-b-2 px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100
     focus:border-transparent" id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
     aria-controls="tabs-profile" aria-selected="false">Expense</a>
 </li>
</ul>
<div class="tab-content" id="tabs-tabContent">
 <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
     <!--Form-->
 <form method="POST" action="{{ route('add.transaction') }}">
     @csrf

     <div class=" flex-row items-center justify-center mt-2 hidden">
        <x-label for="type" :value="__('type')" class="w-3/12"/>

        <x-input id="type" class="block mt-1 w-9/12" type="type" name="type" :value="('income')" required autofocus />
    </div>

     <!-- Date -->
     <div class="flex flex-row items-center justify-center mt-2">
         <x-label for="date" :value="__('Date')" class="w-3/12"/>

         <x-input id="date" class="block mt-1 w-9/12" type="date" name="date" :value="old('date')" required autofocus />
     </div>
     <!-- Account to debit-->
     <div class="flex flex-row items-center justify-center mt-2">
         <x-label for="account" :value="__('Account To Debit')" class="w-3/12"/>

         <div class="flex w-9/12 mt-1">
            <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0
            focus:text-gray-600 focus:bg-white focus:outline-none" name="account" id="account" onchange="checkValue(this,'extraField')" required>
              <option selected>Select Account</option>
              @foreach($accounts as $account)
              @if ($account->type == 'Asset')
              <option value="{{$account->id}}">{{$account->name}}</option>
              @endif
              @endforeach
          </select>
          </div>
     </div>

      <!-- Description To Debit -->
      <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="description" :value="__('Narration To Debit')" class="w-3/12"/>

        <textarea name="description_to_debit"
     class="form-control block w-9/12  mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
       rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
     rows="2"
     placeholder="Your message"
   ></textarea>
    </div>

     <!-- Acount to credit-->
     <div class="flex flex-row items-center justify-center mt-2">
         <x-label for="category" :value="__('Acount To Credit')" class="w-3/12"/>

         <div class="flex w-9/12 mt-1">
            <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0
            focus:text-gray-600 focus:bg-white focus:outline-none" name="category" onchange="checkValue(this,'extraField')" required>
              <option selected>Select Acount</option>
               @foreach($accounts as $account)
              @if ($account->type != 'Asset' )
              <option value="{{$account->id}}">{{$account->name}}</option>
              @endif
              @endforeach
          </select>
          </div>

     </div>

      <!-- Narration To Credit -->
      <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="description" :value="__('Description To Credit')" class="w-3/12"/>

        <textarea name="description_to_credit"
     class="form-control block w-9/12  mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
       rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
     rows="2"
     placeholder="Your message"
   ></textarea>
    </div>

    <div id="extraField" class="hidden">

        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="type" :value="__('Company Name')" class="w-3/12"/>

            <x-input id="company_name" class="block mt-1 w-9/12" type="text" name="company_name" :value="old('company_name')" autofocus />
        </div>
        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="contact_address" :value="__('Contact Address')" class="w-3/12"/>

            <x-input id="contact_address" class="block mt-1 w-9/12" type="text" name="contact_address" :value="old('contact_address')" autofocus />
        </div>
        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="payment_date" :value="__('Expected Payment Date')" class="w-3/12"/>

            <x-input id="payment_date" class="block mt-1 w-9/12" type="text" name="payment_date" :value="old('payment_date')" autofocus />
        </div>
    </div>

     <!-- Amount -->
     <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="amount" :value="__('Amount')" class="w-3/12" />

        <x-input id="amount" class="block mt-1 w-9/12" type="number" name="amount" :value="old('amount')"  step="any" required autofocus />
    </div>

     <div
     class="flex flex-shrink-0 flex-wrap items-center justify-end p-2 border-0 mt-3 rounded-b-md">
     <button type="button"
       class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
       data-bs-dismiss="modal">
       Close
     </button>
     <button type="submit"
       class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
       Save
     </button>
   </div>
 </form>
 </div>
 <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
     <!--Expense Form-->
 <form method="POST" action="{{ route('add.transaction') }}">
    @csrf

    <div class=" flex-row items-center justify-center mt-2 hidden">
        <x-label for="type" :value="__('type')" class="w-3/12"/>

        <x-input id="type" class="block mt-1 w-9/12" type="type" name="type" :value="('expense')" required autofocus />
    </div>
    <!-- Date -->
    <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="date" :value="__('Date')" class="w-3/12"/>

        <x-input id="exp-date" class="block mt-1 w-9/12" type="date" name="date" :value="old('date')" required autofocus />
    </div>
    <!-- Account -->
    <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="account" :value="__('Account to credit')" class="w-3/12"/>

        <div class="flex w-9/12 mt-1">
            <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0
            focus:text-gray-600 focus:bg-white focus:outline-none" name="account" onchange="checkValue(this,'extraField-exp')" required>
              <option selected>Select Account</option>
              @foreach($accounts as $account)
              @if ($account->type == 'Asset')
              <option value="{{$account->id}}">{{$account->name}}</option>
              @endif
              @endforeach
          </select>
          </div>
            </div>

             <!-- Narration To Credit -->
      <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="description" :value="__('Narration To Credit')" class="w-3/12"/>

        <textarea name="description_to_credit"
     class="form-control block w-9/12  mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
       rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
     rows="2"
     placeholder="Your message"
     ></textarea>
    </div>

    <!-- Account To Debit -->
    <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="category" :value="__('Account to debit')" class="w-3/12"/>

        <div class="flex w-9/12 mt-1">
            <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
            bg-white bg-no-repeat transition ease-in-out m-0
            focus:text-gray-600 focus:bg-white focus:outline-none" name="category" onchange="checkValue(this,'extraField-exp')" required>
              <option selected>Select Category</option>
              @foreach($accounts as $account)
              @if ($account->type != 'Asset' && $account->type != 'Revenue')
              <option value="{{$account->id}}">{{$account->name}}</option>
              @endif
              @endforeach
          </select>
          </div>
     </div>

    <!-- Description -->
    <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="description" :value="__('Narration To Debit')" class="w-3/12"/>

        <textarea name="description_to_debit"
      class="form-control block w-9/12  mt-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-200
        rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
      rows="2"
      placeholder="Your message"
    ></textarea>
    </div>
    <div id="extraField-exp" class="hidden">

        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="type" :value="__('Company Name')" class="w-3/12"/>

            <x-input id="company_name" class="block mt-1 w-9/12" type="text" name="company_name" :value="old('company_name')" autofocus />
        </div>
        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="contact_address" :value="__('Contact Address')" class="w-3/12"/>

            <x-input id="contact_address" class="block mt-1 w-9/12" type="text" name="contact_address" :value="old('contact_address')" autofocus />
        </div>
        <div class="flex flex-row items-center justify-center mt-2">
            <x-label for="payment_date" :value="__('Expected Payment Date')" class="w-3/12"/>

            <x-input id="payment_date" class="block mt-1 w-9/12" type="text" name="payment_date" :value="old('payment_date')" autofocus />
        </div>
    </div>
    <!-- Amount -->
    <div class="flex flex-row items-center justify-center mt-2">
        <x-label for="amount" :value="__('Amount')" class="w-3/12"/>

        <x-input id="exp-amount" class="block mt-1 w-9/12" type="number" name="amount" :value="old('amount')"  step="any" required autofocus />
        </div>

    <div
            class="flex flex-shrink-0 flex-wrap items-center justify-end p-2 border-0 mt-3 rounded-b-md">
            <button type="button"
              class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
              data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit"
              class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
              Save
            </button>
          </div>
</form>
 </div>
</div>
