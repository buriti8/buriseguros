@extends('layouts_page.menu')

@section('title', '| ' . __('base_lang.insurances'))

@section('content_page')

<section id="features" class="features" style="padding: 100px 0;">
    <div class="container" data-aos="fade-up">
        <div class="tab-content">
            <div class="tab-pane show active">
                <div class="row gy-4">
                    <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                        <h3>{{$insurance->name ?? ''}}</h3>
                        <div>
                            {!! $insurance->content ?? '' !!}
                            {!! $insurance->fullcontent ?? '' !!}
                        </div>
                    </div>
                    <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ route('insurance.image', $insurance->id) }}" alt="{{$insurance->name ?? ''}}"
                            class="img-fluid" />

                        @if ($insurance->id == 6)
                        <div class="mt-4">
                            <h3>Cotiza aquí</h3>
                            <div id="cpc1" class="mt-3"></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('javascript')
@if ($insurance->id == 6)
<script src="https://lab.suraenlinea.com/widgets/credito-protegido-cotizar/plan-credito-260-380/soat-cotizar.min.js">
</script>
<script>
    function fn() {
        var cpcCotizar = document.createElement('plan-credito-cotizar');
        cpcCotizar.setAttribute('codigo-canal', '7771');
        cpcCotizar.setAttribute('codigo-asesor', '80438');
        cpcCotizar.setAttribute('utm-source', 'http://localhost/test/php/buriseguros/public');
        cpcCotizar.setAttribute('utm-campaign', 'asesores-widget');

        var cpc1 = document.getElementById('cpc1'); cpc1.appendChild(cpcCotizar);
        var i = angular.bootstrap(cpc1, ['plan.credito.260.380']);
    }

    document.addEventListener('DOMContentLoaded', fn, true);
</script>
@endif
@endsection

@endsection