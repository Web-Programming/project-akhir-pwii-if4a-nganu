{{-- <!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('registeradmin.submit') }}">
        @csrf
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('loginadmin') }}">Login</a></p>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div id = "kontener">
        <h1 class="h1">Register Admin</h1>
        <form method="POST" action="{{ route('registeradmin.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control shadow-none" id="exampleInputUsername" aria-describedby="UsernameInput" name = "username" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" id="exampleInputPassword" name = "password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" id="password_confirmation" name = "password_confirmation" required>
            </div>
    
            @if($errors->any())
                <div class="kesalahan">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{ $error ."!" }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="submit" class="btn" id="tbl" name="masuk" value = "Login" class="button">
        </form>
            <p class="isregister">Already have accounts? <a href="{{ route('loginadmin') }}">Login</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>