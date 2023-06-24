<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}" />
</head>
<body>

		<div class="utama">
			<div class="atas">			
				<h2>Profile</h2>
				<a href="{{ route('home') }}"><img width="50px" src="{{ asset('img/home.svg') }}" alt=""></a>
			</div>
			<div class="explain">
				<p>Username : {{ $username }}</p>
				<p>Jumlah foto : {{ $jmlhConvert }}</p>	
			</div>
			<a href="{{ route('changepassword') }}"><button class="button">Change Password</button></a>
			@if ($errors->any())
				@foreach($errors->all() as $error)
				<p class="berhasil">
					{{ $error ."!" }}
				</p>
				@endforeach
			@endif
		</div>
</body>
</html>