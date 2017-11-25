<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTalkIdForeignKeyOnVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_talk_id_foreign');
            $table->foreign('talk_id')->references('id')->on('talks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_talk_id_foreign');
            $table->foreign('talk_id')->references('id')->on('users');
        });
    }
}
