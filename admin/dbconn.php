<?php

    $servername = "localhost";
    $username   = "dfoiwidm_lazzhoppe";
    $password   = "Kissmun@cj31"; 
    $dbname     = "dfoiwidm_lazzhoppe";


    //Create a connection to db

    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check if the db is connected

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }


?>