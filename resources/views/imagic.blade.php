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
		<ul>
			<li><a href="{{ route('login') }}"><button class="button">LOGIN</button></a></li>
			<li><a href="{{ route('register') }}"><button class="button">REGISTER</button></a></li>
		</ul>
	</nav>
	<div class="main">
		<div class="kiri">
			<img src="{{ asset('img/main_icon.svg') }}">
		</div>
		<div class="kanan">
			<h2>CONVERT YOUR IMAGES<br>TO DIFFERENT TYPE!</h2>
			<p class="explain">With easy steps, you can start to give magic<br>to your images!</p>

			<ul class="fitur">
				<li><img class ="subicon" src="{{ asset('img/uploadcon.svg') }}"><p><span class="bold">Upload</span> your image to our website</p></li>
				<li><img class ="subicon" src="{{ asset('img/convertcon.svg') }}"><p>The <span class="bold">Convert</span> process only take 0.0001 s</p></li>
				<li><img class ="subicon" src="{{ asset('img/downloadcon.svg') }}"><p>Your converted image is ready to <span class="bold">Download</span></p></li>
			</ul>
			<a href="{{ route('login') }}"><button class="button">LET'S START!</button></a>
		</div>
	</div>
</body>
</html>