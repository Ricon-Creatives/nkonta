<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Item extends Model
{
    use HasFactory, UsedByTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_no',
        'item_name',
        'qty',
        'price',
        'user_id',
        'acc_dr',
        'acc_cr',
        'title_id',
        'discount',
        'total'
    ];

    /**
     *
     */
    public function title(){
        return $this-> belongsTo(Titles::class);
      }

        /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }

}
