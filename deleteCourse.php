<?php
include "db_conn.php";

$id = $_GET["id"];

$sql = "DELETE FROM filieres WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: courses.php?msg=Data deleted successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>
