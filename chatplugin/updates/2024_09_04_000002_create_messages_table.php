<?php namespace CustomChat\ChatPlugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('customchat_messages', function ($table) {
            $table->increments('id');
            $table->integer('chat_id')->unsigned(); // Reference to the chat
            $table->integer('user_id')->unsigned(); // User who sent the message
            $table->text('message')->nullable(); // Text message
            $table->string('file_path')->nullable(); // Optional file upload
            $table->json('reactions')->nullable(); // JSON field for reactions
            $table->integer('parent_message_id')->unsigned()->nullable(); // Reference to parent message for replies
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customchat_messages');
    }
}
