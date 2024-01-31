<?php
    session_start();
    require "dbconn.php";
    if($_SESSION['role'] != 0 && $_SESSION['role'] !=1){
        header("location: dashboard.php");
    }

    if(isset($_GET['error'])){
        $error = $_GET['error'];
        if($error == "too-large"){
            $errorMsg = "Sorry, your image file is too large. Accepted file size is 5mb.";
        } else if($error == "invalid-file"){
            $errorMsg = "Sorry, your image file is invalid. Accepted files are: png, jpg, jpeg, gif.";
        } else if($error == "not-img"){
            $errorMsg = "Sorry, your file is not an image.";
        } else {
            $errorMsg = "Sorry, something went wrong. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid bg-body-secondary mt-2">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-secondary">
                <div class="container-fluid">
                    <!-- Left side -->
                    <div class="navbar-brand">
                        <a href="#" class="text-decoration-none">Lazzhoppe</a>
                    </div>

                    <!-- Middle -->
                    <div class="mx-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="Dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="product.php">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="usertry.php">Users</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Right side -->
                    <div class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi <?php echo $_SESSION['firstname'] ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Page content-->
<!-- Page content-->
<div class="container-fluid mt-5 mx-3">
    <div class="container">
        <div class="alert alert-danger mx-3 mb-3 <?php echo(isset($_GET['error']) ? "d-block" : "d-none" ) ?>">
            <strong>Error: </strong><?php echo isset($errorMsg) ? $errorMsg : ''  ?>
        </div>
    
        <div class="card mx-3">
            <div class="card-header">
                New Product
            </div>
            <form action="save_products.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <!-- Add a hidden input field to store the logged-in user's ID -->
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['ID']; ?>"> 
                    <input class="form-control" name="product-title" type="text" placeholder="Product Title" aria-label="default input example">                                    
                    <div class="form-floating mt-3">
                        <textarea class="form-control" name="product-description" placeholder="Type your product description here..." id="floatingTextarea" style="height: 100px"></textarea>
                        <label for="floatingTextarea">Type your product description here...</label>
                    </div>
                    <div class="my-3">
                        <input class="form-control" name="product-img" type="file" id="formFile">
                    </div>
                    <input class="form-control" name="product-brand" type="text" placeholder="Product Brand" aria-label="default input example">  
                    <input class="form-control" name="product-price" type="text" placeholder="Product Price" aria-label="default input example"> 
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Save" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
