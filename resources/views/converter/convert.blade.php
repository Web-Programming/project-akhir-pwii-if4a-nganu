<link rel="stylesheet" type="text/css" href="{{ asset('css/convert.css') }}" />

@php
    // Define types as an associative array
    $types = [
        'png' => 'PNG',
        'gif' => 'GIF',
        'jpg' => 'JPG',
        'webp' => 'WEBP',
    ];
@endphp

<form method="post" action="{{ route('converted-image', ['imageName' => $imageName, 'imageType' => $imageType]) }}">
    @csrf
            <img src="uploads/{{ $imageName }}" alt="Uploaded Image" />
            <div class="bawah"> 
                <select name="convert_type">
                    @foreach($types as $key => $type)
                        @if($key !== $imageType)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endif
                    @endforeach
                </select>
            </div> 
            <div class="bawah2"> 
            <button type="submit" id="tbl">CONVERT</button>
            </div>
</form>