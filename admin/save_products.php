<?php
session_start();
require "dbconn.php";

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get product details from the form
    $title        = $_POST['product-title'];
    $description  = $_POST['product-description'];
    $img          = $_FILES['product-img'];
    $brand        = $_POST['product-brand'];
    $price        = $_POST['product-price'];
    
    // Get the user ID from the session
    $userId = $_SESSION['ID'];

    $target_dir = "assets/uploads/";

    // Create the directory if it doesn't exist
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create directory: $target_dir");
        }
    }

    $target_file = $target_dir . basename($_FILES["product-img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["product-img"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;

        // Check file size
        if ($_FILES["product-img"]["size"] > 500000) {
            header("location: new_product_form.php?error=too-large");
            exit;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            header("location: new_product_form.php?error=invalid-file");
            exit;
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES["product-img"]["tmp_name"], $target_file)) {
            // Insert product into the database with user ID
            $sql = "INSERT INTO products (title, description, img, brand, price, user_id) 
                    VALUES ('$title', '$description', '$target_file', '$brand', '$price', '$userId')";

            // Debugging: echo the SQL query
            echo "SQL Query: $sql";

            if ($conn->query($sql)) {
                header("location: Dashboard.php?save=true");
                exit;
            } else {
                // Debugging: print any SQL error messages
                echo "SQL Error: " . $conn->error;
                exit;
            }
        } else {
            // Debugging: print error message if file couldn't be moved
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        header("location: new_product_form.php?error=not-img");
        exit;
    }
}
?>
