<?php include_once "header.php"; ?>

<form action="#" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Ny forfatter</legend>
			<input type="text" name="firstname" required> <label> Fornavn</label><br>
			<input type="text" name="lastname" required> <label> Efternavn</label><br>
			<input type="text" name="grad" required> <label> Grad</label><br>
			<input type="text" name="titel" required> <label> Titel</label><br>
			<button name="submit" value="submit" type="submit"> Gem</button>
			<button name="cancel" value="cancel" type="reset"> Fortryd</button>
	</fieldset>
</form>

<?php
// clean up input
$firstname = trim(addslashes(strip_tags($_GET['firstname'])));
$lastname = trim(addslashes(strip_tags($_GET['lastname'])));
$grad = trim(addslashes(strip_tags($_GET['grad'])));
$titel = trim(addslashes(strip_tags($_GET['titel'])));

// insert
if( isset($_GET['submit']) ) {
	$sql = "INSERT INTO authors (`firstname`,`lastname`,`grad`,`titel`) VALUES ('$firstname', '$lastname', '$grad', '$titel' )";
	//echo $sql;
	require_once "db.php";
	$insert = $mysqli->query($sql);
	
	// feedback
	if($insert) {
		echo "<div class=\"alert alert-success\" role=\"alert\">Ny forfatter tilføjet:<br> $sql</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">INSERT kiksede: $sql</div>";
	}
	mysqli_close($mysqli); // close db connection		
}
?>

<?php include_once "footer.php"; ?>