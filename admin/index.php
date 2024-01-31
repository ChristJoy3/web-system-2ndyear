<?php
    session_start();
    require "dbconn.php";

    // Check if the user is not logged in
    if (isset($_SESSION['ID'])) {
        // Redirect to the login page
        header("location: Dashboard.php");
        exit; // Stop further execution
    }

    // Query to fetch all products
    $sql = "SELECT * FROM products ORDER BY id DESC"; // Assuming 'id' is the primary key
    $result = $conn->query($sql);
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
<style>
    
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
                            <a class="nav-link active" aria-current="page" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                </div>

                <!-- Right side -->
                <div class="d-flex">
                    <form class="d-flex" role="search">
                        <a href="login-form.php" class="btn btn-outline-primary" type="submit">Login</a>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Display newly added products -->
        <div class="col-12 text-center mt-5">
        <h1>Available Products</h1>
      </div>
        <div class="container mt-4">
    <div class="row">
 <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {   
                    ?>
                    <div class="col">
                        <div class="card h-100">
                        <img src="<?php echo $row['img'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title'] ?></h5>
                                <p class="card-text"><?php echo $row['description'] ?></p>
                                <p class="card-text">Brand: <?php echo $row['brand'] ?></p>
                                <p class="card-text">Price: <?php echo $row['price'] ?></p>
                                <a href="Shop.php" class="btn btn-primary">Palit Na!</a>

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

<footer class="bg-body-tertiary text-center text-lg-start mt-5">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <form action="">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-auto mb-4 mb-md-0">
          <p class="pt-2">
            <strong>Sign up for our newsletter</strong>
          </p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-5 col-12 mb-4 mb-md-0">
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form5Example22" class="form-control" />
            <label class="form-label" for="form5Example22">Email address</label>
          </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-auto mb-4 mb-md-0">
          <!-- Submit button -->
          <button data-mdb-ripple-init type="button" class="btn btn-primary mb-4">
            Subscribe
          </button>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </form>
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-body" href="index.php">Lazzhoppe</a>
  </div>
  <!-- Copyright -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
