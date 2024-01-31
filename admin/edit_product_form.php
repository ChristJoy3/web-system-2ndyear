<?php
session_start();
require "dbconn.php";

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "No product found for ID: $id";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                                <a class="nav-link" href="#!">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="usertry.php">Users</a>
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
    <div class="container-fluid mt-5 mx-3">
        <div class="card mx-3">
            <div class="card-header">
                Edit Product
            </div>
            <form action="update_product.php?id=<?php echo($product['id']) ?>" method="post" enctype="multipart/form-data">   
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" name="product-title" type="text" placeholder="Product Title" aria-label="default input example" value="<?php echo($product['title']) ?>">
                        </div>
                        <div class="col-6">
                            <input class="form-control" name="product-brand" type="text" placeholder="Brand" aria-label="default input example" value="<?php echo($product['brand']) ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <textarea class="form-control" name="product-description" placeholder="Product Description" id="floatingTextarea" style="height: 100px"><?php echo($product['description']) ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <input class="form-control" name="product-img" type="file" id="product-img" <?php echo($product['img']) ?>>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <input class="form-control" name="product-price" type="text" placeholder="Product Price" aria-label="default input example" value="<?php echo($product['price']) ?>">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Save Product" class="btn btn-primary btn-sm">
                    <a href="product.php" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
