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
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('page.index')}}">
                            <img src="{{ route('contact.image', $contact->id) }}?{{rand(0, 1000)}}" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{route('page.index')}}">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll dd-menu collapsed" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-2"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation">@lang('base_lang.solutions')</a>

                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><a href="service-1.html">Personales</a></li>
                                        <li class="nav-item"><a href="#0">Empresariales</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{route('blog.index')}}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="contact.html">@lang('base_lang.contact')</a>
                                </li>
                            </ul>
                            <div class="search-form">
                                <div class="footer-social-links">
                                    <ul class="d-flex">
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

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    @yield('content_page')

    <footer class="footer pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInLeft" data-wow-delay=".2s">
                        <a href="{{route('page.index')}}" class="logo mb-30">
                            <img src="{{ route('contact.image', $contact->id) }}?{{rand(0, 1000)}}" alt="logo"
                                style="max-width: 300px;">
                        </a>
                        <p class="mb-30 footer-desc">{{$contact->description ?? ''}}</p>
                    </div>
                </div>
                <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInUp" data-wow-delay=".4s">
                        <h4>@lang('base_lang.menu')</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="{{route('page.index')}}">@lang('base_lang.home')</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">@lang('base_lang.solutions')</a>
                            </li>
                            <li>
                                <a href="{{route('blog.index')}}">@lang('base_lang.posts')</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">@lang('base_lang.contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInUp" data-wow-delay=".6s">
                        <h4>@lang('base_lang.solutions')</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="javascript:void(0)">Marketing</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Branding</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Web Design</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Graphics Design</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget mb-60 wow fadeInRight" data-wow-delay=".8s">
                        <h4>@lang('base_lang.contact')</h4>
                        <ul class="footer-contact list-unstyled">
                            <li>
                                <p>{{$contact->phone ?? ''}}</p>
                            </li>
                            <li>
                                <p>{{$contact->mobile ?? ''}}</p>
                            </li>
                            <li>
                                <p>{{$contact->email ?? ''}}</p>
                            </li>
                            <li>
                                <p>{{$contact->address ?? ''}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="copyright-area">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="footer-social-links">
                            <ul class="d-flex">
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
                            <a href="https://GrayGrids.com" rel="nofollow">
                                Manuel Buriticá🚀
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="fas fa-long-arrow-alt-up"></i>
    </a>

    @include('layouts_page.menu_js')
    @yield('javascript')
</body>

</html>