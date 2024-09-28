<script src="{{ asset('dist-front/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('dist-front/js/lib/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dist-front/js/wow.min.js') }}"></script>
<script src="{{ asset('dist-front/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('dist-front/js/select2.full.js') }}"></script>
<script src="{{ asset('dist-front/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('dist-front/js/moment.min.js') }}"></script>
<script src="{{ asset('dist-front/js/counterup.min.js') }}"></script>
<script src="{{ asset('dist-front/js/multi-countdown.js') }}"></script>
<script src="{{ asset('dist-front/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('dist-front/js/iziToast.min.js') }}"></script>
{{-- <script src="{{ asset('dist-front/js/main.js') }}"></script> --}}
<script src="{{ asset('dist-front/js/custom.js') }}"></script>

{{-- @if($errors->any())
    @foreach($errors->all() as $error)
    <script>
        iziToast.error({
            message: '{{ $error }}',
            position: 'topRight'
        });
    </script>
    @endforeach
@endif --}}
@if(Session::has('error'))
    <script>
        iziToast.error({
            message: '{{ Session::get("error") }}',
            position: 'topRight'
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        iziToast.success({
            message: '{{ Session::get("success") }}',
            position: 'topRight'
        });
    </script>
@endif