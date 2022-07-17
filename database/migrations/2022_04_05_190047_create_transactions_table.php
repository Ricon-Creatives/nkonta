<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();
            $table->date('date');
            $table->unsignedBigInteger('account_id');
            $table->double('amount',[15,2]);
            $table->string('type');
            $table->integer('category_id')->unsigned();
            $table->integer('reference_no')->unsigned();
            $table->text('description_to_debit')->nullable();
            $table->text('description_to_credit')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_address')->nullable();
            $table->date('expected_payment_date')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('team_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
