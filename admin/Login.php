<?php
session_start();
require "dbconn.php";

if (isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) && empty($password)){
        header('location: login-form.php?error=Input an Email and Password');
    }elseif(empty($email)){
        header('location: login-form.php?error=Email Required');
    }elseif(empty($password)){
        header('location: login-form.php?error=Password Required');
    }else{
        $sql = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) === 1){
            $row = mysqli_fetch_assoc($query);

            if($row['email'] == $email && $row['password'] == $password){
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['first_name'];
                $_SESSION['lastname'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['ID'] = $row['id'];
                header('location: ./Dashboard.php');
                exit();
            }
        }else{
            header('location: ./login-form.php?error=Incorrect Email or Password');
        }
    }

}

?>