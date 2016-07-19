<?php include_once "header.php"; ?>

<form action="findes_det.php" method="get" enctype="multipart/form-data">

	<label>Ny reference til index</label>
	<input type="text" name="ord">
	<button name="seek" value="seek" type="submit">Søg</button>

</form>

<?php include_once "footer.php"; ?>