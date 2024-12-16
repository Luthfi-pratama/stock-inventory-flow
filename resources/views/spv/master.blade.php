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
    <h3 class="mb-3">MASTER DATA</h3>
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
            @foreach ($approvedStocks as $stock)
            <tr id="index_{{ $stock->id }}">
                <td>{{ $loop->iteration + ($approvedStocks->currentPage() - 1) * $approvedStocks->perPage() }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->satuan }}</td>
                <td>{{ $stock->price }}</td>
                <td>{{ $stock->category ? $stock->category->name : 'Tidak ada kategori' }}</td>
                <td>{{ $stock->supplier ? $stock->supplier->name : 'Tidak ada supplier' }}</td>
                <td>
                    <a class="btn btn-primary" href="{{url($stock->id.'/edit-stock')}}" data-toggle="modal"
                        data-target="#ModalEdit"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger" id="btn-delete-stock" data-id="{{ $stock->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $approvedStocks->links("pagination::bootstrap-5") }}
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(Session::has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Data Diperbarui',
        text: "{{ Session::get('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

<script>
    $('body').on('click', '#btn-delete-stock', function() {
        let stock_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/spv/master-data/destroy/${stock_id}`,
                    type: "DELETE",
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        // Menghapus elemen baris dari tabel dengan animasi
                        $('#index_' + stock_id).fadeOut(300, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Data gagal dihapus.',
                        });
                    }
                });
            }
        });
    });
</script>
@endsection