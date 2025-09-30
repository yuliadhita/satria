<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Statistik Tulungagung Terintegrasi dan Andal</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('/assets/img/logo.png') }}" type="image/x-icon" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

     <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- React + ReactDOM + Babel -->
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chatbot.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="{{ asset('assets/js/dataTable.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>

<!-- Custom CSS -->
<style>
 
.data-page #header {
  background-color: #09024f; /* warna yang sama kayak saat scroll */
}


</style>
</head>

<body class="data-page">

    <x-header />

    <main class="main">

        
        <!-- Chatbot Section -->
        <section id="chatbot" class="chatbot section py-20 bg-light ">
           <div class="container py-3">
                    <div class="page-inner">
                        <!-- Heading & Filter -->
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                            <div>
                                <h2 class="fw-bold mb-3">Download Data Strategis</h2>
                            </div>
                        </div>

                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('data.index') }}">
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

                        <!-- Tabel Monitoring tanpa Kolom Aksi dan Tanggal Input -->
                        <form method="POST" action="{{ route('data.proses') }}">
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
                                            <table id="dataTable" class="table table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkAll" style="transform: scale(1.5);" /></th>
                                                        <th>No.</th>
                                                        <th>Indikator</th>
                                                        <th>Nilai</th>
                                                        <th>Satuan</th>
                                                        <th>Periode</th>
                                                        <th>Link Publikasi</th>
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

                <script>
                // Inisialisasi DataTable
                $(document).ready(function() {
                    $('#dataTable').DataTable();
                });
            </script>
        </section><!-- /Chatbot Section -->
    </main>

    <x-footer />

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- SwiperJS Init -->
    <script>

    const iconSwiper = new Swiper(".icon-swiper", {
        slidesPerView: 1,
        spaceBetween: 16,
        grabCursor: true,
        loop: true,
        centeredSlides: true,
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
        pagination: {
        el: ".icon-swiper-pagination",
        clickable: true,
        dynamicBullets: true,
        },
        autoplay: {
        delay: 3000, // geser tiap 3 detik
        disableOnInteraction: false, // tetap jalan meski user swipe manual
        },
        breakpoints: {
        640: { slidesPerView: 1 },
        1024: { slidesPerView: 2 },
        1280: { slidesPerView: 3 },
        }
    });
    </script>
    <!-- Datatables -->
    <script src="{{ asset('/assets/js/plugin/datatables/datatables.min.js') }}"></script>

</body>

</html>

