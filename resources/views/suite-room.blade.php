<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Suite Premium - Lumora Hotel</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/StandardRoom.css') }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded",function(){

Swal.fire({
icon:'success',
title:'Reservasi Berhasil',
text:'{{ session("success") }}',
confirmButtonColor:'#3085d6'
});

});
</script>
@endif

@if(session('error'))
<script>
document.addEventListener("DOMContentLoaded",function(){

Swal.fire({
icon:'error',
title:'Kamar Tidak Tersedia',
text:'{{ session("error") }}',
confirmButtonColor:'#d33'
});

});
</script>
@endif

@if($errors->any())
<script>
document.addEventListener("DOMContentLoaded",function(){

Swal.fire({
icon:'warning',
title:'Data Tidak Valid',
text:'{{ $errors->first() }}',
confirmButtonColor:'#f39c12'
});

});
</script>
@endif

<nav class="navbar">

<div class="logo">
Lumora Hotel
</div>

</nav>

<section class="room-detail">

<div class="container">

<img src="{{ asset('images/suite-room.jpg') }}"
class="hero-image">

<div class="room-header">

<h1>Suite Premium</h1>

<p>
Suite mewah dengan ruang tamu terpisah dan fasilitas eksklusif.
</p>

<h2>
Rp 1.500.000
<span>/ malam</span>
</h2>

</div>

<div class="room-info">

<div class="info-box">
<p>Luas Kamar</p>
<h3>45 m²</h3>
</div>

<div class="info-box">
<p>Kapasitas</p>
<h3>4 Orang</h3>
</div>

<div class="info-box">
<p>Tipe Kasur</p>
<h3>King Bed</h3>
</div>

<div class="info-box">
<p>Pemandangan</p>
<h3>Ocean View</h3>
</div>

</div>

<hr>

<div class="facility-section">

<h2>Fasilitas</h2>

<div class="facility-grid">

<div>✓ WiFi Gratis</div>
<div>✓ Sarapan Premium</div>
<div>✓ Smart TV</div>

<div>✓ AC</div>
<div>✓ Jacuzzi</div>
<div>✓ Living Room</div>

<div>✓ Mini Bar</div>
<div>✓ Coffee Machine</div>
<div>✓ Butler Service</div>

</div>

</div>

<div class="booking-card">

<h2>Pesan Kamar</h2>

<form
id="bookingForm"
method="POST"
action="{{ route('suite.room') }}">

@csrf

<div class="booking-form">

<div class="input-group">
<label>Check-in</label>
<input
type="date"
name="checkin"
required>
</div>

<div class="input-group">
<label>Check-out</label>
<input
type="date"
name="checkout"
required>
</div>

<div class="input-group">

<label>Jumlah Tamu</label>

<select
name="guest"
required>

<option value="">Pilih Tamu</option>
<option value="1">1 Tamu</option>
<option value="2">2 Tamu</option>
<option value="3">3 Tamu</option>
<option value="4">4 Tamu</option>

</select>

</div>

</div>

<button
type="submit"
id="btnBooking">

Pesan Sekarang

</button>

</form>

</div>

</div>

</section>

<script>

document.getElementById("bookingForm").addEventListener("submit",function(){

document.getElementById("btnBooking").disabled=true;

Swal.fire({

title:'Mengecek Ketersediaan...',
text:'Mohon tunggu sebentar',

allowOutsideClick:false,

didOpen:()=>{

Swal.showLoading();

}

});

});

</script>

</body>
</html>