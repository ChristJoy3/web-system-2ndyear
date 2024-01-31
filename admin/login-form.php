
<?php

session_start();

if(isset($_GET['error'])){
    $error = $_GET['error'];
}

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="offset-md-4 col-md-4 d-flex align-items-center justify-content-center border border-primary rounded-3 p-4">
            
            <form action = "Login.php" method = "POST">
                <div class="mb-3">
                <small class="text-danger <?php echo($error == "Input an Email and Password" ? 'd-block' : 'd-none') ?>">Email and Password Required</small>
                <small class="text-danger <?php echo($error == "Incorrect Email or Password" ? 'd-block' : 'd-none') ?>">Incorrect Email or Password</small>

                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                    <small class = "text-danger mt-0 <?php echo($error == "Email Required" ? 'd-block' : 'd-none') ?>">Email Required Ina MO!!</small>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password"class="form-control" id="exampleInputPassword1">
                        <small class = "text-danger mt-0  <?php echo($error == "Password Required" ? 'd-block' : 'd-none') ?> ">Password Required Ina MO!!</small>
                    </div>
                    <div class="d-grid gap-2 col-12 mt-3">
                            <input class="btn btn-primary" type="submit" value="Login">
                            <a href="index.php" class="btn btn-secondary" type="button">Back</a>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>