<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('timezone', 3)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('open_date');
            $table->date('close_date');
            $table->string('airport', 3)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->json('speaker_packages')->nullable();
            $table->json('previous_years')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conferences');
    }
}
