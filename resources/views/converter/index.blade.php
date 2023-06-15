<link rel="stylesheet" type="text/css" href="css/style1.css" />
<nav>
    <h1>Your converted images</h1>
</nav>
<div class="gambar">
    @foreach ($gambarNya as $gbr)
        <div class="kartu">
            <div class="cardView" style="background-image: url({{ asset('uploads/'. $gbr->nama) }})"></div>
            {{-- <img src="{{ asset('uploads/'. $gbr->nama) }}" width="200" class=""> --}}
            <div class="beten">
                <button class="tbl">CONVERT</button>
                <button class="tbl" type="submit">HAPUS</button>     
            </div>
        </div>
    @endforeach

</div>
<div class="kanan">
            <h2>What image do you want to convert?</h2>
            <div class="jpg">
                <button class="toms">JPG/JPEG</button>
            </div>
            <div class="png">
                <button class="toms">PNG</button>
            </div>
            <div class="webp">
                <button class="toms">WEBP</button>
            </div>
            <div class="gif">
                <button class="toms">GIF</button>
            </div>
        {{-- <div align="center">
            <form action="/indexFile" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()" />
                @csrf
                <input type="file" name="fileToUpload" id="fileToUpload"/>
                <input type="submit" value="Upload" />
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div> --}}
</div>

<script src="js/script1.js"></script>



