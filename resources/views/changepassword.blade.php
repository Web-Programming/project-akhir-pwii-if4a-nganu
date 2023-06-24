{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
</head>
<body>
    <nav>
        <h1>IMAGIC</h1>
        <h2>Hello, {{ $username }}!</h2>
    </nav>
    <div class="main">
        <div class="kiri">
            <img src="{{ asset('img/main_icon.svg') }}">
        </div>
        <div class="kanan">
            <h2>Change Password</h2>
            <form method="POST" action="{{ route('changepassword.submit') }}">
                @csrf
                <div>
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div>
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div>
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="button">Change Password</button>
            </form>
        </div>
    </div>
</body>
</html>
 --}}

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
        <h1 class="h1">Change Password</h1>
        <form method="POST" action="{{ route('changepassword.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control shadow-none" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control shadow-none" required>
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control shadow-none" required>
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
            <input type="submit" class="btn" id="tbl" name="masuk" value = "Change Password" class="button">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>