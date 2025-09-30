@extends('layouts/app')
@section('stylecss')

<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="page-inner">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h2 class="fw-bold mb-3">Form Isi Data</h2>
        <h6 class="op-7 mb-2">
            Form untuk menambahkan data strategis ke dalam sistem.
        </h6>

        <form action="{{ route('form.store') }}" method="POST">
            @csrf

        <!-- Data Strategis -->
            <div class="mb-3">
                <label for="id_data" class="form-label">Indikator
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_data" name="id_data" required>
                    <option value="" disabled selected hidden>Pilih Indikator</option>
                    @foreach ($dataStrategis as $item)
                    <option value="{{ $item->id_data }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('id_data')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nilai Data -->
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai Data
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Masukkan nilai data"
                    required>
                @error('nilai')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Satuan -->
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan satuan data"
                    required>
                @error('satuan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Periode -->
            <div class="mb-3">
                <label for="periode" class="form-label">Periode
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="periode" name="periode" placeholder="Masukkan periode data"
                    required>
                @error('periode')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Link Publikasi -->
            <div class="mb-3">
                <label for="link_publikasi" class="form-label">Link Publikasi
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="link_publikasi" name="link_publikasi" placeholder="Masukkan Link Publikasi"
                    required>
                @error('link_publikasi')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-form-input">Kirim</button>
        </form>
    </div>
</div>
@endsection

{{-- Convert Nominal to Numbers in Form --}}
@section('script')
<script>
    function formatNumber(input) {
        let value = input.value.replace(/\D/g, '');
        input.value = new Intl.NumberFormat('id-ID').format(value);
    }

    document.getElementById('nominal').addEventListener('input', function() {
        formatNumber(this);
    });

    $('.btn-form-input').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');

        let nominalInput = document.getElementById('nominal');
        nominalInput.value = nominalInput.value.replace(/\D/g, '');
        form.submit();
    });
</script>
@endsection

{{-- Convert to Rupiah in Modal View --}}
@push('scripts')
<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number).replace(/\s+/g, "");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const nominalElements = document.querySelectorAll('.nominal-currency');
        nominalElements.forEach(element => {
            const rawValue = element.textContent;
            element.textContent = formatRupiah(rawValue);
        });
    });
</script>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush

@push('scripts')
<script>

    $(document).ready(function() {
        $('#id_data').select2({
            allowClear: false,
            theme: 'bootstrap-5'
        });
    });
</script>
@endpush