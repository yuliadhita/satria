<header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">SATRIA BPS Tulungagung</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    
                    <li><a href="#about">Data Strategis</a></li>
                    <li><a href="{{ route('chatbot') }}">Chatbot</a></li>
                    <!-- <li>
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class="btn-get-started fw-semibold">Login</a>
                        </div>
                    </li> -->
                    
                    @if (auth()->user())
                    <li><a href="/dashboard/">Dashboard</a></li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>