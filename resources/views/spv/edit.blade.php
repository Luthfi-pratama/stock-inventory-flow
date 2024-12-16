@extends('layouts.app')

@section('title', 'Master Data SPV')

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
@endsection

@section('header', 'Master Data SPV')

<!--Tabel Master Data-->
@section('content')
<h3>Edit Data Stock</h3>

<form action="{{url('/dashboard/update-stock/'.$stock->id)}}" method="post" id="update-form">
    @csrf
    <input type="hidden" name="stock_id" id="modal-stock-id" value="">
    <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Nama Barang:</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ $stock ? $stock->name : '' }}"
            required />
        <div class="mb-3">
            <label for="jumlah" class="form-label fw-bold">Jumlah Barang:</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control"
                value="{{ $stock ? $stock->quantity : '' }}" required />
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label fw-bold">Satuan:</label>
            <select name="satuan" id="satuan" class="form-select" value="{{ $stock ? $stock->satuan : '' }}" required>
                <option value="">--Pilih--</option>
                <option value="pcs">Pcs</option>
                <option value="pak">Pak</option>
                <option value="dus">Dus</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label fw-bold">Kategori:</label>
            <select name="kategori" id="kategori" class="form-select" value="{{ $stock ? $stock->category : '' }}"
                required>
                <option value="">--Pilih Kategori--</option>
                @foreach ( $categories as $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label fw-bold">Harga:</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ $stock ? $stock->price : '' }}"
                required />
        </div>
        <div class="mb-3">
            <label for="supplier" class="form-label fw-bold">Supplier:</label>
            <select name="supplier" class="form-select" value="{{ $stock ? $stock->supplier : '' }}" required>
                <option value="">Pilih Supplier</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
</form>
@endsection



<!--Popup Allert-->
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
<!--End Popup Allert-->