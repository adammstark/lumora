<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->string('payment_method')->nullable()->after('status');

            $table->string('payment_status')
                  ->default('Pending')
                  ->after('payment_method');

            $table->decimal('total_price',10,2)
                  ->default(0)
                  ->after('payment_status');

        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->dropColumn([
                'payment_method',
                'payment_status',
                'total_price'
            ]);

        });
    }
};