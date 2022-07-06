<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Keygen\Keygen;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'token',
        'token_expires_at',
        'company_name',
        'tin_no',
        'locked',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'locked'
    ];

    /**
     * Get all of the transactions for the User
     *
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all of the transactions for the User
     *
     */
    public function totals()
    {
        return $this->hasMany(Total::class,);
    }

    /**
     * Get all of the titles for the User
     *
     */
    public function titles()
    {
        return $this->hasMany(Title::class);
    }

     /**
     * Get all of the transactions for the User
     *
     */
    public function items()
    {
        return $this->hasMany(Item::class,);
    }

 /**
     * Get all of the transactions for the User
     *
     */
    public function payrolls()
    {
        return $this->hasMany(Payroll::class,);
    }

    /*
     * The companies that belong to this user
     */
    public  function company(){
        return $this->belongsToMany(Company::class);
    }

    /*
     * The companies that belong to this user
     */
    public  function firm(){
        return $this->hasOne(Company::class);
    }


    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->token = Keygen::alphanum(6)->generate('strtoupper');
        $this->token_expires_at = now()->addMinutes(1);
        $this->save();
    }


        public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->token = null;
        $this->token_expires_at = null;
        $this->save();
    }

    public function lockUser()
    {
        $this->timestamps = false;
        $this->locked = now();
        $this->save();
    }

    public function lastlogin()
    {
        $this->timestamps = false;
        $this->last_login_at = now();
        $this->save();
    }
}
