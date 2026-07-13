<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
{
    $reservations = Reservation::latest()->get();
    $contacts = Contact::latest()->get();

    $totalPaid = Reservation::where('payment_status', 'Paid')->count();

    $pendingPayment = Reservation::where('payment_status', 'Pending')->count();

    return view('admin', compact(
        'reservations',
        'contacts',
        'totalPaid',
        'pendingPayment'
    ));
}

    // Update Status Reservasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Checked In,Checked Out,Cancelled'
        ]);

        $reservation = Reservation::findOrFail($id);

        $reservation->status = $request->status;

        $reservation->save();

        return redirect()->route('admin')
            ->with('success', 'Status reservasi berhasil diubah.');
    }

    // Hapus Reservasi
    public function destroyReservation($id)
    {
        Reservation::findOrFail($id)->delete();

        return redirect()->route('admin')
            ->with('success', 'Reservasi berhasil dihapus.');
    }

    // Hapus Contact
    public function destroyContact($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()->route('admin')
            ->with('success', 'Pesan berhasil dihapus.');
    }
    public function verifyPayment($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->payment_status = "Paid";
    $reservation->status = "Confirmed";

    $reservation->save();

    return back()->with('success', 'Pembayaran berhasil diverifikasi.');
}
}