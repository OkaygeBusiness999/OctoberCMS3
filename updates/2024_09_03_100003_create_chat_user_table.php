<?php namespace CustomChat\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateChatUserTable extends Migration
{
    public function up()
    {
        Schema::create('customchat_chat_user', function ($table) {
            $table->integer('chat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['chat_id', 'user_id']);

            $table->foreign('chat_id')->references('id')->on('customchat_chats')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customchat_chat_user');
    }
}
