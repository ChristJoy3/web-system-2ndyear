<?php

require "dbconn.php";

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: user.php");
} 


?>