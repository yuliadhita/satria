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
                    <label for="tanggalInput" class="form-label">Tanggal Input Data Awal</label>
                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggalMulai" value="{{ request('tanggal_mulai') }}" />
                </div>
                <div class="mb-3" style="flex: 1">
                    <label for="tanggalAkhir" class="form-label">Tanggal Input Data Akhir</label>
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
                                                <div class="d-flex justify-content-end">
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-info btn-sm d-flex align-items-center justify-content-center" 
                                                            style="height: auto; margin-top: 3px; margin-bottom: 3px; padding: 5px 10px;"
                                                            onclick="window.location='{{ route('form.edit', $item->id) }}'"
                                                            title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button with Modal Trigger -->
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModalCenter-{{ $item->id }}" 
                                                            title="Hapus Data" 
                                                            style="height: auto; margin-top: 3px; margin-bottom: 3px; padding: 5px 10px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
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

<!-- Modal Delete -->
@section('modal-delete')
@foreach ($formData as $item)
<div class="modal fade" id="deleteModalCenter-{{ $item->id }}" tabindex="-1" 
     aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $item->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.
            </div>
            <div class="modal-footer">
                <!-- Batal Button -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                <!-- Hapus Button -->
                <form action="{{ route('form.delete', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
<!-- End Modal Delete -->
<!-- Script Section -->
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
    // Mengecek apakah DataTable sudah diinisialisasi
    if (!$.fn.dataTable.isDataTable('#example')) {
        $('#example').DataTable({
            "ordering": true, // Mengaktifkan sorting di kolom lainnya
            "columnDefs": [
                {
                    "targets": 0,  // Kolom pertama (checkbox)
                    "orderable": false, // Menonaktifkan sorting di kolom ini
                },
                {
                    "targets": '_all',  // Semua kolom lainnya diizinkan untuk sorting
                    "orderable": true,  // Menyortir kolom lainnya
                }
            ]
        });
    }
});

</script>

<script>
    
    $(document).ready(function() {
        $('#dataStrategis').select2({
            allowClear: false,
            theme: 'bootstrap'
        });
    });
</script>
@endpush

