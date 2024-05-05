<?php
$servername = "gestionotes-server.mysql.database.azure.com";
$username = "xrxmuqgnev";
$password = "BxkEmwnh";
$dbname = "gestionotes-database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";