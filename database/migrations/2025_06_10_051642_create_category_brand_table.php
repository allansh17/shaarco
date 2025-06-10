<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Step 1: Create the new pivot table
        Schema::create('category_brand', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            // Unique constraint to prevent duplicate relationships
            $table->unique(['category_id', 'brand_id']);

            // Index for better performance
            $table->index(['category_id', 'brand_id']);
        });

        // Step 2: Migrate existing data from category.brands to category_brand table
        $this->migrateExistingData();
    }

    /**
     * Migrate existing brand relationships to the new pivot table
     */
    private function migrateExistingData()
    {
        // Get all categories with their brand relationships
        $categories = DB::table('category')
            ->whereNotNull('brands')
            ->where('brands', '!=', '')
            ->where('brands', '>', 0)
            ->select('id', 'brands')
            ->get();

        foreach ($categories as $category) {
            // Verify that the brand still exists
            $brandExists = DB::table('brands')
                ->where('id', $category->brands)
                ->exists();

            if ($brandExists) {
                // Insert into pivot table, ignore if already exists
                DB::table('category_brand')->insertOrIgnore([
                    'category_id' => $category->id,
                    'brand_id' => $category->brands,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Log warning about orphaned brand reference
                \Log::warning("Category {$category->id} references non-existent brand {$category->brands}");
            }
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_brand');
    }
}
