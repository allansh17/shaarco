<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_categories', function (Blueprint $table) {
            $table->id();
		    $table->string('name')->nullable()->comment("name");
		    $table->text('image')->nullable()->comment("category image");
		    $table->text('icon')->nullable()->comment("category icon");
		    $table->string('slug')->nullable()->comment("category slug");
		    $table->text('description')->nullable()->comment("category description");
		    $table->text('meta_title')->nullable()->comment("meta title");
		    $table->text('meta_keywords')->nullable()->comment("meta keywords");
		    $table->text('meta_description')->nullable()->comment("meta description");
		    $table->enum('is_active',['0', '1'])->default('1')->comment("0=>inactive,1=>active");
		    $table->integer('created_by_id')->nullable()->comment("created by");
		    $table->integer('updated_by_id')->nullable()->comment("updated by");
		    $table->integer('sort')->nullable()->comment("order no for the category");
		    $table->timestamps();
		    $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
