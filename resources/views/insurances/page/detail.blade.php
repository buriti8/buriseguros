@extends('layouts_page.menu')

@section('title', '| ' . __('base_lang.insurances'))

@section('content_page')

<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single">
                    <div class="entry-img text-center">
                        <img src="{{ route('insurance.image', $insurance->id) }}" alt="" class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                        {{ $insurance->name }}
                    </h2>

                    <div class="entry-content">
                        {!! $insurance->content !!}
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-12 ml-2">
                        <div class="sidebar p-0">
                            <div id="sel-widget"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-12 mt-4 ml-2">
                        <div class="sidebar">
                            <h3 class="sidebar-title">Seguros {{$insurance->solution->name ?? ''}}</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($insurance->similar() as $similar)
                                <div class="post-item clearfix">
                                    <img src="{{ route('insurance.image', $similar->id) }}" alt="">
                                    <h4>
                                        <a href="{{ route('insurance.page', $similar->name) }}">
                                            {{ $similar->name }}
                                        </a>
                                    </h4>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection