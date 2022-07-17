<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();
            $table->string('name');
            $table->integer('vat');
            $table->string('address')->nullable();
            $table->string('type');
            $table->string('contact_no');
            $table->string('contact_person');
            $table->integer('due_date')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('titles');
    }
}
