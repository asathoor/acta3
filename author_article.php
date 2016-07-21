<?php /**
file: author_article.php
purpose: save the relation between author(s) and aticle(s)
*/  ?>

<?php include_once "header.php"; ?>

<?php 
function kombiner(){

	// db connect
	require "db.php";
	
	// authors
	$sql_authors = "SELECT * FROM authors ORDER BY lastname";
	$result =  $mysqli->query($sql_authors); // query
			
	// article titles
	$sql_titles = "SELECT * FROM articles ORDER BY title";
	$result_titles	= $mysqli->query($sql_titles); // query
	
?>


<form action="#" method="get" enctype="multipart/form-data">
	<fieldset>
		<legend>Kombiner forfatter med artikel</legend>
	<select name="author">
		<?php
		// loop out authors
		while($row = $result->fetch_assoc()){
			
			$id = $row['authors_id'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
					
    		echo '<option value="'. $id . '" label="$id">' . $lastname . ',' . $firstname . '</option>';
   	}				
		
		?>
	</select>
	<select name="article">
		<!-- article / value = article_id -->
		<?php
		// loop out articles
		while($row = $result_titles->fetch_assoc()){
			
			$id_article = $row['articles_id'];
			$title = $row['title'];
					
    		echo '<option value="'. $id_article . '" label="$id">' . $title . '</option>';
   	}
   	
   	mysqli_close($mysqli); // con close	
   	?>
				
	</select>
	<button name="submit" value="submit" type="submit">Gem reference</button>
	<button name="Fortryd" value="fortryd" type="reset">Fortryd</button>
	</fieldset>
</form>
<?php

}

kombiner(); // write the form
?>

<?php
/* Save the data */

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['submit'])) {
	
	// connect to the database
	require "db.php";
		
	// clean input
	$author = trim(strip_tags(addslashes($_GET['author'])));
	$article = trim(strip_tags(addslashes($_GET['article'])));
	
	// get the id .. 0,1
	$sql = "INSERT INTO `skriver` ( `skriver_id`, `authors_id`, `articles_id` ) VALUES (NULL,'$author', '$article')";
	echo $sql;
	
	// insert into skriver
	$insert = $mysqli->query($sql);
	//$insert;
	
	// feedback
	if($insert) {
		echo "Forfatter og artikel relationen er gemt i databasen";
		echo "<pre> Referencen er gemt: " . $sql . "</pre>";
	}
	else {
		echo "Kunne ikke indsætte relationen i databasen";
		echo "<pre> Fejl! Prøvece denne SQL: " . $sql . "</pre>";	
	}
	
	// close connection
	mysqli_close($mysqli); 
}

?>

<?php include_once "footer.php"; ?>