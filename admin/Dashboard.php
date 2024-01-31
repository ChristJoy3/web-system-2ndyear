<?php
session_start();
require "dbconn.php";

// Check if the user is not logged in
if (!isset($_SESSION['ID'])) {
    // Redirect to the login page
    header("location: login-form.php");
    exit; // Stop further execution
}

  
if ($_SESSION['role'] != 0 && $_SESSION['role'] != 1) {
    header("location: dashboard.php");
}

if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}

// Get the ID of the logged-in user
$loggedInUserId = $_SESSION['ID'];

// Modify the SQL query to filter products by user ID
$sql = "SELECT * FROM products WHERE user_id = $loggedInUserId";
$result = $conn->query($sql);

$error = false;

if(isset($_GET['error'])){
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head><style>
        .card-img-top {
            width: 80%;
            height: 300px; 
            object-fit: contain;
            margin:auto;
            
        }
    </style>
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
                            <a class="nav-link active " aria-current="page" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo($role == 0 ? 'd-block': 'd-none')?>" href="user.php" >Users</a>
                        </li>
                    </ul>
                </div>

                <!-- Right side -->
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi <?php echo $_SESSION['firstname'] ?></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </nav>
    </div>
</div>



        <!-- Display newly added products -->
        <div class="col-12 text-center mt-5">
        <h1>Your Products</h1>
      </div>
        <div class="container mt-4">
    <div class="row">
 <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($newProduct = $result->fetch_assoc()) {   
                    ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo $newProduct['img'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $newProduct['title'] ?></h5>
                                <p class="card-text"><?php echo $newProduct['description'] ?></p>
                                <p class="card-text">Brand: <?php echo $newProduct['brand'] ?></p>
                                <p class="card-text">Price: <?php echo $newProduct['price'] ?></p>
                                <a href="edit_product_form.php?id=<?php echo ($newProduct['id']) ?>" class="btn btn-primary">Edit</a>
                                <a href="delete_product.php?id=<?php echo ($newProduct['id']) ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col'><p>No newly added products</p></div>";
            }
            ?>
        </div>
</div>
</div>
       
    </div>
</div>

<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
