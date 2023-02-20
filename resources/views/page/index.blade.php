@extends('layouts_page.menu')

@section('content_page')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row justify-content-center gy-6">
                    <div class="col-lg-5 col-md-8">
                        <img src="http://localhost/test/php/buriseguros/public/insurances/2/image" alt=""
                            class="img-fluid img" />
                    </div>

                    <div class="col-lg-9 text-center">
                        {{-- <h2>Welcome to HeroBiz</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.
                        </p> --}}
                        <a href="#featured-services" class="btn-get-started scrollto">
                            Saber más
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Carousel Item -->

        <div class="carousel-item">
            <div class="container">
                <div class="row justify-content-center gy-6">
                    <div class="col-lg-5 col-md-8">
                        <img src="{{asset('img/hero-carousel-2.svg')}}" alt="" class="img-fluid img" />
                    </div>

                    <div class="col-lg-9 text-center">
                        <h2>At vero eos et accusamus</h2>
                        <p>
                            Nam libero tempore, cum soluta nobis est
                            eligendi optio cumque nihil impedit quo
                            minus id quod maxime placeat facere
                            possimus, omnis voluptas assumenda est,
                            omnis dolor repellendus. Temporibus autem
                            quibusdam et aut officiis debitis aut.
                        </p>
                        <a href="#featured-services" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Carousel Item -->
    </div>

    <a class="carousel-control-prev" href="#hero" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon fas fa-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#hero" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon fas fa-chevron-right" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators"></ol>
</section>
<!-- End Hero Section -->

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Acerca de nosotros</h2>
                <p>
                    {{$contact->description ?? ''}}
                </p>
            </div>

            <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="{{asset('img/familia.jpeg')}}" class="img-fluid" alt="" />
                    </div>
                </div>

                <div class="col-lg-7 pt-0">
                    <h3 class="pt-0 pt-lg-5">
                        Nuestras soluciones
                    </h3>

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        @foreach ($solutions as $key => $solution)
                        <li>
                            <a class="nav-link {{ $loop->first ? 'active' : '' }} set_solution" data-bs-toggle="pill"
                                href="#tab{{$key}}" data-solution="{{$key}}">
                                {{$solution->name ?? ''}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <!-- End Tabs -->

                    <!-- Tab Content -->
                    <div class="tab-content">
                        @foreach ($solutions as $key => $solution)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab{{$key}}">
                            <p class="fst-italic">
                                {{$solution->description ?? ''}}
                            </p>

                            @foreach ($solution->insurance_types($key+1) as $type)
                            <div class="d-flex align-items-center mt-4">
                                <i class="fas fa-check"></i>
                                <h4>
                                    {{$type->name ?? ''}}
                                </h4>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Features Section ======= -->
    @foreach ($solutions as $key => $solution)
    <section id="features_{{$key}}" class="features {{ $loop->first ? 'd-block' : 'd-none' }}">
        <div class="container" data-aos="fade-up">
            <ul class="nav nav-tabs row gy-4 d-flex justify-content-center">
                @foreach ($solution->insurance_types($key+1) as $keyType => $type)
                <li class="nav-item col-6 col-md-4 col-lg-2">
                    <a class="nav-link {{ $loop->first ? 'show active' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#tab-{{$keyType}}-{{$key}}">
                        <i class="{{$type->icon}} color-primary"></i>
                        <h4>{{$type->name ?? ''}}</h4>
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($solution->insurance_types($key+1) as $keyType => $type)
                <div class="tab-pane {{ $loop->first ? 'show active' : '' }}" id="tab-{{$keyType}}-{{$key}}">
                    <div class="row gy-4">
                        <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                            <h3>{{$type->name ?? ''}}</h3>
                            <div>
                                {!! $type->content ?? '' !!}
                            </div>
                            <div class="recent-blog-posts">
                                <div class="post-box">
                                    <a href="{{ route('insurance.page', $type->slug) }}" class="readmore stretched-link">
                                        <span>Saber más</span>
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ route('insurance.image', $type->id) }}" alt="{{$type->name ?? ''}}"
                                class="img-fluid" />
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End Tab Content 1 -->
            </div>
        </div>
    </section>
    @endforeach
    <!-- End Features Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-out">
            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach ($insurers as $insurer)
                    <div class="swiper-slide">
                        <a href="{{ $insurer->link }}" target="_blank">
                            <img src="{{ route('insurer.image', $insurer->id) }}?{{rand(0, 1000)}}" class="img-fluid"
                                alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Clients Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contáctanos</h2>
            </div>
        </div>

        <div class="map">
            <div style="width: 100%">
                <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q=Buriseguros+(Buriseguros)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    <a href="https://www.maps.ie/distance-area-calculator.html">area maps</a>
                </iframe>
            </div>
        </div>
        <!-- End Google Maps -->

        <div class="container">
            <div class="row gy-5 gx-lg-5">
                <div class="col-lg-4">
                    <div class="info">
                        <div class="info-item d-flex">
                            <i class="fas fa-map-marker-alt flex-shrink-0"></i>
                            <div>
                                <h4>Dirección:</h4>
                                <p>{{$contact->address ?? ''}}</p>
                            </div>
                        </div>
                        <!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="far fa-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>{{$contact->email}}</p>
                            </div>
                        </div>
                        <!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="fas fa-phone-alt flex-shrink-0"></i>
                            <div>
                                <h4>Teléfonos:</h4>
                                <p>{{$contact->phone}}</p>
                                <p>{{$contact->mobile}}</p>
                            </div>
                        </div>
                        <!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="far fa-clock flex-shrink-0"></i>
                            <div>
                                <h4>Horario:</h4>
                                <p>Lunes - Viernes: 8:00 AM - 05:00 PM</p>
                                <p>Sábado: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                        <!-- End Info Item -->
                    </div>
                </div>

                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Tu Nombre"
                                    required />
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email"
                                    required />
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto"
                                required />
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Cargando</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Your message has been sent. Thank you!
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
                <!-- End Contact Form -->
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>
<!-- End #main -->

@endsection