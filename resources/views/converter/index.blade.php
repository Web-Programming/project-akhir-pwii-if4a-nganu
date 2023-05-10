<link rel="stylesheet" type="text/css" href="css/style1.css" />
<table width="550" align="center">
		<tr><td align="center">	<h2 align="center">Image Upload & Convert by Using PHP</h2></td></tr>
		<tr><td align="center"><h4>Convert Any image to JPG, PNG</h4></td></th>
		<tr>
			<td align="center">
				<form action="/indexFile" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()" />
				
					@csrf
					<input type="file" name="fileToUpload" id="fileToUpload" />
					<input type="submit" value="Upload" />
				</form>
			</td>
		</tr>
</table>

<script src="js/script1.js"></script>