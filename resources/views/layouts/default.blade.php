<!DOCTYPE html>
<html>
<head>
	<title>Raspored terapije</title>
	@include('includes.header')
	@yield('links')
</head>
<body>
	@include('includes.nav')
	<div class="content">
		<div class="container">
			<div class="row">
				@yield('content')
			</div>
		</div>
	</div>

	@include('includes.footer')
	@yield('scripts')
</body>
</html>