<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HKCS Frontpage</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="top-nav-bar">
    <div class="search-box">


        <img src="Image/cubeShopLogo.png" class="logo">
        <input type="text" class="form-control">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
    </div>
    <div class="menu-bar">
        <ul>
            <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="registerC.html">Sign up</a></li>
            <li><a href="loginForm.php">Log In</a></li>
        </ul>
    </div>
</div>
<?php
    setcookie("loginCookie", "", time() - 60 );
    echo "You have successfully signed out";
    echo '<p><a href="index.php">Click here to go to Homepage</a></p>';
?>
</body>

</html>