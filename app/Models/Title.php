<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'contact_no',
        'type',
        'user_id',
        'contact_person',
        'vat',
        'due_date'
    ];


    /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }

       /**
     * Get all of the items for the User
     *
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
