<script src="{{ asset("js/jquery-3.4.1.min.js") }}"></script>
<script src="{{ asset("js/js.js?v=".time()) }}"></script>
<script src="{{ asset("js/countDownTimer.js") }}"></script>
@include('sweetalert::alert')

@yield("scripts")
