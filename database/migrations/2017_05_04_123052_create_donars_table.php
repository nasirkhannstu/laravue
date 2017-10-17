<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('blood');
            $table->integer('requester');
            $table->integer('user_requested');
            $table->boolean('status')->default(0);
            $table->text('likes')->nullable();
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
        Schema::dropIfExists('donars');
    }
}
