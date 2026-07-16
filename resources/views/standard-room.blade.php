<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar Standard - Lumora Hotel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/StandardRoom.css') }}">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

{{-- SUCCESS --}}
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

{{-- ERROR --}}
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

{{-- VALIDASI --}}
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

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        Lumora Hotel
    </div>

</nav>

<!-- ROOM DETAIL -->

<section class="room-detail">

    <div class="container">

        <img src="{{ asset('images/standard-room.jpg') }}"
             class="hero-image"
             alt="Standard Room">

        <div class="room-header">

            <h1>Kamar Standard</h1>

            <p>
                Kamar nyaman dengan fasilitas lengkap untuk 2 orang.
            </p>

            <h2>
                Rp 500.000
                <span>/ malam</span>
            </h2>

        </div>

        <div class="room-info">

            <div class="info-box">
                <p>Luas Kamar</p>
                <h3>25 m²</h3>
            </div>

            <div class="info-box">
                <p>Kapasitas</p>
                <h3>2 Orang</h3>
            </div>

            <div class="info-box">
                <p>Tipe Kasur</p>
                <h3>Queen Bed</h3>
            </div>

            <div class="info-box">
                <p>Pemandangan</p>
                <h3>City View</h3>
            </div>

        </div>

        <hr>

        <div class="facility-section">

            <h2>Fasilitas</h2>

            <div class="facility-grid">

                <div>✓ WiFi Gratis</div>
                <div>✓ Sarapan</div>
                <div>✓ TV Kabel</div>

                <div>✓ AC</div>
                <div>✓ Mini Bar</div>
                <div>✓ Kamar Mandi Dalam</div>

                <div>✓ Air Panas</div>
                <div>✓ Handuk</div>
                <div>✓ Toiletries</div>

            </div>

        </div>

        <!-- BOOKING -->

        <div class="booking-card">

            <h2>Pesan Kamar</h2>

            <form id="bookingForm"
                  method="POST"
                  action="{{ route('standard.room') }}">

                @csrf

                <div class="booking-form">

    <div class="input-group">
        <label>Nama Lengkap</label>
        <input type="text"
               name="customer_name"
               placeholder="Masukkan nama lengkap"
               required>
    </div>

    <div class="input-group">
        <label>Email</label>
        <input type="email"
               name="customer_email"
               placeholder="Masukkan email"
               required>
    </div>

    <div class="input-group">
        <label>No. HP</label>
        <input type="text"
               name="customer_phone"
               placeholder="08xxxxxxxxxx"
               required>
    </div>

    <div class="input-group">
        <label>Alamat</label>
        <textarea
            name="customer_address"
            placeholder="Masukkan alamat"
            required></textarea>
    </div>

    <div class="input-group">
        <label>Check-in</label>
        <input type="date"
               name="checkin"
               required>
    </div>

    <div class="input-group">
        <label>Check-out</label>
        <input type="date"
               name="checkout"
               required>
    </div>

    <div class="input-group">
        <label>Jumlah Tamu</label>

        <select name="guest" required>
            <option value="">Pilih Tamu</option>
            <option value="1">1 Tamu</option>
            <option value="2">2 Tamu</option>
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