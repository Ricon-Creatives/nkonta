<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Payroll extends Model
{
    use HasFactory, UsedByTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'staff_no',
        'employee_name',
        'grade',
        'tin_no',
        'salary',
        'cash_allowance',
        'accomadation',
        'vehicle_element',
        'benefits',
        'social_security',
        'deductable_relief',
        'tax_deductable',
        'tax_paid_GRA',
        'month',
        'total_emoluments',
        'net_taxable_pay',
        'team_id'
    ];

      /**
     *
     */
    public function user(){
        return $this-> belongsTo(User::class);
      }


}
