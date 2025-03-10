<?php

include('connection.php');

// Get id from the URL
$id = $_GET['id'];

// Sanitize the input to prevent SQL injection
$id = mysqli_real_escape_string($connection, $id);

$query = "DELETE FROM tb_schedules WHERE schedule_id = '$id'";

if($connection->query($query)) {
    header("location: index.php");
} else {
    echo "FAILED DELETING DATA!";
}

?>