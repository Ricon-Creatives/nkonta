<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();
            $table->string('employee_name');
            $table->string('grade');
            $table->integer('staff_no');
            $table->string('tin_no');
            $table->double('salary',[15,2]);
           $table->double('cash_allowance',[15,2]);
           $table->double('accomadation',[15,2]);
           $table->double('vehicle_element',[15,2]);
           $table->double('benefits',[15,2]);
           $table->double('social_security',[15,2]);
           $table->double('deductable_relief',[15,2])->nullable();
           $table->double('tax_deductable',[15,2]);
           $table->double('tax_paid_GRA',[15,2]);
           $table->string('month');
           $table->double('total_emoluments',[15,2]);
           $table->double('net_taxable_pay',[15,2]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
