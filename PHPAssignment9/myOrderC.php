<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Profile</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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

    </div>
    <div class="menu-bar">
        <ul>
            <li><a href="indexCustomer.php"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="shoppingCart.php"><i class="fa fa-shopping-basket"></i>Cart</a></li>
            <li><a href="profile.php">My Account</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="indexCustomer.php"><i class="fa fa-home" aria-hidden="true"></i></a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="profile.php">My Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="updateProfileC.html">Update Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="myOrderC.php">My Order</a>
        </li>
    </ul>
</nav>

<div class="resp-container">
    <iframe class="resp-iframe" src="viewOrderRecord.php" width="100%" height="790" allow="encrypted-media" allowfullscreen></iframe>
</div>
</body>
