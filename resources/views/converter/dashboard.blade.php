<link rel="stylesheet" type="text/css" href="{{ asset('css/style1.css') }}" />
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
                <a href="{{ route('hapusFoto', ['nama' => $gbr->nama]) }}"><button class="tbl">HAPUS</button></a>     
                </form>
            </div>
        </div>
    @endforeach

</div>
<div class="kanan">
            <h2>What image do you want to convert?</h2>
            <div class="jpg">
                <a href="{{ route('index', ['tipe' => 'JPEG']) }}"><button class="toms">JPG/JPEG</button></a>
            </div>
            <div class="png">
                <a href="{{ route('index', ['tipe' => 'PNG']) }}"><button class="toms">PNG</button></a>
            </div>
            <div class="webp">
                <a href="{{ route('index', ['tipe' => 'WEBP']) }}"><button class="toms">WEBP</button></a>
            </div>
            <div class="gif">
                <a href="{{ route('index', ['tipe' => 'GIF']) }}"><button class="toms">GIF</button></a>
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



