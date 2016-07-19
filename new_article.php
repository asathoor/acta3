<?php include_once "header.php"; ?>

<form action="#" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Ny forfatter</legend>
			<input type="text" name="title" required> <label> Titel</label><br>
			<input type="text" name="vol" required> <label> Bind</label><br>
			<input type="text" name="year" required> <label> År</label><br>
			<input type="text" name="page" required> <label> Side</label><br>
			<button name="submit" value="submit" type="submit"> Gem</button>
			<button name="cancel" value="cancel" type="reset"> Fortryd</button>
	</fieldset>
</form>

<?php
// clean up input
$titel = trim(addslashes(strip_tags($_GET['title'])));
$vol = trim(addslashes(strip_tags($_GET['vol'])));
$year = trim(addslashes(strip_tags($_GET['year'])));
$page = trim(addslashes(strip_tags($_GET['page'])));

// insert
if( isset($_GET['submit']) ) {
	
	$sql = "INSERT INTO articles (`title`,`vol`,`year`,`page`) VALUES ('$titel', '$vol', '$year', '$page' )";
	require_once "db.php";
	$insert = $mysqli->query($sql);
	
	// feedback
	if($insert) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Ny forfatter tilføjet:<br> $sql</div>"; // bootstrap alert box
	}
	else {
		echo "<div class=\"alert alert-danger\" role=\"alert\"> " 
		.  mysqli_error($insert)) 
		. "</div>"; // bootstrap alert box
	}
	
	mysqli_close($mysqli); // close db connection		
}
?>

<?php include_once "footer.php"; ?>