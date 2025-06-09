<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('user_id'); // Foreign key for user
            $table->integer('product_id'); // Foreign key for product
            $table->integer('qty'); // Quantity of the product
            $table->text('message')->nullable(); // Optional message field
            $table->timestamps(); // Created and updated timestamps

            // Add foreign key constraints if applicable
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
