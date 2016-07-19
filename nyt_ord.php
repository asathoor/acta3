<?php include_once "header.php"; ?>

<form action="findes_det.php" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Nyt indexord (skriv en del af ordet)</legend>		
		<input type="text" name="ord" size="100">
		<button name="seek" value="seek" type="submit">Tjek ordet</button>
	</fieldset>
</form>

<?php include_once "footer.php"; ?>