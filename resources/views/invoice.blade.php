<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Invoice - Lumora Hotel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    background:#f4f6f9;
}

.invoice-card{
    max-width:850px;
    margin:auto;
    background:#fff;
    border-radius:20px;
    padding:40px;
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.logo{
    font-size:40px;
    font-weight:bold;
    color:#0d6efd;
}

.status{
    font-size:18px;
    font-weight:bold;
}

@media print{

    .no-print{
        display:none;
    }

    body{
        background:white;
    }

    .invoice-card{
        box-shadow:none;
    }

}

</style>

</head>

<body>

<div class="container py-5">

<div class="invoice-card">

<div class="text-center mb-4">

<h1 class="logo">

🏨 Lumora Hotel

</h1>

<h3>

BOOKING INVOICE

</h3>

<p class="text-muted">

Luxury Hotel Experience

</p>

</div>

<hr>

<div class="row mb-4">

<div class="col-md-6">

<h5>Customer</h5>

<p>

<strong>{{ $reservation->customer_name }}</strong>

<br>

{{ $reservation->customer_email }}

<br>

{{ $reservation->customer_phone }}

<br>

{{ $reservation->customer_address }}

</p>

</div>

<div class="col-md-6 text-md-end">

<h5>

Invoice

</h5>

<p>

INV-{{ str_pad($reservation->id,5,'0',STR_PAD_LEFT) }}

</p>

<p>

{{ now()->format('d M Y') }}

</p>

</div>

</div>

<table class="table table-bordered">

<tr>

<th width="35%">Room</th>

<td>{{ $reservation->room_type }}</td>

</tr>

<tr>

<th>Check In</th>

<td>{{ $reservation->checkin }}</td>

</tr>

<tr>

<th>Check Out</th>

<td>{{ $reservation->checkout }}</td>

</tr>

<tr>

<th>Guest</th>

<td>{{ $reservation->guest_count }} Orang</td>

</tr>

<tr>

<th>Payment Method</th>

<td>{{ $reservation->payment_method }}</td>

</tr>

<tr>

<th>Payment Status</th>

<td>

@if($reservation->payment_status=="Paid")

<span class="badge bg-success status">

Paid

</span>

@else

<span class="badge bg-warning text-dark status">

Pending

</span>

@endif

</td>

</tr>

<tr>

<th>Reservation Status</th>

<td>

{{ $reservation->status }}

</td>

</tr>

<tr class="table-success">

<th>Total</th>

<td>

<strong>

Rp {{ number_format($reservation->total_price,0,',','.') }}

</strong>

</td>

</tr>

</table>

<div class="text-center mt-5">

<p>

Terima kasih telah memilih

<strong>

Lumora Hotel

</strong>

</p>

<p class="text-muted">

Silakan tunjukkan invoice ini saat Check-In.

</p>

</div>

<hr>

<div class="text-center no-print">

<button
onclick="window.print()"
class="btn btn-primary">

<i class="fas fa-print"></i>

Print Invoice

</button>

<a
href="/"
class="btn btn-secondary">

Home

</a>

</div>

</div>

</div>

</body>
</html>