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
        'description',
        'type',
        'user_id',
        'reference_no'
    ];

    /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }

      /**
       * Get the category that owns the Transactions
       *
       */
      public function category()
      {
          return $this->belongsTo(Category::class);
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
