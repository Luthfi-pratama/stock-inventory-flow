@extends('layouts.app')

@section('title', 'Dashboard MANAGER')

@section('sidebar-links')
<li class="nav-item">
    <a href="{{ route('manager.dashboard-mngr') }}" class="nav-link active text-white">
        <i class="fas fa-tachometer-alt me-2"></i> Stock
    </a>
</li>
<li>
    <a href="{{ route('laporan')}}" class="nav-link text-white">
        <i class="fas fa-chart-line me-2"></i> Laporan
    </a>
</li>
<li>
    <a href="{{ route('pengguna')}}" class="nav-link text-white">
        <i class="fas fa-users me-2"></i> Pengguna
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

@section('header', 'Selamat Datang MANAGER!')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h3>REKAP BARANG MASUK</h3>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <!-- Other summary cards remain the same -->
        </div>
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection