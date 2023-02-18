@extends('layouts_page.menu')

@section('title', '| ' . __('base_lang.insurances'))

@section('content_page')

<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Seguros {{ $solution->name }}</p>
        </header>

        <div class="row gy-4">
            @foreach ($solution->insurances as $insurance)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-box">
                    <i class="{{$insurance->icon}} icon"></i>
                    <h3>{{ $insurance->name }}</h3>
                    <p>{{ $insurance->description }}</p>
                    <a href="{{ route('insurance.page', $insurance->slug) }}" class="read-more">
                        <span>Leer más</span>&nbsp;
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection