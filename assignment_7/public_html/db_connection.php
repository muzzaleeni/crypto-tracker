<?php
// Create a MySQLi database connection
$mysqli = new mysqli('localhost', 'mbayemirov', 'Txt2ln', 'Group-26');

// Check for connection errors
if ($mysqli->connect_error) {
    die("Error connecting to the database: " . $mysqli->connect_error);
}
?>