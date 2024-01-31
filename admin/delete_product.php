<?php

require "dbconn.php";

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: product.php");
} 


?>