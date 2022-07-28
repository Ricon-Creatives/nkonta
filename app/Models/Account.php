<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name','type','financial_statement','group_by_code','industry_id'];

    /**
     * Get all of the comments for the Category
     *
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

      /**
     * Get all of the comments for the Category
     *
     */
    public function totals()
    {
        return $this->hasMany(Total::class)->orderBy('code','asc');
    }

    /**
     * The industries that belong to the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }

}
