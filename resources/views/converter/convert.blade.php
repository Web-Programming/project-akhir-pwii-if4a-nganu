<link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}" />

@php
    //define types as an associative array
    $types = [
        'png' => 'PNG',
        'gif' => 'GIF',
        'jpg' => 'JPG',
        'webp' => 'WEBP',
    ];
@endphp

<form method="post" action="{{ route('converted-image', ['imageName' => $imageName, 'imageType' => $imageType]) }}">
    @csrf
    <table width="500" align="center">
        <tr>
            <td align="center">
                File Uploaded, Select below option to convert!
                <img src="uploads/{{ $imageName }}" alt="Uploaded Image" />
            </td>
        </tr>
        <tr>
            <td align="center">
                Convert To:
                <select name="convert_type">
                    @foreach($types as $key=>$type)
                        @if($key !== $imageType)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endif
                    @endforeach
                </select>
                <br /><br />
            </td>
        </tr>
        <tr>
            <td align="center"><button type="submit">Convert</button></td>
        </tr>
    </table>
</form>