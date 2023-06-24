<!DOCTYPE html>
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
