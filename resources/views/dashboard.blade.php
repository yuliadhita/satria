@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard Admin</h3>
                <h6 class="op-7 mb-2">Lihat ringkasan data strategis yang telah diinput</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-light bubble-shadow-small">
                                    <i class="fa fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Indikator</p>
                                    <h4 class="card-title">{{ $data['totalIndikator'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fa fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Data</p>
                                    <h4 class="card-title">{{ $data['totalData'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Data Strategis -->
        <div class="row justify-content-center">
            <div class="col-md-10 center">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Statistik Data Strategis</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            $(document).ready(function() {
                var ctx = document.getElementById('statisticsChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar', // Menggunakan Bar Chart
                    data: {
                        labels: ['Indikator', 'Data Strategis'], // Menampilkan kedua kategori pada sumbu X
                        datasets: [{
                            label: 'Indikator', // Label pertama
                            backgroundColor: '#0dcaf0', // Warna untuk data pertama
                            data: [{{ $data['totalIndikator'] }}, 0], // Data untuk Indikator, Data Strategis = 0
                            borderWidth: 1, // Lebar border untuk batang
                            barThickness: 30, // Menyesuaikan ketebalan batang
                            categoryPercentage: 0.5, // Menjaga batang berada di tengah
                            barPercentage: 0.8, // Menyelaraskan batang di tengah
                        }, {
                            label: 'Data Strategis', // Label kedua
                            backgroundColor: '#ffc107', // Warna untuk data kedua
                            data: [0, {{ $data['totalData'] }}], // Data untuk Data Strategis, Indikator = 0
                            borderWidth: 1, // Lebar border untuk batang
                            barThickness: 30, // Menyesuaikan ketebalan batang
                            categoryPercentage: 0.5, // Menjaga batang berada di tengah
                            barPercentage: 0.8, // Menyelaraskan batang di tengah
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Agar chart responsif
                        plugins: {
                            legend: {
                                display: true, // Menampilkan legenda di bawah chart
                                position: 'bottom' // Posisi legend
                            }
                        },
                        scales: {
                            y: {
                                min: 0, // Sumbu Y dimulai dari 0
                                beginAtZero: true, // Memastikan sumbu Y dimulai dari nol
                                ticks: {
                                    stepSize: 1 // Menentukan langkah angka pada sumbu Y
                                }
                            },
                            x: {
                                stacked: false, // Agar batang chart tidak tumpang tindih
                            }
                        }
                    }
                });
            });
        </script>
        @endpush
    </div>
</div>
@endsection
