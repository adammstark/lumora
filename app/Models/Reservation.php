<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [

        // Data Customer
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',

        // Data Reservasi
        'room_type',
        'checkin',
        'checkout',
        'guest_count',

        // Status Reservasi
        'status',

        // Payment
        'payment_method',
        'payment_status',

        // Total Harga
        'total_price',

    ];
}