<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeGeneralInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_general_info', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable()->comment("first name");
            $table->string('last_name')->nullable()->comment("last name");
            $table->string('email')->nullable()->comment("Email id");
            $table->string('password')->nullable()->comment("password");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('phone')->nullable()->comment("phone no");
            $table->string('address')->nullable()->comment("address");
            $table->string('pin')->nullable()->comment("pin");
            $table->date('dob')->nullable()->comment("date of birth");
            $table->enum('status', ['0', '1'])->nullable()->comment("0=>inactive,1=>active");
            $table->string('profile_image')->nullable()->comment("profile image");
            $table->enum('is_superadmin', ['0', '1'])->default('0')->comment("0=>no,1=>yes");
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
        Schema::dropIfExists('employee_general_info');
    }
}
