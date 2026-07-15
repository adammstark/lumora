<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumora Hotel</title>

    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rooms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Facilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rating.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

    .nav-btn{

        background:none;
        border:none;
        color:white;
        cursor:pointer;
        font-size:16px;
        font-family:'Poppins',sans-serif;
        transition:.3s;

    }

    .nav-btn:hover{

        color:#FFD700;

    }

    </style>

</head>

<body>

{{-- SUCCESS --}}
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded",()=>{

Swal.fire({

icon:'success',
title:'Reservasi Berhasil',
html:'<b>{{ session("success") }}</b>',
timer:2200,
showConfirmButton:false

});

});
</script>
@endif

{{-- ERROR --}}
@if(session('error'))
<script>
document.addEventListener("DOMContentLoaded",()=>{

Swal.fire({

icon:'error',
title:'Kamar Tidak Tersedia',
text:'{{ session("error") }}'

});

});
</script>
@endif

{{-- VALIDASI --}}
@if(isset($errors) && $errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'warning',
        title: 'Data Tidak Valid',
        text: '{{ $errors->first() }}'
    });
});
</script>
@endif


<!-- ================= NAVBAR ================= -->

<nav class="navbar">

    <a href="/" class="logo">
        Lumora Hotel
    </a>

    <ul class="nav-menu">

        <li><a href="#home">Home</a></li>
        <li><a href="#rooms">Rooms</a></li>
        <li><a href="#facilities">Facilities</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#rating">Reviews</a></li>

        @auth

        <li>

            <a href="{{ route('admin') }}">

                <i class="fa-solid fa-gauge"></i>

                Dashboard

            </a>

        </li>

        <li>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="button" id="logoutBtn" class="nav-btn">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </button>

            </form>

        </li>

        @else

        <li>

            <a href="{{ route('login') }}">

                <i class="fa-solid fa-user"></i>

                Login

            </a>

        </li>

        @endauth

    </ul>

</nav>

<!-- ================= HERO ================= -->

<section class="hero" id="home">

    <div class="overlay"></div>

    <div class="hero-content">

        <div class="hero-text">

            <span class="badge">

                ★ Luxury Hotel Experience

            </span>

            <h1>

                Stay in Comfort,<br>

                Stay at Lumora

            </h1>

            <p>

                Nikmati pengalaman menginap premium dengan kamar mewah,
                pelayanan terbaik, dan fasilitas kelas dunia.

            </p>

        </div>

        <div class="booking-box">

            <h2>Pesan Kamar Anda</h2>

            <form
    id="bookingForm"
    method="POST"
    action="{{ route('reservation.store') }}">

    @csrf

    <!-- ================= DATA CUSTOMER ================= -->

    <div class="input-group">

        <label>Nama Lengkap</label>

        <input
            type="text"
            name="customer_name"
            placeholder="Masukkan Nama Lengkap"
            required>

    </div>

    <div class="input-group">

        <label>Email</label>

        <input
            type="email"
            name="customer_email"
            placeholder="Masukkan Email"
            required>

    </div>

    <div class="input-group">

        <label>Nomor HP</label>

        <input
            type="text"
            name="customer_phone"
            placeholder="08xxxxxxxxxx"
            required>

    </div>

    <div class="input-group">

        <label>Alamat</label>

        <textarea
            name="customer_address"
            rows="3"
            placeholder="Masukkan Alamat"
            required></textarea>

    </div>

    <hr style="margin:20px 0;">

    <!-- ================= DATA RESERVASI ================= -->

    <div class="input-group">

        <label>Check In</label>

        <input
            type="date"
            name="checkin"
            required>

    </div>

    <div class="input-group">

        <label>Check Out</label>

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

    <button
        type="submit"
        id="btnBooking">

        Cek Ketersediaan

    </button>

</form>

        </div>

    </div>

</section>

@include('rooms')

@include('facilities')

@include('contact')

@include('rating')

<footer style="padding:25px;text-align:center;background:#111;color:white;margin-top:80px;">

<p>

© 2026 Lumora Hotel • Luxury Hotel Experience

</p>

</footer>

<script>

const form=document.getElementById("bookingForm");

if(form){

form.addEventListener("submit",function(){

document.getElementById("btnBooking").disabled=true;

Swal.fire({

title:'Mengecek Ketersediaan...',
text:'Mohon tunggu sebentar',
allowOutsideClick:false,
allowEscapeKey:false,

didOpen:()=>{

Swal.showLoading();

}

});

});

}

const logout=document.getElementById("logoutBtn");

if(logout){

logout.addEventListener("click",function(){

Swal.fire({

title:'Logout?',
text:'Anda yakin ingin keluar?',
icon:'question',

showCancelButton:true,

confirmButtonText:'Logout',

cancelButtonText:'Batal',

confirmButtonColor:'#d33',

cancelButtonColor:'#3085d6'

}).then((result)=>{

if(result.isConfirmed){

document.getElementById("logoutForm").submit();

}

});

});

}

</script>

</body>
</html>