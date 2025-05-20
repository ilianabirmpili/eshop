<?php
// Prepare to conenct to database
$mysqli = new mysqli("localhost", "root", "", "d_and_s");

if ($mysqli->connect_error) {
    die("Connection Error: " . $mysqli->connect_error);
}
?>
