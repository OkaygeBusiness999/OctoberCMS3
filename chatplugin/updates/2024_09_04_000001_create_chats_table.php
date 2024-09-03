<?php namespace CustomChat\ChatPlugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('customchat_chats', function ($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('user1_id')->unsigned(); // First user in the chat
            $table->integer('user2_id')->unsigned(); // Second user in the chat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customchat_chats');
    }
}
