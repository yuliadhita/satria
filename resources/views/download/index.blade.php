@extends('layouts.app')
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
        <!-- Heading & Filter -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Data Strategis</h2>
                <h6 class="op-7 mb-2">Lihat dan kelola data strategis yang telah diinput</h6>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('download.index') }}">
            <div class="d-flex justify-content-between">
                <div class="mb-3" style="flex: 1; margin-right: 20px">
                    <label for="tanggalInput" class="form-label">Tanggal Input Data</label>
                    <input type="date" class="form-control" name="tanggal_inpit" id="tanggalInput" value="{{ request('tanggal_mulai') }}" />
                </div>
                <div class="mb-3" style="flex: 1">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir Kegiatan</label>
                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggalAkhir" value="{{ request('tanggal_akhir') }}" />
                </div>
            </div>

            <div class="mb-3">
                <label for="dataStrategis" class="form-label">Indikator</label>
                <select class="form-select" name="dataStrategis" id="dataStrategis" style="max-width: 618px">
                    <option value="">Pilih Indikator</option>
                    @foreach($dataStrategis as $item)
                    <option value="{{ $item->nama }}" {{ request('dataStrategis') == $item->nama ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-round">Filter</button>
        </form>

        <!-- Tabel Monitoring dengan Check All -->
        <form method="POST" action="{{ route('download.proses') }}">
            @csrf
            <div class="col-md-12 mt-4">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Tabel Data Strategis</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" style="transform: scale(1.5);" /></th>
                                        <th>No.</th>
                                        <th>Indikator</th>
                                        <th>Nilai</th>
                                        <th>Satuan</th>
                                        <th>Periode</th>
                                        <th>Link Publikasi</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formData as $index => $item)
                                    <tr>
                                        <td><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="form-check-input" style="transform: scale(1.5);" /></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-end">{{ $item->dataStrategis->nama }}</td>
                                        <td class="text-start">{{ $item->nilai }}</td>
                                        <td class="text-start">{{ $item->satuan }}</td>
                                        <td class="text-start">{{ $item->periode }}</td>
                                        <td class="text-start">{{ $item->link_publikasi }}</td>
                                        <td class="text-start">{{ $item->tanggal_input }}</td>
                                        <td>
                                    <div class="grid">
                                    <div class="d-flex">
                                    <a href="{{ route('form.edit', $item->id) }}" class="btn btn-info btn-sm " 
                                            style="display: flex;
                                            align-items: center; 
                                            justify-content: center;  
                                            height: auto;
                                            margin-top: 3px;
                                            margin-bottom: 3px;  
                                            padding: 5px 10px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center mt-3 flex-nowrap">
                <div class="me-4 d-flex align-items-center flex-nowrap">
                    <label for="format" class="form-label me-2 mb-0" style="white-space: nowrap;">Format File</label>
                    <select class="form-select" name="format" id="format" style="max-width: 100px;">
                        <option value="csv">CSV</option>
                        <option value="xlsx">XLSX</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-warning btn-round">Download yang dipilih</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript untuk Check All -->
<script>
    document.getElementById('checkAll').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
    });
</script>
@endsection

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
        $('#akun').select2({
            allowClear: false,
            theme: 'bootstrap'
        });
    });
</script>
@endpush

