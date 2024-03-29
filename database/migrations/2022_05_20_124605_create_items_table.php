<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();
            $table->unsignedBigInteger('title_id');
            $table->string('item_name');
            $table->double('price',[15,2]);
            $table->string('qty');
            $table->string('acc_dr');
            $table->string('acc_cr');
            $table->integer('discount')->nullable();
            $table->double('total',[15,2]);
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('companies')->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
