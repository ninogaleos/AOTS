<?php
// $conn = new mysqli("localhost","root","","aots");
$conn = new mysqli("localhost","root","","ticketing");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>