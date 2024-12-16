@extends('layouts.app')

@section('title', 'Dashboard Staff Karyawan')

@section('sidebar-links')
<li class="nav-item">
    <a class="nav-link" href="{{ route('staff.dashboard') }}">
        <i class="fas fa-warehouse"></i>Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('staff.create') }}">
        <i class="fas fa-box-open"></i>Barang Masuk
    </a>
</li>
<hr>
<div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" class="btn btn-outline-light w-100"
            onclick="event.preventDefault();this.closest('form').submit();">
            Logout</a>

    </form>

</div>

@endsection

@section('header', 'Selamat Datang Staff Karyawan!')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row my-5">
        <div class="col-lg-12 text-center">
            <h1 class="display-4" style="font-weight: 700; color: #4a4a4a;">Hi, Staff!</h1>
            <p class="lead" style="font-size: 1.5rem; color: #7d7d7d;">Selamat datang di dashboard Anda. Di sini, Anda
                dapat mengelola stock barang dan melihat informasi terbaru.</p>
        </div>
    </div>

    <!-- Decorative Divider -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <hr style="border-top: 2px dashed #ddd;">
        </div>
    </div>

    <!-- Content Section -->
    <div class="row my-4 justify-content-center">
        <div class="col-lg-8 text-center">
            <p style="font-size: 1.2rem; color: #6c757d; line-height: 1.8;">
                Gunakan fitur di sidebar untuk mulai bekerja dan kelola stock dengan lebih efisien. Anda dapat menambah
                barang baru, memantau persediaan, dan memastikan stok selalu terkendali.
            </p>
            <a class="btn btn-outline-primary btn-lg mt-3" href="{{ route('staff.create') }}" role="button"
                style="padding: 0.75rem 1.5rem; font-size: 1.1rem;">
                <i class="fas fa-plus"></i> Tambah Stock Baru
            </a>
        </div>
    </div>

    <!-- Footer Text -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 text-center">
            <p class="text-muted" style="font-size: 0.9rem;">
                Pastikan semua barang tercatat dengan baik dan selalu periksa informasi terbaru di dashboard.
            </p>
        </div>
    </div>
</div>
@endsection