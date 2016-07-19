<?php
/** 
json.php
purpose: return json
*/

if( isset($_GET['ord']) AND $_GET['pasord'] == "vsvchrx" ) {

	// clean input
   $renset = trim(strip_tags(addslashes($_GET['ord'])));
	
	// sql
	$sql = "SELECT *
		FROM `word_vol_title_page`
		WHERE `word` LIKE '%"
		. $renset 
		."%' 
		OR `title` LIKE '%"
		. $renset
		. "%' ORDER BY word, title, vol, page";
	
	// get the data
	include_once "db.php";	
	
	// loop out
	$result =  $mysqli->query($sql); // query
	
	$liste = array();	
	
	while($row = $result->fetch_assoc()){
		
		$liste[] = array($row['word'],
			$row['title'],
			$row['vol'],
			$row['page'],
			$row['year'] 
		);		
		
   }
	
	echo json_encode($liste);
	
	mysqli_close($mysqli); 
}	
?>