<?php namespace CustomChat\ChatPlugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateChatsTableRemoveUserColumns extends Migration
{
    public function up()
    {
        Schema::table('customchat_chats', function ($table) {
            $table->dropColumn(['user1_id', 'user2_id']);
        });
    }

    public function down()
    {
        Schema::table('customchat_chats', function ($table) {
            $table->integer('user1_id')->unsigned()->nullable();
            $table->integer('user2_id')->unsigned()->nullable();
        });
    }
}
