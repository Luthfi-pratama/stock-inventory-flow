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

<!-- Modal for Add Supplier -->
<div class="modal fade" id="createDataModal" tabindex="-1" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('spv.addSupplier') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="supplier_name" class="form-label">Nama Supplier:</label>
                        <input type="text" name="name" id="supplier_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_contact" class="form-label">Kontak Supplier:</label>
                        <input type="text" name="contact" id="supplier_contact" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_address" class="form-label">Alamat Supplier:</label>
                        <input type="text" name="address" id="supplier_address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_description" class="form-label">Deskripsi Supplier:</label>
                        <textarea name="description" id="supplier_description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-lg p-4">
    <!-- Tombol Tambah Data karena menggunakan modal css -->
    <h3 class="mb-3">Daftar Supplier</h3>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Contact</th>
                <th>Address</th>
                <th>description</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supp)
            <tr id="supp_{{ $supp->id }}">
                <td>{{ $supp->id }}</td>
                <td>{{ $supp->name }}</td>
                <td>{{ $supp->contact }}</td>
                <td>{{ $supp->address }}</td>
                <td>{{ $supp->description }}</td>
                <td>
                    <button class="btn btn-danger" id="btn-delete-supplier" data-id="{{ $supp->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-success mt-5" data-bs-toggle="modal" data-bs-target="#createDataModal">
        Tambah Supplier
    </button>
</div>


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
<script>
    $('body').on('click', '#btn-delete-supplier', function() {
        let supp_id = $(this).data('id'); // Mengambil ID kategori dari tombol
        let token = $("meta[name='csrf-token']").attr("content"); // Mengambil token CSRF


        // Konfirmasi dengan SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim request AJAX ke server untuk menghapus kategori
                $.ajax({
                    url: `/spv/supplier/destroy/${supp_id}`,
                    type: 'DELETE',
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                        // Jika berhasil, tampilkan alert sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Hapus baris tabel yang bersangkutan
                        $(`#supp_${supp_id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Jika ada error, tampilkan alert error
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menghapus kategori. Silakan coba lagi.',
                        });
                    }
                });
            }
        });
    });
</script>
@endsection