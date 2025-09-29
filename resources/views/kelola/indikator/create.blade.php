@extends('layouts.app')

@section('stylecss')
<!-- Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />

<!-- Font Awesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Iconpicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

@endsection

@section('content')
<div class="container">
    <div class="page-inner">

        <!-- Notifikasi Error -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Tambah Indikator</h2>
                <h6 class="op-7 mb-2">Menambahkan Indikator Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('kelola.indikator.index') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('kelola.indikator.store') }}" method="POST">
                    @csrf

                    <!-- Nama Indikator -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Indikator</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            placeholder="Masukkan Nama Indikator"
                            value="{{ old('nama') }}"
                            required>
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Icon -->
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <div class="input-group">
                            <button type="button"
                                    class="btn btn-outline-secondary"
                                    id="iconpicker"
                                    role="iconpicker"
                                    data-icon="{{ old('icon', 'fas fa-question') }}"></button>
                            <input type="hidden" name="icon" id="icon" value="{{ old('icon', 'fas fa-question') }}">
                            <span class="input-group-text">
                                <i id="icon-preview" class="{{ old('icon', 'fas fa-question') }}"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Flag -->
                    <div class="mb-3">
                        <label for="flag" class="form-label">Flag</label>
                        <select name="flag" id="flag" class="form-select @error('flag') is-invalid @enderror">
                            <option value="1" {{ old('flag', 1) == 1 ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ old('flag', 1) == 0 ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                        @error('flag')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"
        integrity="sha512-rD2o9vqjwr+ZC3AFrN4X0wZkUlRE0AXug+ajZ91DNY+bZp1eTvnI4CPKK2m6MYc6CbxNnJ4iGxG0MQdyefhP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Iconpicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(function() {
    // Inisialisasi iconpicker
    $('#iconpicker').iconpicker().on('change', function(e){
        $('#icon').val(e.icon); // update hidden input
        $('#icon-preview').attr('class', e.icon); // update preview icon
    });

    // Inisialisasi select2 (jika diperlukan)
    $('#multiple-select-clear-field, #multiple-select-clear-field2').select2({
        theme: "bootstrap-5",
        width: '100%',
        placeholder: "Choose anything",
        closeOnSelect: false,
        allowClear: true,
    });
});
</script>
@endpush
