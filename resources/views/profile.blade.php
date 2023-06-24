<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
</head>
<body>
	<nav>
		<h1>IMAGIC</h1>
		{{-- @if(null === Auth::check())
		@else --}}
			<h2>Hello, {{ $username }}!</h2>
		{{-- @endisset() --}}
	</nav>
	<div class="main">
		<div class="kiri">
			<img src="{{ asset('img/main_icon.svg') }}">
		</div>
		<div class="kanan">
			<h2>Ini Profile<br>Profile</h2>
            <h3>Hello ini Jumlah konversi anda: {{ $jmlhConvert }}</h3>

			<a href="{{ route('changepassword') }}"><button class="button">Change Password</button></a>
		</div>
	</div>
</body>
</html>