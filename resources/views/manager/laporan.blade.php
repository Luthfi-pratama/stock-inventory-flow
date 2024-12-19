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
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h3 class="mb-4 text-center ">LAPORAN GRAFIK</h3>
        <!-- Card Laporan -->
        <div class="row justify-content-center text-center mt-5">
            <div class="col-lg-4">
                <div class="card shadow-sm border-2 mb-4 rounded-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary">Total Produk</h5>
                        <p class="card-text fs-4 text-dark">{{ $total }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-2 mb-4 rounded-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary">Total User</h5>
                        <p class="card-text fs-4 text-dark">{{ $totalUser }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card Laporan -->
        <!-- Start Card Grafik -->
        <div class="container mt-5">
            <div class="">
                <h3 class="mb-4 text-center text-primary">Laporan Grafik Stok</h3>
                <!-- Chart -->
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="stockChart" height="100"></canvas>
                    </div>
                </div>
                <!-- End Chart -->
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('stockChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($categories),
                datasets: [{
                    label: 'Jumlah Stock per Kategori',
                    data: @json($totals),
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Stock per Kategori'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>

@endsection