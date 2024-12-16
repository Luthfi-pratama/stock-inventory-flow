@extends('layouts.app')

@section('title', 'Dashboard Staff Karyawan')

@section('sidebar-links')
<li class="nav-item">
    <a class="nav-link" href="{{ route('staff.dashboard') }}">
        <i class="fas fa-warehouse"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('staff.create') }}">
        <i class="fas fa-box-open"></i> Barang Masuk
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
<!-- Button Modal tambah data-->
<div class="card shadow-lg p-4">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createDataModal">
        Buat Stock
    </button>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStockModal">
        Tambah Stock
    </button>

    <!-- Modal buat data -->
    <div class="modal fade" id="createDataModal" tabindex="-1" aria-labelledby="createDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Barang:</label>
                            <input type="text" name="nama" id="nama" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-bold">Jumlah Barang:</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label fw-bold">Satuan:</label>
                            <select name="satuan" id="satuan" class="form-select" required>
                                <option value="">--Pilih--</option>
                                <option value="pcs">Pcs</option>
                                <option value="pak">Pak</option>
                                <option value="dus">Dus</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori:</label>
                            <select name="kategori" id="kategori" class="form-select" required>
                                <option value="">--Pilih Kategori--</option>
                                @foreach ( $categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label fw-bold">Harga:</label>
                            <input type="number" name="harga" id="harga" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="supplier" class="form-label fw-bold">Supplier:</label>
                            <select name="supplier" class="form-select" required>
                                <option value="">Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!---->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(Session::has('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ Session::get('success') }}",
    showConfirmButton: false,
    timer: 1500
});
</script>
@endif

@endsection