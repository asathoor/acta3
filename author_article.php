<?php 
/**
 * file: author_article.php
 * purpose: save the relation between author(s) and aticle(s)
**/  
include_once "header.php";
?>

<h3>#DRAFT -- Combine: an author with an article</h3>

<form  action="#" method="get" enctype="multipart/form-data">

	<!-- select author -->
	Forfatter: <select name="author">
		<?php
		// connection
		include_once "db.php";
		
		// author list
		$sql_authors = "SELECT `authors_id`, `firstname`, `lastname` FROM `authors` ORDER BY `firstname`";
		$result =  $mysqli->query( $sql_authors ); // query
		$row = $result->fetch_assoc(); // create associative array
		
		// loop out the result
		foreach ($result as $row) {
			print "<option value='" . $row['authors_id'] .   "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
		}
		?>
	</select>
	<br>
	
	<!-- select article -->
	Artikel: <select name="article">
		<?php
		// article list
		$sql_titles = "SELECT `articles_id`, `title` FROM `articles` ORDER BY `title`";
		
			$result =  $mysqli->query( $sql_titles ); // query
			$row = $result->fetch_assoc(); // create associative array
			
			// loop out the result
			foreach ($result as $row) {
				print "<option value='" . $row['articles_id'] . "'>" .  $row['title'] . "</option>";
			}
		
		?> 
	</select>
	
	<!-- buttons -->
	<div>
	<button name="Gem" value="gem" type="submit">Gem</button>
	<button name="Fortryd" value="fortryd" type="reset">Fortryd</button>
	</div>

</form>

<?php
// handle form
if( isset( $_GET['Gem'] ) ) {
	echo "GET: <pre>";
	print_r($_GET);
	echo "</pre>";

	$sql = "INSERT INTO `skriver` ('authors_id','articles_id') VALUES (" . $_GET['author'] . " , " . $_GET['article'] . " )  ";
	echo "SQL: <pre>" . $sql . "</pre>";
	echo "<script> alert('SQL insert skal aktiveres i author_article.php.') </script>";
	mysqli_close( $mysqli );
} else {
	echo "Vælg en forfatter og en artikel. Tast derefter gem.";
	mysqli_close( $mysqli );
}

?>

<?php include_once "footer.php"; ?>
