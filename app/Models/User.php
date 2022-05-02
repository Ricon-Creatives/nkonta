<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Keygen\Keygen;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'token_expires_at'
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

    /**
     * Get all of the transactions for the User
     *
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,);
    }
    /**
     * Get all of the transactions for the User
     *
     */
    public function totals()
    {
        return $this->hasMany(Total::class,);
    }

        public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->token = Keygen::numeric(7)->prefix('NK-')->generate();
        $this->token_expires_at = now()->addMinutes(2);
        $this->save();
    }

        public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->token = null;
        $this->token_expires_at = null;
        $this->save();
    }
}
