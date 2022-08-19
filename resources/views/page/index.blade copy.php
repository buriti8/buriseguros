@extends('layouts_page.menu')

@section('title', __('base_lang.home'))

@section('content_page')

<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="hero-content-wrapper">
                    <h2 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Buriseguros</h2>
                    <h1 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Multipurpose Website Template</h1>
                    <p class="mb-35 wow fadeInLeft" data-wow-delay=".4s">At vero eos et accusamus et iusto odio
                        dignissimos ducimus quiblanditiis praesentium</p>
                    <a href="javascript:void(0)" class="theme-btn">Get Started</a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="hero-img">
                    <div class="d-inline-block hero-img-right">
                        <img src="{{asset('img/hero-img.png')}}" alt="" class="image wow fadeInRight"
                            data-wow-delay=".5s">
                        <img src="{{asset('img/dots.shape.svg')}}" alt="" class="dot-shape">
                        <div class="video-btn">
                            <a href="https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
                                class="glightbox"><i class="lni lni-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="client-logo-section pt-50">
    <div class="container">
        <div class="client-logo-wrapper">
            <div class="client-logo-carousel d-flex align-items-center justify-content-between  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                id="tns1" style="transform: translate3d(-76.1905%, 0px, 0px);">
                @foreach ($insurers as $insurer)
                <div class="client-logo">
                    <a href="{{ $insurer->link }}" target="_blank">
                        <img src="{{ route('insurer.image', $insurer->id) }}?{{rand(0, 1000)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="feature-section pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                <div class="section-title text-center mb-55">
                    <span class="wow fadeInDown" data-wow-delay=".2s">Soluciones</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">¿Qué solución deseas?</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">At vero eos et accusamus et iusto odio dignissimos
                        ducimus quiblanditiis praesentium</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($solutions as $solution)
            <div class="col-sm-12 col-md-6">
                <div class="feature-box box-style">
                    <div class="feature-icon box-icon-style">
                        <i class="{{ $solution->icon }}"></i>
                    </div>
                    <div class="box-content-style feature-content">
                        <h4>{{ $solution->name }}</h4>
                        <p>{{ $solution->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="service" class="service-section pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                <div class="section-title text-center mb-55">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Algunas de nuestras soluciones</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">
                        At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($insurances as $insurance)
            <div class="col-lg-4 col-md-6">
                <div class="service-box box-style">
                    <div class="service-icon box-icon-style">
                        <i class="{{ $insurance->icon ?? '' }}"></i>
                    </div>
                    <div class="box-content-style service-content">
                        <h4>{{ $insurance->name ?? '' }}</h4>
                        <p>{{ $insurance->description ?? '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="blog" class="blog-section pt-50 pb-50">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-sm-12">
                <div class="section-title text-center mb-60">
                    <span class="wow fadeInDown" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Blog</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        Noticias Recientes
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($recent_posts as $recent_post)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-blog mb-40 wow fadeInUp" data-wow-delay=".2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="blog-img">
                        <a href="{{ route('blog.show', $recent_post->slug) }}">
                            <img src="{{ route('post.image', $recent_post->id) }}?{{rand(0, 1000)}}" alt="Jaja">
                        </a>
                        <span class="date-meta">{{getCurrentDate($recent_post->created_at)}}</span>
                    </div>
                    <div class="blog-content">
                        <h4>
                            <a href="{{ route('blog.show', $recent_post->slug) }}">{{$recent_post->title}}</a>
                        </h4>
                        <p>{{$recent_post->description}}</p>
                        <a href="{{ route('blog.show', $recent_post->slug) }}" class="read-more-btn">
                            Leer más
                            <i class="lni lni-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection