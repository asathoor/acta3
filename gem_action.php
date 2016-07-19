<?php include_once "header.php"; ?>

<h2>Gem_action.php</h2>

<?php
// for a known id
if($_GET['suggestion'] !== 'new_input') {
	?>	
	
	<form action="#" method="get" enctype="multipart/form-data">
	
	<input type="text" name="id" value="<?php echo $_GET['suggestion']; ?>" required><label> Id</label> <br>
	<input type="text" name="artikel" value="" required><label> Artikel Id </label>  <br>
	<input type="text" name="side" value="" required><label> Side  </label> <br>
	
	<button name="submit" value="kendt" type="submit">Gem</button>
	<button name="reset" value="reset" type="reset">Fortryd</button>
	
	</form>	
		
	<?php
}

else {
	echo "New word ..." . $_GET['nyt_ord'];

	// ... database connection

	// ... save to index

	// ... get last id from indexes
	
	// ... create form as above 

}



// ... actions for saving a new word

// ... actions for saving a new post in contains

// ... after new word is saved: get last id from indexes and show save form

// ... db close 
?>

<pre>
<?php print_r($_GET); // test ?></pre>

<?php
// ... saving a known input to the contains table
if($_GET['submit'] == 'kendt') {
		
	// INSERT to database
	$id = $_GET['id'];
	$artikel = $_GET['artikel'];
	$side = $_GET['side'];
	
	$sql = "INSERT INTO `contains` (`articles_id`, `indexes_id`, `page`) VALUES ('$artikel', '$id', '$side')";
	echo $sql;
	require_once "db.php"; // db connection
	$insert = $mysqli->query($sql); // insert
	
	header('Location: insert_ok.php'); // confirm ok page
}

// ... saving a new word to the indexes table
if($_GET['suggestion'] == 'new_input') {

	// ... insert a new word
	$word = $_GET['nyt_ord'];
	$sql = "INSERT INTO `indexes` (`word`) VALUES ('$word');";
	echo $sql;
	require_once "db.php"; // db connection
	$insert = $mysqli->query($sql); // insert

	// ... get last id
	$new_id = "SELECT * FROM `indexes_last_id`";
	$result =  $mysqli->query($new_id); // query
	while($row = $result->fetch_assoc()){
   	$last_id = $row['indexes_id'];
   	
   }
   
   // ... create the form
   header('Location: ok.php?id=' . $last_id); // confirm ok page
}
?>

<?php include_once "footer.php"; ?>