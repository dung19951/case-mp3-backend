<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_lists', function (Blueprint $table) {
            $table->bigIncrements('play_list_id');
            $table->string('play_list_name');
            $table->bigInteger('song_id')->unsigned()->nullable();
            $table->bigInteger('comment_id')->unsigned()->nullable();
            $table->integer('like')->nullable()->default(0);
            $table->integer('unlike')->nullable()->default(0);
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
        Schema::dropIfExists('play_lists');
    }
}
