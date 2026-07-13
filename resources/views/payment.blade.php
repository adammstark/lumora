<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Lumora Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            background:#f5f7fb;
        }

        .card{
            border-radius:20px;
        }

        .payment-info img{
            max-width:240px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .payment-info{
            display:none;
        }

        .rekening{
            font-size:28px;
            font-weight:bold;
            color:#0d6efd;
            letter-spacing:2px;
        }

        .btn-copy{
            margin-top:10px;
        }
    </style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow-lg border-0">

<div class="card-header bg-dark text-white text-center">

<h3 class="mb-0">
💳 Payment Reservation
</h3>

</div>

<div class="card-body">

<h4 class="text-center mb-3">

👤 Data Customer

</h4>

<table class="table table-bordered">

<tr>
    <th width="35%">Nama</th>
    <td>{{ $reservation->customer_name }}</td>
</tr>

<tr>
    <th>Email</th>
    <td>{{ $reservation->customer_email }}</td>
</tr>

<tr>
    <th>No HP</th>
    <td>{{ $reservation->customer_phone }}</td>
</tr>

<tr>
    <th>Alamat</th>
    <td>{{ $reservation->customer_address }}</td>
</tr>

</table>

<h4 class="text-center mt-4 mb-4">

🏨 Booking Detail

</h4>

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

<tr class="table-success">

<th>Total Pembayaran</th>

<td>

<strong class="fs-4">

Rp {{ number_format($reservation->total_price,0,',','.') }}

</strong>

</td>

</tr>

</table>

<hr>

<form id="paymentForm"
action="{{ route('payment.process',$reservation->id) }}"
method="POST">

@csrf

<label class="form-label fw-bold">

Metode Pembayaran

</label>

<select
id="paymentMethod"
name="payment_method"
class="form-select"
required>

<option value="">-- Pilih Metode Pembayaran --</option>

<option value="Transfer Bank">
🏦 Transfer Bank
</option>

<option value="QRIS">
📱 QRIS
</option>

<option value="Cash">
💵 Cash
</option>

</select>

<div id="paymentInfo" class="payment-info mt-4"></div>

<button
type="submit"
class="btn btn-success btn-lg w-100 mt-4">

💳 Konfirmasi Pembayaran

</button>

</form>

<hr>

<div class="d-flex justify-content-center gap-2 mt-4">

<a href="/"
class="btn btn-secondary">

<i class="fas fa-house"></i>

Home

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script>

const payment=document.getElementById("paymentMethod");
const info=document.getElementById("paymentInfo");

payment.addEventListener("change",function(){

info.style.display="block";

if(this.value==="Transfer Bank"){

info.innerHTML=`

<div class="alert alert-primary">

<h4>🏦 Transfer Bank BCA</h4>

<hr>

<p>No. Rekening</p>

<div class="rekening">

987612345

</div>

<p class="mt-2">

A/N Lumora Hotel

</p>

<button
type="button"
class="btn btn-primary btn-copy"
onclick="copyRekening()">

📋 Salin Nomor Rekening

</button>

</div>

`;

}

else if(this.value==="QRIS"){

info.innerHTML=`

<div class="text-center">

<h4 class="mb-3">

📱 Scan QRIS

</h4>

<img src="{{ asset('images/qris.jpg') }}">

<p class="mt-3">

Silakan scan menggunakan
GoPay, OVO, DANA,
ShopeePay atau Mobile Banking.

</p>

</div>

`;

}

else if(this.value==="Cash"){

info.innerHTML=`

<div class="alert alert-success">

<h4>

💵 Cash

</h4>

<hr>

Silakan melakukan pembayaran
langsung di resepsionis saat
Check-In.

</div>

`;

}

else{

info.style.display="none";

}

});

function copyRekening(){

navigator.clipboard.writeText("987612345");

Swal.fire({

icon:"success",

title:"Berhasil",

text:"Nomor rekening berhasil disalin."

});

}

document.getElementById("paymentForm").addEventListener("submit",function(){

Swal.fire({

title:"Memproses Pembayaran...",

text:"Mohon tunggu sebentar",

allowOutsideClick:false,

didOpen:()=>{

Swal.showLoading();

}

});

});

</script>

</body>
</html>