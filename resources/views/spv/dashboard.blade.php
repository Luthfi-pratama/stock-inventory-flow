@extends('layouts.app')

@section('title', 'Dashboard SPV')

@section('sidebar-links')

<li class="nav-item">
    <a class="nav-link active" href="{{ route('spv.dashboard') }}">
        <i class="fa-solid fa-check"></i> Stock
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('spv.master') }}">
        <i class="fa-brands fa-dropbox"></i> Master Data
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('spv.supplier') }}">
        <i class="fa-solid fa-truck"></i> Supplier/PT
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('spv.category') }}">
        <i class="fa-solid fa-store"></i> Category
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

@section('header', 'DASHBOARD SPV')

@section('content')

<div class="card shadow-lg p-4">
    <h3 class="mb-3">Barang Pending Persetujuan</h3>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingStocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->satuan }}</td>
                <td>{{ $stock->price }}</td>
                <td>{{ $stock->category ? $stock->category->name : 'Tidak ada kategori' }}</td>
                <td>{{ $stock->supplier ? $stock->supplier->name : 'Tidak ada Supplier' }}</td>
                <td>
                    <form action="{{ route('spv.approve', $stock->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Link pagination untuk pendingStocks -->
<div class="d-flex justify-content-center">
    {{ $pendingStocks->links() }}
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(Session::has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil disetujui',
        text: "{{ Session::get('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
@endsection