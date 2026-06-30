<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuestFieldsToCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('guest_first_name')->nullable()->after('user_id');
            $table->string('guest_last_name')->nullable()->after('guest_first_name');
            $table->string('guest_phone', 30)->nullable()->after('guest_last_name');
            $table->string('guest_email')->nullable()->after('guest_phone');
            $table->text('guest_location')->nullable()->after('guest_email');
        });
    }

    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn([
                'guest_first_name',
                'guest_last_name',
                'guest_phone',
                'guest_email',
                'guest_location',
            ]);
        });
    }
}
