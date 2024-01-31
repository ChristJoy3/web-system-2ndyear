<?php

require "dbconn.php";

$id = $_GET['id'];
$lastname   = $_POST['lastname'];
$firstname  = $_POST['firstname'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$role       = $_POST['role'];

$sql = "UPDATE users SET last_name='$lastname', first_name='$firstname', email='$email', password='$password', role='$role' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  header("location: user.php");
} 
else {
    header("location: user.php?error");
}

?>