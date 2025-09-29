@extends('layouts/app')
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
                    type: 'bar',
                    data: {
                        labels: ['Jumlah Data'],
                        datasets: [{
                            label: 'Indikator',
                            backgroundColor: '#0dcaf0',
                            data: [Number({{ $data['totalIndikator'] }})],
                            barPercentage: 0.8
                        }, {
                            label: 'Data Strategis',
                            backgroundColor: '#ffc107',
                            data: [Number({{ $data['totalData'] }})],
                            barPercentage: 0.8
                        }]

                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        },
                        scales: {
                            y: {
                                min: 0,
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            },
                             x: {
                                stacked: false    // <--- ini penting biar batang tidak numpuk
                            }
                        }
                    }
                });
            });
        </script>

        <style>
            .dot {
                height: 10px;
                width: 10px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 5px;
            }
        </style>
        @endpush
    </div>
</div>
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
