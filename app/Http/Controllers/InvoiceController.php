<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('invoice', compact('reservation'));
    }
}