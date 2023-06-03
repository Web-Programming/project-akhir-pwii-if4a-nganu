<!DOCTYPE html>
<html>
<head>
    <title>Image Converter Nich</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
    <table width="550" align="center">
        <tr>
            <td align="center">
                <h2 align="center">Image Converter Nich</h2>
            </td>
        </tr>
        <tr>
            <td align="center">
                <h4>Convert Any image to Any image {{ $username }}</h4>
            </td>
        </tr>
        <tr>
            <td align="center">
                <form action="/indexFile" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()">

                    @csrf
                    <input type="file" name="fileToUpload" id="fileToUpload" />
                    <input type="submit" value="Upload" />
                </form>
                <a id="logout-link" class="nav-link" href="imagic">Logout</a>
            </td>
        </tr>
    </table>

    <script src="js/script1.js"></script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault(); // Menghentikan perilaku default dari anchor

            // Tambahkan request ke halaman logout
            fetch('/logout')
                .then(response => {
                    // Mengarahkan pengguna ke halaman "/"
                    window.location.href = '/';
                });
        });
    </script>
</body>
</html>
