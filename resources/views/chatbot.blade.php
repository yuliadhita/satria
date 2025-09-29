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
.chatbot-page #header {
  background-color: #09024f; /* warna yang sama kayak saat scroll */
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

<body class="chatbot-page">

    <x-header />

    <main class="main">

        
        <!-- Chatbot Section -->
        <section id="chatbot" class="chatbot section py-20 bg-light ">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                <div id="chatbot-app" class="w-100">
                                    <!-- Tempat chatbot akan dimuat -->
                                    <!-- Tempat Chatbot -->
                                    <div id="chatbot-root" class="w-100"></div>

                                    <!-- Panggil file Chatbot -->
                                    <script type="text/babel" src="{{ asset('assets/js/Chatbot.js') }}"></script>

                                    <script type="text/babel">
                                    const root = ReactDOM.createRoot(document.getElementById('chatbot-root'));
                                    root.render(<Chatbot />);
                                    </script>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</body>

</html>
