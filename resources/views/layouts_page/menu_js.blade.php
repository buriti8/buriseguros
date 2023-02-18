<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
	window.BASE_URL = '{{url('/')}}';
</script>
<script src="{{ url(mix('js/app.js')) }}"></script>

<script src="{{ url(mix('js/main.js')) }}"></script>
<script src="{{ url(mix('js/contact-form.js')) }}"></script>

<script src="https://lab.suraenlinea.com/widgets/v2/soat/soat.min.js"></script>
<script>
    function initSuraWidget() {
        SuraWidgetSoat.mount(
            {
                "codigo-canal": "7771",
                "codigo-asesor": "80438",
                tenant: "sura",
                "utm-source": "www.asesorseguros.com",
                "utm-campaign": "Widget asesor soat",
            },
            "sura.widget.soat.300.400",
            document.getElementById("sel-widget")
        );
    }
    document.addEventListener("DOMContentLoaded", initSuraWidget, true);
</script>