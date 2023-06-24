<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}" />
<body>
    <div class="konten">
        <h1>CONVERT {{ $tipe }} TO ANOTHER TYPE</h1>
        <form action="/indexFile" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()">
            @csrf
            <label id="tbl" for="fileToUpload" class="aplod">SELECT YOUR {{ $tipe }} IMAGE</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/{{ $tipe }}" class="hide" onchange="this.form.submit()"/>
        </form>
        {{-- <form method="POST" action="{{ route('logout') }}" >
            @csrf
            <button type="submit">Logout</button>
        </form> --}}
    </div>
    
</body>
