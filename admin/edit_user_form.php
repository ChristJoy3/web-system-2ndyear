<?php
session_start();
require "dbconn.php";

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();


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
                            New User Form
                        </div>
                        <form action="update_user.php?id=<?php echo($user['id']) ?>" method="post">
                            <div class="card-body">
                                
                                    <div class="row">
                                        <div class="col-8">
                                            <input class="form-control" name="email" type="email" placeholder="Email address" aria-label="default input example" value="<?php echo($user['email']) ?>">
                                        </div>
                                        <div class="col-4">
                                            <input class="form-control" name="password" type="password" placeholder="Password" aria-label="default input example" value="<?php echo($user['password']) ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <input class="form-control" name="lastname" type="text" placeholder="Last Name" aria-label="default input example" value="<?php echo($user['last_name']) ?>">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" name="firstname" type="text" placeholder="First Name" aria-label="default input example" value="<?php echo($user['first_name']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" name="role" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" <?php echo($user['role'] == 0 ? "checked" : "") ?>>
                                        <label class="form-check-label" for="inlineRadio1"><span class="badge bg-danger">Admin User</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="role" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" <?php echo($user['role'] == 1 ? "checked" : "") ?>>
                                        <label class="form-check-label" for="inlineRadio2"><span class="badge bg-warning">Regular user</span></label>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Save User" class="btn btn-primary btn-sm">
                                <a href="user.php" class="btn btn-secondary btn-sm">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>