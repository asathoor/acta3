<?php
/**
* findes_det,php
* does the word exist?
*/
include_once "header.php";

// clean up user input
$seeker = addslashes($_GET['ord']);
$seeker = strip_tags($seeker);

// search likes: indexes
$sql = "SELECT *
	FROM `indexes`
	WHERE (`word` LIKE '%"
	. $seeker	
	."%')";

?>

<form action="gem_action.php" method="get" enctype="multipart/form-data">
	<fieldset> 

<h3>Enten - anvend en af disse muligheder:</h3>
	
<?php
// db connection
include_once "db.php";

// loop out similar words as radio buttons
$result =  $mysqli->query($sql); // query

// looping out the result
while($row = $result->fetch_assoc()){
	?>
	
	<input 
	type="radio" 
	name="suggestion" 
	value="<?php echo $row['indexes_id'] ?>"
	required>
	<label><?php echo $row['word']; ?></label> <br>

   <?php

   }

?>
	
	
	<h3> Eller - opret et nyt ord i index: </h3>	

<p>
	<input 
	type="radio" 
	name="suggestion" 
	value="new_input" required> <label> Gem et nyt ord, rediger evt. beskrivelsen: </label>
</p>
	<textarea name="nyt_ord" rows="4" cols="20"><?php echo $_GET['ord']; ?></textarea>

<?php mysqli_close($mysqli); ?>

<br><br>

	<button name="submit" value="submit" type="submit">Videre</button>
	<button name="cancel" value="cancel" type="reset">Fortryd</button>

</fieldset>
</form>

<?php include_once "footer.php";