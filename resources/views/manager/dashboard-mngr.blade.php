@extends('layouts.app')

@section('title', 'Dashboard MANAGER')

@section('sidebar-links')
<li class="nav-item">
    <a href="{{ route('manager.dashboard-mngr') }}" class="nav-link active text-white">
        <i class="fas fa-tachometer-alt me-2"></i> Stock
    </a>
</li>
<li>
    <a href="#" class="nav-link text-white">
        <i class="fas fa-chart-line me-2"></i> Laporan
    </a>
</li>
<li>
    <a href="#" class="nav-link text-white">
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

        <!-- Form Rentang Tanggal -->
        <form action="{{ route('manager.dashboard-mngr') }}" method="GET" class="mb-3">
            <label for="start_date" class="form-label">Dari Tanggal:</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ request('start_date') }}">

            <label for="end_date" class="form-label mt-2">Sampai Tanggal:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">

            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>

        <form action="{{ route('manager.dashboard-mngr') }}" method="GET" class="mb-3">
            <label for="range" class="form-label">Pilih Rentang Waktu:</label>
            <select name="range" id="range" class="form-select" onchange="this.form.submit()">
                <option value="today" {{ $range === 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="thisWeek" {{ $range === 'thisWeek' ? 'selected' : '' }}>Minggu Ini</option>
                <option value="thisMonth" {{ $range === 'thisMonth' ? 'selected' : '' }}>Bulan Ini</option>
            </select>
        </form>

        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('cetak-data', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
            class="btn btn-primary mt-4">
            Print <i class="fa-solid fa-print"></i>
        </a>
        <a href="{{ route('preview-pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
            target="_blank" class="btn btn-primary mt-4">
            Preview PDF
        </a>
    </div>
</div>
@endsection