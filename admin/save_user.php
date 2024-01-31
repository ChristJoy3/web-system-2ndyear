<?php

require "dbconn.php";

$lastname   = $_POST['lastname'];
$firstname  = $_POST['firstname'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$role       = $_POST['role'];

$sql = "INSERT INTO users (first_name, last_name, email, password, role) VALUES ('$firstname', '$lastname', '$email', '$password', '$role')";

if ($conn->query($sql)) {
    header("location: user.php");
} else {
    header("location: user.php?error");
}

?>
