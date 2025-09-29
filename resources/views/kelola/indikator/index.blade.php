@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Kelola Indikator</h2>
                <h6 class="op-7 mb-2">Kelola indikator yang akan tampil di sistem</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('kelola.indikator.create') }}" class="btn btn-primary btn-round">Tambah Indikator</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Daftar Indikator</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Indikator</th>
                                    <th>Icon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataStrategis as $dataStrategis)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="text-end">{{ $dataStrategis->nama }}</td>
                                    <td class="text-start">
                                        <i class="{{ $dataStrategis->icon }}"></i>
                                    </td>
                                    <td>
                                    <div class="grid">
                                    <div class="d-flex">
                                    <div class="btn-group dropdown me-2">
                                        <button
                                            class="btn {{ $dataStrategis->flag == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            data-id="{{ $dataStrategis->id }}"
                                            data-flag="{{ $dataStrategis->flag }}"
                                            data-akun="{{ $dataStrategis->nama }}">
                                            {{ $dataStrategis->flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                @if($dataStrategis->flag != 1)
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $dataStrategis->id }}" data-flag="1" data-akun="{{ $dataStrategis->nama }}">Tampilkan</button>
                                                @else
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $dataStrategis->id }}" data-flag="0" data-akun="{{ $dataStrategis->nama }}">Jangan Tampilkan</button>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('kelola.indikator.edit', $dataStrategis->id_data) }}" class="btn btn-info btn-sm " 
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
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <b><span id="modal-action-text"></span></b> akun <b><span id="modal-akun-belanja"></span></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <form id="modalForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="flag" id="modal-flag">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModal = document.getElementById('confirmModal');
        const modalForm = confirmModal.querySelector('#modalForm');
        const modalActionText = confirmModal.querySelector('#modal-action-text');
        const modalAkun = confirmModal.querySelector('#modal-akun-belanja');
        const modalFlag = confirmModal.querySelector('#modal-flag');

        const updateFlagRoutePattern = "{{ route('kelola.indikator.updateFlag', ':id') }}";

        confirmModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const flag = button.getAttribute('data-flag');
            const akun = button.getAttribute('data-akun');

            const actionText = flag == "1" ? "menampilkan" : "tidak menampilkan";

            modalActionText.textContent = actionText;
            modalFlag.value = flag;
            modalAkun.textContent = akun;
            modalForm.action = updateFlagRoutePattern.replace(':id', id);
        });
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