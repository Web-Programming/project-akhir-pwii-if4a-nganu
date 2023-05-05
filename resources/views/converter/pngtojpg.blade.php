<h1>PNG to JPG Converter</h1>
<form action="proses" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="file" name="file" accept="image/png" />
  <input type="submit" value="Convert" />
</form>