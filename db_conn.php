<?php
$servername = "gestionotes-server.mysql.database.azure.com";
$username = "xrxmuqgnev";
$password = "Hello@world12";
$dbname = "gestionotes-database";

// Create connection
// Create connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>