<?php namespace CustomChat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('customchat_chats', function ($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customchat_chats');
    }
}
