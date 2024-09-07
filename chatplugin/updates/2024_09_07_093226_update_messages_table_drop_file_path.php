<?php namespace CustomChat\ChatPlugin\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateMessagesTableDropFilePath extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('customchat_messages', 'file_path')) {
            Schema::table('customchat_messages', function ($table) {
                $table->dropColumn('file_path');
            });
        }
    }

    public function down()
    {
        Schema::table('customchat_messages', function ($table) {
            $table->string('file_path')->nullable();
        });
    }
}
