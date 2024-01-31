<?php
    session_start();
    require "dbconn.php";
    if ($_SESSION['role'] != 0 && $_SESSION['role'] != 1) {
        header("location: dashboard.php");
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
                                <a class="nav-link <?php echo($role == 0 ? 'd-block': 'd-none')?> " href="user.php ">Users</a>
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
                                <a class="dropdown-item" href="Logout.php">Logout</a>
                            </div>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Page content-->

    <div class="container-fluid col-md-8 mb-3">
        <div class="container mt-3 ">
            <div class="alert alert-danger <?php echo($error ? "d-block" : "d-none") ?>">
                <strong>Error:</strong>
                Something is wrong with your entry causing the action to fail. Please try again.
            </div>
            <div class="d-flex justify-content-end"> 
            <a href="new_product_form.php" class="btn btn-primary mb-3">Add New Product</a>
         </div>
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary ">
                        <th scope="col">Action</th>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                                if($result->num_rows > 0){
                                    while($product = $result->fetch_assoc()){
                            ?> 
                                <tr>
                                    <td><a href="edit_product_form.php?id=<?php echo($product['id']) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                    </svg></a>  
                                        <a href="delete_product.php?id=<?php echo($product['id']) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg></a></td>
                                    <td><?php echo $product['id'] ?></td>
                                    <td><div class="square-image-container"><img src="<?php echo $product['img'] ?>" alt="" class="img-fluid square-image"></div></td>
                                    <style>
                                            .square-image-container {
                                                width: 100px;
                                                height: 100px; 
                                                overflow: hidden; 
                                            }

                                            .square-image {
                                                width: 100%; 
                                                height: auto;
                                                object-fit: cover; s
                                            }
                                    </style>
                                    <td><?php echo $product['title'] ?></td>
                                    <td><?php echo $product['description'] ?></td>
                                    <td><?php echo $product['brand'] ?></td>
                                    <td><?php echo $product['price'] ?></td>
                                    
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
