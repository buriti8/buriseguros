@extends('layouts_page.menu')

@section('title', __('base_lang.home'))

@section('content_page')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">{{$contact->name}}</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">{{$contact->description}}</h2>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{asset('img/hero-img.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="fade-up">
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
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </section><!-- End Clients Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>¿Qué solución deseas?</p>
            </header>

            <div class="row justify-content-center">
                @foreach ($solutions as $solution)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="box">
                        <img src="{{ route('solution.image', $solution->id) }}" class="img-fluid" alt="">
                        <h3>{{ $solution->name }}</h3>
                        <p>{{ $solution->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </section><!-- End Values Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">

        <div class="container" data-aos="fade-up">

            <!-- Feature Icons -->
            <div class="row feature-icons" data-aos="fade-up">
                <h3 class="pb-2">Algunas de nuestras soluciones</h3>

                <div class="row">

                    <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{asset('img/other.png')}}" class="img-fluid p-4" alt="">
                    </div>

                    <div class="col-xl-8 d-flex content">
                        <div class="row align-self-center gy-4">
                            @foreach ($insurances as $insurance)
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="{{ $insurance->icon }}"></i>
                                <div>
                                    <h4>{{ $insurance->name }}</h4>
                                    <p>{{ $insurance->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div><!-- End Feature Icons -->

        </div>

    </section><!-- End Features Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>Blog</p>
            </header>

            <div class="row">
                <div class="col-lg-4">
                    <div class="post-box">
                        <div class="post-img"><img src="{{asset('img/blog/blog-1.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <span class="post-date">Tue, September 15</span>
                        <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit
                        </h3>
                        <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="post-box">
                        <div class="post-img"><img src="{{asset('img/blog/blog-2.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <span class="post-date">Fri, August 28</span>
                        <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
                        <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="post-box">
                        <div class="post-img"><img src="{{asset('img/blog/blog-3.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <span class="post-date">Mon, July 11</span>
                        <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>
                        <a href="#" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- End Recent Blog Posts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <p>Contacto</p>
            </header>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="fas fa-map-marker-alt"></i>
                                <h3>Dirección</h3>
                                <p>{{$contact->address}},<br>Medellín, Antioquia, Colombia</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="fas fa-phone-alt"></i>
                                <h3>Teléfonos</h3>
                                <p>{{$contact->phone}}<br>{{$contact->mobile}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="far fa-envelope"></i>
                                <h3>Email</h3>
                                <p>{{$contact->email}}<br>info@buriseguros.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="far fa-clock"></i>
                                <h3>Horario</h3>
                                <p>Lunes - Viernes: 8:00 AM - 05:00 PM</p>
                                <p>Sábado: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="#" method="post" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Asunto" required>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Mensaje"
                                    required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

@endsection