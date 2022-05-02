<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'color',];

    /**
     * Get all of the comments for the Category
     *
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
