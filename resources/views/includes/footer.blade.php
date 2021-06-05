<script type="text/javascript" src="/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/font_awesome/all.min.js"></script>

{{-- CACHING FOR USER DEFINED SCRIPTS --}}
@if(env('STATIC_FILE_CACHING') == true)
	<script type="text/javascript" src="/js/toast.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
	<script type="text/javascript" src="/js/notify.js"></script>
	<script type="text/javascript" src="/assets/js/toastr.min.js"></script>
@else
	@php
		$t = time();
	@endphp
	<script type="text/javascript" src="/assets/js/toastr.min.js"></script>
	<script type="text/javascript" src="/js/toast.js?t={{$t}}"></script>
	<script type="text/javascript" src="/js/main.js?t={{$t}}"></script>
	<script type="text/javascript" src="/js/notify.js?t={{$t}}"></script>
@endif