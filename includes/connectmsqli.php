<?php
//para7.unl.edu
$mysqli = new mysqli("para7.unl.edu", "shellwe", "terra1", "shellwe"); 
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
}

?>
