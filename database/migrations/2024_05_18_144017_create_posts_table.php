<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('recorder');
            $table->date('date');
            $table->string('recordScore');
            $table->string('proveFile');
            $table->string('ifProved')->default('no');
            $table->longText('awardSpeech')->nullable();
            $table->string('cover')->nullable();
            /*             $table->timestamps(); */

            //到時候要加入email 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
