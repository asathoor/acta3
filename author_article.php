<?php include_once "header.php"; ?>

<?php 
function kombiner(){

	// db connect
	include_once "db.php";
	
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
   	?>
				
	</select>
	<button name="submit" value="submit" type="submit">Gem reference</button>
	<button name="Fortryd" value="fortryd" type="reset">Fortryd</button>
	</fieldset>
</form>
<?php

}

kombiner();
?>
<?php
// save data<!--  -->
if (isset($_GET['submit'])) {
	
	// connect to the database
	require_once "db.php";
		
	// clean input
	$author = trim(strip_tags(addslashes($_GET['author'])));
	$article = trim(strip_tags(addslashes($_GET['article'])));
	
	// get the id .. 0,1
	$sql = "INSERT INTO skriver ( authors_id, articles_id) VALUES ($author, $article)";
	echo "<pre> Referencen er gemt: " . $sql . "</pre>";
	
	// insert into skriver
	
	// close connection
	
}

?>

<?php include_once "footer.php"; ?>