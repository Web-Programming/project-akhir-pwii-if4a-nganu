<link rel="stylesheet" type="text/css" href="{{ asset('css/converted.css') }}" />


<div class="wadah">
        <img src="uploads/{{ $only_name.'.'.$convert_type }}" alt="Converted Image" />
    
    
    <div class="bawah">
        <a href="{{ route('download', ['filepath' => $target_dir.'/'.$image]) }}"><button class="bot">DOWNLOAD CONVERTED IMAGE</button></a>
        
        <a href="{{ route('share', ['filepath' => $target_dir.'/'.$image]) }}"><button class="bot">SHARE CONVERTED IMAGE</button></a>
        
        <a href="{{ route('dashboard') }}"><button class="bot">CONVERT ANOTHER</button></a>
    </div>
</div>
