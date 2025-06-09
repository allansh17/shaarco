<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_email_template', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment("Email Title");
            $table->text('description')->nullable()->comment("Email Template details");
            $table->enum('delete',['0','1'])->nullable()->comment("0=>Not Deleted, 1=>Deleted");
            $table->enum('status',['0','1'])->nullable()->comment("Inactive /Active");
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
        Schema::dropIfExists('master_email_template');
    }
}
