<header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">SATRIA BPS Tulungagung</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{route('home')}}#hero" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    
                    <li><a href="{{route('home')}}#about" class="{{ request()->is('#about') ? 'active' : '' }}">Data Strategis</a></li>
                    <li><a href="{{route('data.index')}}" class="{{ request()->routeIs('data.index') ? 'active' : '' }}">Download Data Strategis</a></li>
                    <!--<li><a href="{{ route('chatbot') }}" class="{{ request()->routeIs('chatbot') ? 'active' : '' }}">Chatbot</a></li>-->
                    
                    
                    @if (auth()->user())
                    <li><a href="/dashboard/">Dashboard</a></li>
                    @else
                    <!--<li>
                        <div class="d-flex p-2.5">
                            <a href="{{ route('login') }}" class="btn-login fw-semibold px-6 rounded-full hover:bg-orange-600 transition-colors">   Login   </a>
                        </div>
                    </li>-->
                    @endif


                </ul>
                
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>