<?php
// CONNECT TO THE SAKILA DATABASE

$mysqli = new mysqli("localhost", "root", "mojndo","actaindex"); // creates the object
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; // if error messages
}

/* test your connection */

/*
echo "Your're connected to the database via: " 
. $mysqli->host_info 
. "\n";
*/

mysqli_set_charset($mysqli,"utf8"); // tegnsaet
?>
