<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
    @include('layouts_page.menu_css')
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="{{route('page.index')}}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="{{ route('contact.image', 1) }}?{{rand(0, 1000)}}" alt="Logo">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        <a class="nav-link" href="index.html#about">Inicio</a>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>Personales</span>
                            <i class="fas fa-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            @foreach ($personals as $personal)
                            <li>
                                <a href="#">{{$personal->name ?? ''}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>Empresariales</span>
                            <i class="fas fa-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            @foreach ($businesses as $business)
                            <li>
                                <a href="#">{{$business->name ?? ''}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="blog.html">Blog</a></li>
                    <li>
                        <a class="nav-link scrollto" href="index.html#contact">Contacto</a>
                    </li>
                </ul>
                <i class="fas fa-bars mobile-nav-toggle d-none"></i>
            </nav>
            <!-- .navbar -->

            <a class="btn-getstarted scrollto" href="index.html#about">Quitar</a>
        </div>
    </header>
    <!-- End Header -->

    @yield('content_page')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <img src="{{ route('contact.image', 1) }}?{{rand(0, 1000)}}" alt="Logo">
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Enlaces Útiles</h4>
                        <ul>
                            <li>
                                <i class="fas fa-chevron-right"></i>
                                <a href="#">Inicio</a>
                            </li>
                            <li>
                                <i class="fas fa-chevron-right"></i>
                                <a href="#">Blog</a>
                            </li>
                            <li>
                                <i class="fas fa-chevron-right"></i>
                                <a href="#">Contacto</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Soluciones</h4>
                        <ul>
                            <li>
                                <i class="fas fa-chevron-right"></i>
                                <a href="#">Personales</a>
                            </li>
                            <li>
                                <i class="fas fa-chevron-right"></i>
                                <a href="#">Empresariales</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h4>Contáctanos</h4>
                        <div class="footer-info">
                            <p>
                                {{ $contact->address }} <br />
                                Medellín, Colombia<br /><br />
                                <strong>Celular:</strong> {{$contact->mobile}}<br />
                                <strong>Email:</strong> {{$contact->email}}<br />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-legal text-center">
            <div
                class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div class="copyright">
                        &copy; Copyright
                        <strong><span>{{ $contact->name ?? ''}}</span></strong>. Todos los derechos reservados
                    </div>
                    <div class="credits">
                        Powered by
                        <a href="https://bootstrapmade.com/">Manuel Buriticá🚀</a>
                    </div>
                </div>

                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    @foreach ($networks as $network)
                    <a href="{{ $network->link ?? ''  }}" target="_blank">
                        <i class="{{ $network->icon ?? '' }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="fas fa-long-arrow-alt-up"></i>
    </a>

    <div id="preloader"></div>

    @include('layouts_page.menu_js')
    @yield('javascript')
</body>

</html>