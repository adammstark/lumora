<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Lumora Hotel Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-light">

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded",function(){

Swal.fire({
icon:'success',
title:'Berhasil',
text:'{{ session("success") }}',
confirmButtonColor:'#198754'
});

});
</script>
@endif

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

<a class="navbar-brand fw-bold" href="/">
🏨 Lumora Hotel Admin
</a>

<div class="d-flex gap-2">

    <a href="/" class="btn btn-outline-light">
        <i class="fas fa-home"></i> Home
    </a>

    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>

    </form>

</div>

</div>

</nav>

<div class="container py-4">

<h2 class="fw-bold mb-4">

Dashboard Admin

</h2>

<div class="row g-4 mb-4">

    <!-- Total Reservasi -->
    <div class="col-md-3">

        <div class="card shadow border-0 bg-primary text-white">

            <div class="card-body text-center">

                <i class="fas fa-bed fa-2x mb-3"></i>

                <h5>Total Reservasi</h5>

                <h1>{{ $reservations->count() }}</h1>

            </div>

        </div>

    </div>

    <!-- Total Paid -->
    <div class="col-md-3">

        <div class="card shadow border-0 bg-success text-white">

            <div class="card-body text-center">

                <i class="fas fa-credit-card fa-2x mb-3"></i>

                <h5>Total Paid</h5>

                <h1>{{ $totalPaid }}</h1>

            </div>

        </div>

    </div>

    <!-- Pending Payment -->
    <div class="col-md-3">

        <div class="card shadow border-0 bg-warning text-dark">

            <div class="card-body text-center">

                <i class="fas fa-clock fa-2x mb-3"></i>

                <h5>Pending Payment</h5>

                <h1>{{ $pendingPayment }}</h1>

            </div>

        </div>

    </div>

    <!-- Total Pesan -->
    <div class="col-md-3">

        <div class="card shadow border-0 bg-info text-white">

            <div class="card-body text-center">

                <i class="fas fa-envelope fa-2x mb-3"></i>

                <h5>Total Pesan</h5>

                <h1>{{ $contacts->count() }}</h1>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-5">

<div class="card-header bg-dark text-white">

<h4 class="mb-0">

<i class="fas fa-calendar-check"></i>

Daftar Reservasi

</h4>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>No</th>
<th>Customer</th>
<th>Room</th>
<th>Check In</th>
<th>Check Out</th>
<th>Guest</th>
<th>Payment</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($reservations as $r)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

<strong>

{{ $r->customer_name }}

</strong>

<br>

<small class="text-muted">

{{ $r->customer_email }}

</small>

<br>

<small class="text-muted">

📞 {{ $r->customer_phone }}

</small>

</td>

<td>

@if($r->room_type=="Standard Room")

<span class="badge bg-primary">

{{ $r->room_type }}

</span>

@elseif($r->room_type=="Deluxe Room")

<span class="badge bg-warning text-dark">

{{ $r->room_type }}

</span>

@elseif($r->room_type=="Suite Premium")

<span class="badge bg-danger">

{{ $r->room_type }}

</span>

@else

<span class="badge bg-secondary">

{{ $r->room_type }}

</span>

@endif

</td>

<td>{{ $r->checkin }}</td>

<td>{{ $r->checkout }}</td>

<td>{{ $r->guest_count }}</td>
<td>

@if($r->payment_status == "Paid")

    <span class="badge bg-success">
        <i class="fas fa-check-circle"></i> Paid
    </span>

    <br>

    <small class="text-muted">
        {{ $r->payment_method }}
    </small>

@else

    <span class="badge bg-warning text-dark">
        <i class="fas fa-clock"></i> Pending
    </span>

    @if($r->payment_method)

        <br>

        <small class="text-muted">
            {{ $r->payment_method }}
        </small>

    @endif

    @if($r->payment_method == "Transfer Bank" || $r->payment_method == "Cash")

<form action="{{ route('payment.verify',$r->id) }}"
method="POST"
class="mt-2">

    @csrf
    @method('PUT')

    <button class="btn btn-success btn-sm">
        ✔ Verifikasi
    </button>

</form>

@endif

@endif

</td>

<td>

<form
action="{{ route('reservation.status',$r->id) }}"
method="POST">

@csrf
@method('PUT')

<select
name="status"
class="form-select form-select-sm"
onchange="this.form.submit()">

<option value="Pending"
{{ $r->status=='Pending'?'selected':'' }}>
🟡 Pending
</option>

<option value="Confirmed"
{{ $r->status=='Confirmed'?'selected':'' }}>
🟢 Confirmed
</option>

<option value="Checked In"
{{ $r->status=='Checked In'?'selected':'' }}>
🔵 Checked In
</option>

<option value="Checked Out"
{{ $r->status=='Checked Out'?'selected':'' }}>
⚫ Checked Out
</option>

<option value="Cancelled"
{{ $r->status=='Cancelled'?'selected':'' }}>
🔴 Cancelled
</option>

</select>

</form>

</td>

<td>

<form
action="{{ route('reservation.delete',$r->id) }}"
method="POST">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus reservasi ini?')">

<i class="fas fa-trash"></i>

Delete

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="9" class="text-center text-muted">

Belum ada reservasi.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h4 class="mb-0">

<i class="fas fa-envelope-open-text"></i>

Pesan Contact

</h4>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover">

<thead class="table-light">

<tr>

<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Pesan</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($contacts as $c)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $c->name }}</td>

<td>{{ $c->email }}</td>

<td>{{ $c->message }}</td>

<td>

<form
action="{{ route('contact.delete',$c->id) }}"
method="POST">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus pesan ini?')">

<i class="fas fa-trash"></i>

Delete

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center text-muted">

Belum ada pesan.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

<footer class="text-center text-muted mt-5 mb-3">

© 2026 Lumora Hotel • Admin Dashboard

</footer>

</div>

</body>
</html>