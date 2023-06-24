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
        <h1>IMAGIC Admin</h1>
        {{-- @if(null === Auth::check())
            <ul>
                <li><a href="{{ route('login') }}"><button class="button">LOGIN</button></a></li>
                <li><a href="{{ route('register') }}"><button class="button">REGISTER</button></a></li>
            </ul>
        @else --}}
            <h2>Hello, {{ $username }}!</h2>
        {{-- @endisset() --}}
    </nav>
   
    <h2>User List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>
                    <form action="{{ route('hapusakun', ['nama' => $user->username]) }}" method="POST">
    @csrf
    <button type="submit" class="tbl">Delete</button>
</form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
