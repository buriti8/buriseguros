@extends('layouts_page.menu')

@section('content_page')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container" data-aos="fade-in">
        <div class="row">
            <h1>{{ $information->name ?? ''}}</h1>
            <div class="col-sm-12 col-lg-6">
                <h2>{{ $information->description ?? ''}}</h2>
            </div>
            <div class="d-flex align-items-center">
                <i class="fas fa-arrow-right get-started-icon"></i>
                <a href="#pricing" class="btn-get-started scrollto">Cotiza</a>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->

<main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">
            <div class="row">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($insurances as $insurance)
                        <div class="swiper-slide" data-aos="fade-up">
                            <div class="icon-box mb-0">
                                <div class="icon">
                                    <i class="{{ $insurance->icon ?? '' }}"></i>
                                </div>
                                <h4 class="title">
                                    <a href="">{{ $insurance->name ?? '' }}</a>
                                </h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    {{-- <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-title">
                <h2 data-aos="fade-up">Cotiza</h2>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-4" data-aos="fade-up">
                    <div id="cpc1"></div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-4 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div id="sel-widget"></div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <div id="sel-widget-soat"></div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Pricing Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 data-aos="fade-up">Paga en línea</h2>
                <p>
                    Puedes realizar tus pagos en línea, dale clic en el logo de tu aseguradora.
                </p>
            </div>

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach ($insurers as $insurer)
                    <div class="swiper-slide">
                        <a href="{{ $insurer->link }}" target="_blank">
                            <img src="{{ route('insurer.image', $insurer->id) }}?{{rand(0, 1000)}}" class="img-fluid"
                                alt="{{ $insurer->name }}">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5 swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Clients Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact pt-4">
        <div class="container">
            <div class="section-title">
                <h2 data-aos="fade-up">Contáctanos</h2>
            </div>

            <div class="map">
                <div style="width: 100%">
                    <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        data-aos="fade-up" data-aos-delay="200"
                        src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q=Buriseguros+(Buriseguros)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                        <a href="https://www.maps.ie/distance-area-calculator.html">area maps</a>
                    </iframe>
                </div>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
                <div class="col-sm-12 col-md-4">
                    <div class="col-sm-12 mt-4" data-aos="fade-up">
                        <div class="info-box">
                            <i class="fas fa-user-tie"></i>
                            <img src="{{asset('img/juan.png')}}" alt="Logo" class="img-fluid" width="30%"
                                style="margin-left: 20px">
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4" data-aos="fade-up">
                        <div class="info-box">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Dirección</h3>
                            <p>{{$information->address ?? ''}}<br>Medellín, Antioquia</p>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="info-box">
                            <i class="fas fa-phone-alt"></i>
                            <h3>Teléfonos</h3>
                            <p>{{$information->mobile}}<br>{{$information->phone}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="info-box">
                            <i class="far fa-clock"></i>
                            <h3>Horarios</h3>
                            <p>Lunes - Viernes: 8:00 AM - 05:00 PM<br>Sábado: 8:00 AM - 12:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 mt-4">
                    <form action="#" method="post" role="form" id="contact-form" class="php-email-form"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h3>@lang('contact_forms.leave_information')</h3>
                                    <p>@lang('contact_forms.leave_information_message')</p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-sm" id="name" name="name"
                                        placeholder="*@lang('contact_forms.name')" required>
                                    <label for="name">*@lang('contact_forms.name')</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                                        placeholder="*@lang('contact_forms.phone')" required>
                                    <label for="phone">*@lang('contact_forms.phone')</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control form-control-sm" id="email" name="email"
                                        placeholder="@lang('contact_forms.email')" pattern="^.+@.+\.[a-zA-Z]{2,63}$">
                                    <label for="email">@lang('contact_forms.email')</label>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-floating">
                                    <select class="form-select" id="insurance_id" name="insurance_id"
                                        aria-label="*@lang('contact_forms.select_insurance')" required>
                                        <option value="">@lang('contact_forms.select_insurance')</option>
                                        @foreach ($insurances as $insurance)
                                        <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="insurance_id">*@lang('contact_forms.insurance_id')</label>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="*@lang('contact_forms.message')"
                                        id="message" name="message" rows="6" style="height: 100%" required></textarea>
                                    <label for="message">*@lang('contact_forms.message')</label>
                                </div>
                                <small><strong>(*) </strong>@lang('base_lang.required')</small>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accept" required>
                                    <label class="form-check-label" for="accept">
                                        &nbsp;@lang('contact_forms.accept')
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 my-3">
                                <div class="error-message"></div>
                                <div class="sent-message"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-center" id="div-contact-form">
                                    <button type="submit">
                                        @lang('contact_forms.send')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main>
<!-- End #main -->

@endsection

{{-- @section('javascript')
<script src="https://lab.suraenlinea.com/widgets/credito-protegido-cotizar/plan-credito-260-380/soat-cotizar.min.js">
</script>
<script src="https://lab.suraenlinea.com/widgets/v2/viajes/viajes.min.js"></script>
<script src="https://lab.suraenlinea.com/widgets/v2/soat/soat.min.js"></script>

<script>
    function fn() {
        const cpcCotizar = document.createElement('plan-credito-cotizar');
        cpcCotizar.setAttribute('codigo-canal', '7771');
        cpcCotizar.setAttribute('codigo-asesor', '80438');
        cpcCotizar.setAttribute('utm-source', 'http://localhost:8081/buriseguros/public/');
        cpcCotizar.setAttribute('utm-campaign', 'asesores-widget');
        
        const cpc1 = document.getElementById('cpc1');
        cpc1.appendChild(cpcCotizar);
        
        const i = angular.bootstrap(cpc1, ['plan.credito.260.380']);
    }

    document.addEventListener('DOMContentLoaded', fn, true);

    function initSuraWidget () {
        SuraWidgetViajes.mount(
        {
            'codigoCanal': 'TraditionalChannel',
            'codigoAsesor': '80438',
            'codigoOficina': '1',
            'tenant': 'sura',
            'utm-source': 'http://localhost:8081/buriseguros/public/',
            'utm-campaign': 'Widget asesor viajes',
            'autocotizar': true,
            'utm-term': 'http://localhost:8081/buriseguros/public/',
            'utm-medium': 'asesores',
        },
        'sel.viajes.cotizar.390.430',
        document.getElementById('sel-widget'));
    }
    
    document.addEventListener('DOMContentLoaded', initSuraWidget, true);

    function initSuraWidgetSoat() {
        SuraWidgetSoat.mount(
        {
            'codigo-canal': '7771',
            'codigo-asesor': '80438',
            'tenant': 'sura',
            'utm-source': 'http://localhost:8081/buriseguros/public/',
            'utm-campaign': 'Widget asesor soat',
        }, 
        'sura.widget.soat.300.400',
        document.getElementById('sel-widget-soat'));

        const jaja = document.getElementsByClassName('jeYTrQ')[0];
        jaja.nextElementSibling.style.marginTop = '0';
    }
    document.addEventListener('DOMContentLoaded', initSuraWidgetSoat, true);
</script>
@endsection --}}