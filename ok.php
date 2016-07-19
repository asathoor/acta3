<?php include_once "header.php"; ?>

<h3>Det nye ord er gemt i index</h3>

<p>Nu kan du gemme en reference til det nye ord i indexet:</p>

	<form action="#" method="get" enctype="multipart/form-data">
	
	<input type="text" name="id" value="<?php echo $_GET['id']; ?>" required><label> Id</label> <br>
	<input type="text" name="artikel" value="" required><label> Artikel Id </label>  <br>
	<input type="text" name="side" value="" required><label> Side  </label> <br>
	
	<button name="submit" value="nyt" type="submit">Gem</button>
	<button name="reset" value="reset" type="reset">Fortryd</button>
	
	</form>	

<?php print_r($_GET);

if($_GET['submit'] == 'nyt') {
		
	// INSERT to database
	$id = $_GET['id'];
	$artikel = $_GET['artikel'];
	$side = $_GET['side'];
	
	$sql = "INSERT INTO `contains` (`articles_id`, `indexes_id`, `page`) VALUES ('$artikel', '$id', '$side')";
	require_once "db.php"; // db connection
	$insert = $mysqli->query($sql); // insert
	
	header('Location: insert_ok.php'); // confirm ok page
}
?>

<?php include_once "footer.php"; ?>