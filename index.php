<?php include_once "header.php"; ?>

<p>Indexord (skriv evt. en del af ordet)</p>

<form action="#" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Søg i Index Acta Masonica Scandinavica</legend>
	<input type="text" pattern=".{3,}" name="ord">
	<button name="seek" value="seek" type="submit">Søg</button>
	</fieldset>
</form>

<?php
if(isset($_GET['seek'])) {

	echo "<h3> Index: " . $_GET['ord'] . "  </h3>";

	// db connection
	include_once "db.php";

   $renset = addslashes($_GET['ord']);
	
	// sql
	$sql = "SELECT *
		FROM `word_vol_title_page`
		WHERE `word` LIKE '%"
		. $renset 
		."%' 
		OR `title` LIKE '%"
		. $renset
		. "%' ORDER BY word, title, vol, page";
	
	// loop out similar words as radio buttons
	$result =  $mysqli->query($sql); // query


	// looping out the result
   echo "<ol>";	
	
	while($row = $result->fetch_assoc()){
	
		 echo "<li><span class='tydelig'>" 
		 . stripslashes($row['word'])
		 . "</span> <br> \"" 
		 . stripslashes($row['title']) 
		 . "\" "
		 . " <em>Acta Masonica Scandinavica vol. "
		 . $row['vol'] 
		 . " p. "
		 . $row['page']
		 . " ("
		 . $row['year'] 
		 . ")"
		 . "</em></li>";
	
	   } // .while
	   
	   echo "</ol>";
	   
} // .if
?>

<?php include_once "footer.php"; ?>