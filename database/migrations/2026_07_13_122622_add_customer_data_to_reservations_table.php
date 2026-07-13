<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->string('customer_name')->after('id');

            $table->string('customer_email')->after('customer_name');

            $table->string('customer_phone')->nullable()->after('customer_email');

            $table->text('customer_address')->nullable()->after('customer_phone');

        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->dropColumn([
                'customer_name',
                'customer_email',
                'customer_phone',
                'customer_address'
            ]);

        });
    }
};