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
				<h2>Admin</h2>
				<a href="{{ route('logout') }}"><img width="30px" src="{{ asset('img/logout.svg') }}" alt=""></a>
			</div>
			<div class="explains">
                <table cellspacing = 0>
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
                                    <button type="submit" class="buttons">Delete</button>
                                </form>
            
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                        </div>
		</div>
</body>
</html>