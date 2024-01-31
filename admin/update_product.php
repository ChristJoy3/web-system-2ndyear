<?php
session_start();
require "dbconn.php";

$id = $_GET['id'];

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get product details from the form
    $title        = $_POST['product-title'];
    $description  = $_POST['product-description'];
    $brand        = $_POST['product-brand'];
    $price        = $_POST['product-price'];
    
    // Check if a new image is uploaded
    if ($_FILES['product-img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['product-img'];

        // Handle the upload
        $target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($img["name"]);

        // Move the uploaded file 
 if (move_uploaded_file($img["tmp_name"], $target_file)) {
            // Update product details in the database with the new image
            $sql = "UPDATE products SET title='$title', description='$description', img='$target_file', brand='$brand', price='$price' WHERE id='$id'";

            if ($conn->query($sql)) {
                header("location: Dashboard.php?update=true");
                exit;
            } else {
                header("location: edit_product_form.php?id=$id&error=update-failed");
                exit;
            }
        } else {
            // Handle file upload error
            header("location: edit_product_form.php?id=$id&error=upload-failed");
            exit;
        }
    } else {
        // No new image uploaded, update other product details in the database
        $sql = "UPDATE products SET title='$title', description='$description', brand='$brand', price='$price' WHERE id='$id'";

        if ($conn->query($sql)) {
            header("location: Dashboard.php?update=true");
            exit;
        } else {
            header("location: edit_product_form.php?id=$id&error=update-failed");
            exit;
        }
    }
} else {
    // Redirect if the form is not submitted via POST method
    header("location: edit_product_form.php?id=$id&error=form-not-submitted");
    exit;
}
?>
'\

\

''