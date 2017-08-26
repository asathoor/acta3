<?php 
// Online db:
// include_once "header_index.php"; 
// Produktion:
include_once "header.php"; 
?>

<form action="#" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Søg</legend>
	<input type="text" pattern=".{3,}" name="ord">
	<button name="seek" value="seek" type="submit">OK</button>
	</fieldset>
</form>

<?php
// seek in the database
if(isset($_GET['seek'])) {

	// clean input
   $renset = addslashes(strip_tags(trim(($_GET['ord']))));
   
	echo "<h3> Index: " . $renset . "  </h3>";

	// db connection
	include_once "db.php";

	
	
	// SELECT ...
	$sql = "SELECT *
		FROM `word_vol_title_page`
		WHERE `word` LIKE '%"
		. $renset 
		."%' 
		OR `title` LIKE '%"
		. $renset
		. "%' ORDER BY word, page, title";
	
	// loop out similar words as radio buttons
	$result =  $mysqli->query($sql); // query


	// loop out the result
   echo "<ol>"; // define a list
	
	while($row = $result->fetch_assoc()){
	
		 echo "<li> <span class='tydelig'>" 
		 . stripslashes($row['word'])
		 . "</span> <em> <br> - \"" 
		 . stripslashes($row['title']) 
		 . "\"</em> "
		 . "<br>Acta Masonica Scandinavica vol. "
		 . $row['vol'] 
		 . " p. "
		 . $row['page']
		 . " ("
		 . $row['year'] 
		 . ")"
		 . "</li>"; // the loop
	
	   } // .while
	   
	   echo "</ol>";
	   
} // .if
?>

<?php include_once "footer.php"; ?>
