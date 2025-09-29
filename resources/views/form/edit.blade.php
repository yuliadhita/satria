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

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h2 class="fw-bold mb-3">Edit Form</h2>
                    <h6 class="op-7 mb-2">Edit Form Registrasi Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('monitoring.operator.index') }}" class="btn btn-danger btn-round">Kembali</a>
                </div>
            </div>

            <form action="{{ route('form.update', $fp->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nomor Form Pengajuan -->
                <div class="mb-3">
                    <label for="no_fp" class="form-label">Nomor FP
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="no_fp" name="no_fp" placeholder="Masukkan nomor FP"
                        value="{{ $fp->no_fp }}" disabled>
                    @error('no_fp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Rincian Output -->
                <div class="mb-3">
                    <label for="id_output" class="form-label">Rincian Output
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="id_output" name="id_output" required>
                        <option value="" disabled selected hidden>Pilih Rincian Output</option>
                        @foreach ($output as $item)
                            <option value="{{ $item->id }}"
                                {{ $fp->id_output == $item->id ? 'selected' : '' }}>
                                {{ $item->output }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_output')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Komponen -->
                <div class="mb-3">
                    <label for="id_komponen" class="form-label">Komponen
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="id_komponen" name="id_komponen" required>
                        <option value="" disabled selected hidden>Pilih Komponen</option>
                        @foreach ($komponen as $item)
                            <option value="{{ $item->id }}"
                                {{ $fp->id_komponen == $item->id ? 'selected' : '' }}>
                                {{ $item->komponen }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_komponen')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Sub Komponen -->
                <div class="mb-3">
                    <label for="kode_subkomponen" class="form-label">Sub Komponen
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="id_subkomponen" name="id_subkomponen" required>
                        <option value="" disabled selected hidden>Pilih Sub Komponen</option>
                        @foreach ($subKomponen as $item)
                            <option value="{{ $item->id }}"
                                {{ $fp->id_subkomponen == $item->id ? 'selected' : '' }}>
                                {{ $item->sub_komponen }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_subkomponen')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Akun Belanja -->
                <div class="mb-3">
                    <label for="kode_akun" class="form-label">Akun
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="id_akun_belanja" name="id_akun_belanja" required>
                        <option value="" disabled selected hidden>Pilih Akun</option>
                        @foreach ($akunBelanja as $item)
                            <option value="{{ $item->id }}"
                                {{ $fp->id_akun_belanja == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_akun }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_akun_belanja')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tanggal Mulai Kegiatan -->
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai Kegiatan
                        <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                        value="{{ $fp->tanggal_mulai }}" required>
                    @error('tanggal_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tanggal Akhir Kegiatan -->
                <div class="mb-3">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir Kegiatan
                        <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                        value="{{ $fp->tanggal_akhir }}" required>
                    @error('tanggal_akhir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nomor SK/Surat Tugas -->
                <div class="mb-3">
                    <label for="no_sk" class="form-label">Nomor SK/Surat Tugas
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Masukkan nomor SK"
                        value="{{ $fp->no_sk }}" required>
                    @error('no_sk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Uraian/Nama Permintaan -->
                <div class="mb-3">
                    <label for="uraian" class="form-label">Uraian
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Masukkan uraian"
                        value="{{ $fp->uraian }}" required>
                    @error('uraian')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nominal -->
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="nominal" name="nominal"
                            placeholder="Masukkan nominal" value="{{ old('nominal', $fp->nominal) }}"
                            oninput="formatNumber(this)" required>
                    </div>
                    @error('nominal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-form-edit">Ubah</button>
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

        $('.btn-form-edit').on('click', function(e) {
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
