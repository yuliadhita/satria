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
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

<!-- Custom CSS -->
<style>
/* Flexbox container for alignment */


  .swiper {
    position: relative;
    padding: 40px 0;
  }

  .icon-box {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  /* Custom tombol navigasi */
  .custom-btn {
    background: #103071;
    color: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.3s;
  }

  .custom-btn::after {
    font-size: 18px;
    font-weight: bold;
  }

  .custom-btn:hover {
    background: #0d2558;
    transform: scale(1.1);
  }

  /* Posisi tombol di tengah vertikal */
  .swiper-button-next,
  .swiper-button-prev {
    top: 50%;
    transform: translateY(-50%);
    
  }

  .swiper-button-prev {
    left: 0px; /* Bisa diatur sesuai layout */
  }

  .swiper-button-next {
    right: 0px; /* Bisa diatur sesuai layout */
  }

  .swiper-button-next,
.swiper-button-prev {
  top: 50%;
  transform: translateY(-50%);
  opacity: 1 !important;
  visibility: visible !important;
  display: flex !important;
  z-index: 20; /* biar selalu di atas */
}

.swiper-button-next.custom-btn,
.swiper-button-prev.custom-btn {
  background: #103071;
  color: #fff;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: 0.3s;
}

.swiper-button-next.custom-btn:hover,
.swiper-button-prev.custom-btn:hover {
  background: #0d2558;
  transform: translateY(-50%) scale(1.1);
}


</style>
    <!-- <style>
        .icon-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 200px;
            /* Tinggi konsisten */
            text-align: center;
            transition: transform 0.3s;
        }

        .icon-box h3 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #051c48;
            /* Warna teks */
        }

        .icon-box p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .icon-box:hover {
            transform: translateY(-5px);
        }

        /* Atur spacing antar box */
        .row .col-md-6 {
            margin-bottom: 20px;
        }
    </style> -->
</head>

<body class="index-page">

    <x-header />

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

            <div class="container px-4">
                <div class="row gy-4 justify-content-between">
                    
                    <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                        <h1>Statistik <span>Tulungagung </span>Terintegrasi dan Andal</h1>
                        <p>Temukan informasi terkait statistik Kabupaten Tulungagung dengan mudah disini</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started fw-semibold">Data Strategis</a>
                        </div>
                    </div>
                </div>
            </div>

            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3"></use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0"></use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->



        <!-- About Section -->
<section id="about" class="about section">
  <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center gy-4">

      <!-- About Content -->
      <div class="row mb-4">
        <div class="col-lg-12 text-center">
          <div class="content">
            <!--<h3>About Us</h3>-->
            <h2 class="fw-bold display-6">Data Strategis Kabupaten Tulungagung</h2>
          </div>
        </div>

        <!-- Grid Box -->
        <div class="row mt-4">
          @foreach($indikator as $item)
            @if($item->latestFormData)
              <div class="col-12 col-md-6 col-lg-4 mb-4">
                <a href="{{ $item->latestFormData->link_publikasi }}" class="w-full d-block">
                  <div class="icon-box text-center p-4 bg-white rounded-xl shadow hover:shadow-lg transition h-100">
                    <i class="{{ $item->icon }} text-primary-4 text-4xl mb-3"></i>
                    <h3 class="font-bold text-lg">{{ $item->nama }}</h3>
                    <p class="text-gray-600 text-sm">
                      {{ $item->latestFormData->nilai }} {{ $item->latestFormData->satuan }}
                      ({{ $item->latestFormData->periode }})
                    </p>
                  </div>
                </a>
              </div>
            @endif
          @endforeach
        </div>

      </div>
    </div> <!-- End Main Row -->
  </div> <!-- End Container -->
</section> <!-- /About Section -->
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
        loopAdditionalSlides: 4,
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
        320: {
            slidesPerView: 1, // 1 slide per view untuk layar kecil
            spaceBetween: 10, // Space lebih kecil di layar kecil
        },
        640: {
            slidesPerView: 1, // 1 slide per view
            spaceBetween: 20, // Space lebih besar di layar menengah
        },
        1024: {
            slidesPerView: 2, // 2 slide per view untuk layar besar
            spaceBetween: 30, // Space antar slide
        },
        1280: {
            slidesPerView: 3, // 3 slide per view untuk layar lebih besar
            spaceBetween: 40, // Space antar slide
        }
    },
    });
    </script>
</body>

</html>
