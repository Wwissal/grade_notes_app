<?php
$servername = "mysql-database-vnet.mysql.database.azure.com";
$username = "user";
$password = "Hello@world12";
$dbname = "apu";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";