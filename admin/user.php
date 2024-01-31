<?php
    session_start();
    require "dbconn.php";
    if($_SESSION['role'] != 0){
        header("location: Dashboard.php");
    }

    $sql = "SELECT * from users";
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
                                <a class="nav-link" href="product.php">Products</a>
                            </li>
                            <li class="nav-item">
                            <li class="nav-item">
                                <a class="nav-link active <?php echo ($_SESSION['role'] == 0 ? 'd-block' : 'd-none'); ?>" href="user.php">Users</a>
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

    <!-- Page Content -->
    <div class="container-fluid col-md-8 mb-3">
        <div class="container mt-3 ">
            <div class="alert alert-danger <?php echo($error ? "d-block" : "d-none") ?>">
                <strong>Error:</strong>
                Something is wrong with your entry causing the action to fail. Please try again.
            </div>
            <div class="d-flex justify-content-end"> 
            <a href="new_user_form.php" class="btn btn-primary mb-3">Add New User</a>
         </div>
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary ">
                        <th scope="col">Action</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                                if($result->num_rows > 0){
                                    while($user = $result->fetch_assoc()){
                            ?> 
                                <tr>
                                    <td><a href="edit_user_form.php?id=<?php echo($user['id']) ?>">Edit</a> | <a href="delete_user.php?id=<?php echo($user['id']) ?>">Delete</a></td>
                                    <td><?php echo $user['last_name'] ?></td>
                                    <td><?php echo $user['first_name'] ?></td>
                                    <td><span class="badge <?php echo($user['role'] == 0 ? "bg-danger" : "bg-info") ?>"><?php echo($user['role'] == 0 ? "Admin" : "User") ?></span></td>
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
