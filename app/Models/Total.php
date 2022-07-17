<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Total extends Model
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
        'type',
        'team_id',
        'slug'
    ];

     /**
       * Get the account that owns the Transactions
       *
       */
      public function account()
      {
          return $this->belongsTo(Account::class);
      }

    /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }


}
