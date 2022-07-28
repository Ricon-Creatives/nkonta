<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\TeamworkTeam;
class Company extends TeamworkTeam
{
     /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */

    protected $fillable = [
        'name',
        'owner_id',
        'industry_id',
        'slug',
        'company_email',
        'comapny_phone',
        'logo',
    ];

    /**
     * Get the industry associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industry(): HasOne
    {
        return $this->hasOne(Industry::class);
    }

}
