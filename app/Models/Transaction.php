<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'amount',
        'account_id',
        'category_id',
        'description_to_credit',
        'description_to_debit',
        'type',
        'user_id',
        'reference_no',
        'company_name',
        'contact_address',
        'expected_payment_date',
        'slug'
    ];


    /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }


       /**
       * Get the account that owns the Transactions
       *
       */
      public function account()
      {
          return $this->belongsTo(Account::class);
      }


}
