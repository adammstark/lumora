<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Homepage Reservation
    public function store(Request $request)
    {
        return $this->saveReservation(
            $request,
            'General Reservation',
            'Reservasi berhasil dibuat.'
        );
    }

    // Standard Room
    public function standard(Request $request)
    {
        return $this->saveReservation(
            $request,
            'Standard Room',
            'Reservasi Standard Room berhasil.'
        );
    }

    // Deluxe Room
    public function deluxe(Request $request)
    {
        return $this->saveReservation(
            $request,
            'Deluxe Room',
            'Reservasi Deluxe Room berhasil.'
        );
    }

    // Suite Room
    public function suite(Request $request)
    {
        return $this->saveReservation(
            $request,
            'Suite Premium',
            'Reservasi Suite Premium berhasil.'
        );
    }

    // ================= PAYMENT =================

    public function payment($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('payment', compact('reservation'));
    }

  public function processPayment(Request $request, $id)
{
    $request->validate([
        'payment_method' => 'required'
    ],[
        'payment_method.required' => 'Silakan pilih metode pembayaran.'
    ]);

    $reservation = Reservation::findOrFail($id);

    // Simpan metode pembayaran
    $reservation->payment_method = $request->payment_method;

    if ($request->payment_method == "QRIS") {

        // QRIS langsung berhasil
        $reservation->payment_status = "Paid";
        $reservation->status = "Confirmed";

        $message = "Pembayaran QRIS berhasil. Reservasi telah dikonfirmasi.";

    } elseif ($request->payment_method == "Transfer Bank") {

        // Transfer menunggu verifikasi admin
        $reservation->payment_status = "Pending";
        $reservation->status = "Pending";

        $message = "Transfer Bank berhasil dikirim. Menunggu verifikasi admin.";

    } else {

        // Cash dibayar saat Check-In
        $reservation->payment_status = "Pending";
        $reservation->status = "Pending";

        $message = "Metode Cash dipilih. Pembayaran dilakukan saat Check-In.";

    }

   $reservation->save();

return redirect()->route('invoice', $reservation->id)
    ->with('success', $message);
}

    // ================= SAVE RESERVATION =================

    private function saveReservation(Request $request, $roomType, $successMessage)
    {
   $request->validate([
    'customer_name'    => 'required',
    'customer_email'   => 'required|email',
    'customer_phone'   => 'required',
    'customer_address' => 'required',

    'checkin' => 'required|date',
    'checkout' => 'required|date|after:checkin',
    'guest' => 'required'
],[
    'customer_name.required'    => 'Nama wajib diisi.',
    'customer_email.required'   => 'Email wajib diisi.',
    'customer_email.email'      => 'Format email tidak valid.',
    'customer_phone.required'   => 'Nomor HP wajib diisi.',
    'customer_address.required' => 'Alamat wajib diisi.',

    'checkin.required' => 'Tanggal Check In wajib diisi.',
    'checkout.required' => 'Tanggal Check Out wajib diisi.',
    'checkout.after' => 'Tanggal Check Out harus setelah Check In.',
    'guest.required' => 'Jumlah tamu wajib dipilih.'
]);
        $booked = Reservation::where('room_type', $roomType)
            ->where(function ($query) use ($request) {

                $query->whereBetween('checkin', [
                    $request->checkin,
                    $request->checkout
                ])

                ->orWhereBetween('checkout', [
                    $request->checkin,
                    $request->checkout
                ])

                ->orWhere(function ($q) use ($request) {

                    $q->where('checkin', '<=', $request->checkin)
                      ->where('checkout', '>=', $request->checkout);

                });

            })->exists();

        if ($booked) {

            return back()->with(
                'error',
                "$roomType sudah dibooking pada tanggal tersebut."
            );

        }

        // ================= HITUNG TOTAL =================

        $night = Carbon::parse($request->checkin)
            ->diffInDays(Carbon::parse($request->checkout));

        if($night == 0){
            $night = 1;
        }

        switch($roomType){

            case 'Standard Room':
                $price = 500000;
                break;

            case 'Deluxe Room':
                $price = 850000;
                break;

            case 'Suite Premium':
                $price = 1500000;
                break;

            default:
                $price = 500000;
        }

        $total = $night * $price;

        $reservation = Reservation::create([

    // Data Customer
    'customer_name'    => $request->customer_name,
    'customer_email'   => $request->customer_email,
    'customer_phone'   => $request->customer_phone,
    'customer_address' => $request->customer_address,

    // Data Reservasi
    'room_type' => $roomType,
    'checkin' => $request->checkin,
    'checkout' => $request->checkout,
    'guest_count' => $request->guest,

    // Status
    'status' => 'Pending',
    'payment_status' => 'Pending',

    // Total
    'total_price' => $total

]);

        return redirect()->route('payment',$reservation->id);
    }
}