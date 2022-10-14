<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Transaction extends Model
{
    use HasFactory, UsedByTeams;

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
        'team_id',
        'reference_no',
        'company_name',
        'contact_address',
        'expected_payment_date',
    ];


    /*
    public function user(){
        return $this-> belongsTo(User::class);
      }*/


       /**
       * Get the account that owns the Transactions
       *
       */
      public function companyaccount()
      {
          return $this->belongsTo(CompanyAccount::class,'account_id');
      }


}
