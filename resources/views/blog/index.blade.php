@extends('layouts_page.menu')

@section('title', __('base_lang.posts'))

@section('content_page')

<section class="page-banner-section img-bg" style=" background-image: url('{{asset('img/common-bg.svg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    {{-- <h2 class="text-white">Single Blog</h2> --}}
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="margin-bottom: 0px !important">
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="javascript:void(0)">@lang('base_lang.posts')</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="left-side-wrapper">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="single-blog mb-40 wow fadeInUp" data-wow-delay=".2s"
                                style="visibility: visible; animation-name: fadeInUp; -webkit-animation-duration: 2s;-moz-animation-duration: 2s;animation-duration: 2s;">
                                <div class="blog-img">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <img src="{{ route('post.image', $post->id) }}?{{rand(0, 1000)}}" alt="">
                                    </a>
                                    <span class="date-meta">{{getCurrentDate($post->created_at)}}</span>
                                </div>
                                <div class="blog-content">
                                    <h4><a href="{{ route('blog.show', $post->slug) }}">{{$post->title}}</a></h4>
                                    <p>{{$post->description}}</p>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="read-more-btn">
                                        Leer más <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="wow fadeInUp" data-wow-delay=".3s"
                        style="visibility: visible; animation-name: fadeInUp; -webkit-animation-duration: 3s;-moz-animation-duration: 3s;animation-duration: 3s;">
                        {{$posts->links()}}
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar-wrapper">
                    <div class="sidebar-box search-form-box mb-30">
                        <form action="#" class="search-form">
                            <input type="text" placeholder="Buscar">
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>
                    <div class="sidebar-box recent-blog-box mb-30">
                        <h4>Noticias Recientes</h4>
                        <div class="recent-blog-items">
                            @foreach ($recent_posts as $recent_post)
                            <div class="recent-blog mb-30">
                                <div class="recent-blog-img">
                                    <img src="{{ route('post.image', $recent_post->id) }}?{{rand(0, 1000)}}" alt="">
                                </div>
                                <div class="recent-blog-content">
                                    <h5>
                                        <a href="{{ route('blog.show', $recent_post->slug) }}">
                                            {{$recent_post->title}}
                                        </a>
                                    </h5>
                                    <span class="date">{{getCurrentDate($recent_post->created_at)}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-box catagories-box mb-30">
                        <h4>Categorías</h4>
                        <ul>
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ url("/blog?q[category_id][]=$category->id") }}">
                                    <span>{{$category->option}}</span>
                                    <span class="ms-2">{{$category->post_counter}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-box">
                        <h4>¡Síguenos!</h4>
                        <div class="footer-social-links">
                            <ul class="d-flex justify-content-start">
                                @foreach ($networks as $network)
                                <li>
                                    <a href="{{$network->link}}">
                                        <i class="{{$network->icon}}"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="client-logo-section pt-50 pb-50">
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

@endsection