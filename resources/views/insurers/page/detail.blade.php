@extends('layouts_page.menu')

@section('title', '| ' . __('base_lang.insurances'))

@section('content_page')

<section id="values" class="values">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Paga tus seguros</p>
        </header>

        <div class="row justify-content-center">
            @foreach ($insurers as $insurer)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="box">
                    <a href="{{ $insurer->link }}">
                        <img src="{{ route('insurer.image', $insurer->id) }}" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</section>

@endsection