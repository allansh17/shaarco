<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('receiver_id')->nullable()->comment("Receiver id from local table");
            $table->string('title')->nullable()->comment("Notification title");
            $table->string('description')->nullable()->comment("Notification description");
            $table->enum('is_read',['0','1'])->default('0')->comment("0=>not read, 1=>read");
            $table->string('notification_status')->nullable()->comment("notification status");
            $table->string('redirect_path')->nullable()->comment("Redirect Path");
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
        Schema::dropIfExists('notifications');
    }
}
