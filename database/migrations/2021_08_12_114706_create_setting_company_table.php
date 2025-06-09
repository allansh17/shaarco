<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_company', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable()->comment("company name"); 
            $table->string('company_logo')->nullable()->comment("company logo"); 
            $table->string('email_logo')->nullable()->comment("email logo"); 
            $table->string('report_logo')->nullable()->comment("report logo"); 
            $table->string('address')->nullable()->comment("company address"); 
            $table->string('email')->nullable()->comment("company email"); 
            $table->string('phone')->nullable()->comment("company phone no"); 
            $table->string('website')->nullable()->comment("company website"); 
            $table->string('currency')->nullable()->comment("company currency");
            $table->string('favi_icon')->nullable()->comment("company favi icon"); 
            $table->string('hostname')->nullable()->comment("smtp hostname"); 
            $table->string('username')->nullable()->comment("smtp username"); 
            $table->string('port')->nullable()->comment("smtp port"); 
            $table->string('password')->nullable()->comment("smtp password"); 
            $table->string('no_reply_mail')->nullable()->comment("smtp noreply mail");
            $table->string('director_name')->nullable()->comment("director name"); 
            $table->string('reg_no')->nullable()->comment("registration number"); 
            $table->string('company_service')->nullable()->comment("company service");
            $table->string('quotation_code')->nullable()->comment("Quotation starting code");
            $table->string('emergency_number');
            $table->enum('show_sales_price',['0', '1'])->nullable()->comment("0 for no,1 for yes....show sale price to sale person or not");
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
        Schema::dropIfExists('setting_company');
    }
}
