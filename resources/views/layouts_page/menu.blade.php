<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$information->name ?? ''}} @yield('title')</title>
    <meta content="Somos una agencia de seguros en Medellín respaldada por SURA y otras compañías. Protegemos lo que más quieres y los que te quieren. Contáctanos para más información." name="description">
    <meta content="" name="keywords">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/icon.png')}}">

    @include('layouts_page.menu_css')
</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <div class="logo">
                    <a href="{{route('page.index')}}">
                        <img src="{{ route('information.image', 1) }}?{{rand(0, 1000)}}" alt="Logo" class="img-fluid" width="75%">
                    </a>
                </div>
            </div>

            <div class="d-none d-md-flex align-items-center social-links">
                @foreach ($networks as $network)
                <a href="{{ $network->link ?? ''  }}" target="_blank">
                    <i class="{{ $network->icon ?? '' }}"></i>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <a href="{{route('page.index')}}" class="d-none" id="blank_logo">
                    <img src="{{asset('img/logo-Buriseguros-Sura - blank.png')}}" alt="Logo" class="img-fluid">
                </a>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="{{route('page.index')}}">Inicio</a></li>
                    @foreach ($solutions as $key => $solution)
                    <li class="dropdown">
                        <a href="#">
                            <span>{{ $solution->name ?? '' }}</span>&nbsp;
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul>
                            @foreach ($solution->insurances as $type)
                            <li>
                                <a href="{{-- {{ route('insurance.page', $type->slug) }} --}}#">
                                    {{$type->name ?? ''}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                    <li><a class="nav-link scrollto" href="#contact">Contacto</a></li>
                </ul>
                <i class="fas fa-bars mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    @yield('content_page')

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-contact">
                        <img src="{{ route('information.image', 1) }}?{{rand(0, 1000)}}" alt="Logo">
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Enlaces Útiles</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right"></i> <a href="{{route('page.index')}}">Inicio</a></li>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Contacto</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Soluciones</h4>
                        <ul>
                            @foreach ($solutions as $key => $solution)
                            <li><i class="fas fa-chevron-right"></i> <a href="#">{{ $solution->name ?? '' }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Contáctanos</h4>
                        <p>
                            {{ $information->address }} <br />
                            Medellín, Colombia<br /><br />
                            <strong>Celular:</strong> {{$information->mobile}}<br />
                            <strong>Email:</strong> {{$information->email}}<br />
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-lg-flex py-4">

            <div class="me-lg-auto text-center text-lg-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>{{ $information->name ?? '' }}</span></strong>. Todos los derechos reservados
                </div>
                <div class="credits">
                    Powered by <a href="https://bootstrapmade.com/">Manuel Buriticá🚀</a>
                </div>
            </div>
            <div class="social-links text-center text-lg-right pt-3 pt-lg-0">
                @foreach ($networks as $network)
                <a href="{{ $network->link ?? ''  }}" target="_blank">
                    <i class="{{ $network->icon ?? '' }}"></i>
                </a>
                @endforeach
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="fas fa-long-arrow-alt-up"></i>
    </a>

    <div id="preloader"></div>

    @include('layouts_page.menu_js')
    @yield('javascript')
</body>

</html>