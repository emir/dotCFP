<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('github_id')->unique();

            //speaker details
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('airport_code', 3)->nullable();
            $table->string('twitter_handle', 15)->nullable();
            $table->string('url')->nullable();
            $table->unsignedTinyInteger('desire_transportation')->nullable();
            $table->unsignedTinyInteger('desire_accommodation')->nullable();
            $table->unsignedTinyInteger('is_sponsor')->nullable();

            //role
            $table->string('role')->default('user');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
