<link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}" />

<table width="500" align="center">
    <tr>
        <td align="center">
            Image Converted to {{ ucfirst($convert_type) }}
            <img src="uploads/{{ $only_name.'.'.$convert_type }}" alt="Converted Image" />
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="{{ route('download', ['filepath' => $target_dir.'/'.$image]) }}">Download Converted Image</a>
        </td>
    </tr>
    <tr>
         <td align="center">
            <a href="{{ route('share', ['filepath' => $target_dir.'/'.$image]) }}">Share Converted Image</a>
        </td>
    </tr>
    <tr>
        <td align="center"><a href="index">Convert Another</a></td>
    </tr>
</table>
