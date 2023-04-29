<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
	window.BASE_URL = '{{url('/')}}';
</script>

<script src="{{ url(mix('js/app.js')) }}"></script>
<script src="{{ url(mix('js/page.js')) }}"></script>