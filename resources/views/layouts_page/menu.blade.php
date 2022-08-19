<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
    @include('layouts_page.menu_css')
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{route('page.index')}}" class="logo d-flex align-items-center">
                <img src="{{ route('contact.image', $contact->id) }}?{{rand(0, 1000)}}" alt="Logo">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#values">
                            <span>Soluciones</span>&nbsp;
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul>
                            <li><a href="#">Personales</a></li>
                            <li><a href="#">Empresariales</a></li>
                        </ul>
                    </li>
                    <li><a href="#recent-blog-posts">Blog</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contacto</a></li>
                </ul>
                <i class="fas fa-bars mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('content_page')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="#" class="logo d-flex align-items-center">
                            <img src="{{ route('contact.image', $contact->id) }}?{{rand(0, 1000)}}" alt="">
                        </a>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Enlaces útiles</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Inicio</a></li>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Soluciones</a></li>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Blog</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Soluciones</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Empresariales</a></li>
                            <li><i class="fas fa-chevron-right"></i> <a href="#">Personales</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contáctanos</h4>
                        <p>
                            {{ $contact->address }} <br>
                            Medellín, Antioquia <br>
                            Colombia <br><br>
                            <strong>Celular:</strong> {{$contact->mobile}}<br>
                            <strong>Email:</strong> {{$contact->email}}<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright-area">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="footer-social-links">
                            <ul class="d-flex p-0">
                                @foreach ($networks as $network)
                                <li>
                                    <a href="{{$network->link}}" target="_blank">
                                        <i class="{{$network->icon}}"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            Powered by
                            <a href="" rel="nofollow">
                                Manuel Buriticá🚀
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'>
        </script>
        <script>
            var wa_btnSetting = {"btnColor":"#16BE45","ctaText":"","cornerRadius":40,"marginBottom":20,"marginLeft":20,"marginRight":20,"btnPosition":"right","whatsAppNumber":"573128936026","welcomeMessage":"Hello","zIndex":999999,"btnColorScheme":"light"};
            window.onload = () => {
                _waEmbed(wa_btnSetting);
            };
        </script>


    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="fas fa-long-arrow-alt-up"></i>
    </a>

    @include('layouts_page.menu_js')
    @yield('javascript')
</body>

</html>