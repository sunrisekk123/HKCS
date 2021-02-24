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
            
            <li><a href="loginHomeT.php">My Account</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</div>
<nav class="navbar navbar-expand-sm navbar-dark bg-warning">
    <!-- Brand -->
    <a class="navbar-brand" href="loginHomeT.php"><i class="fa fa-home" aria-hidden="true"></i></a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="manageGoodsInfoT.php">Goods information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewOrderT.php">View Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="genReport.php">Report</a>
        </li>
    </ul>
</nav>
<img src="Image/cubeShopLogo.png" style="margin: 10% 10% 10% 30%; width: 40%; height: 40%;">
<label style="margin: 0 10% 0 40%; font-size: 150%; ">
<?php
$id = $_COOKIE['loginCookie'];
require_once("Connections/mylib.php");
$SQL = "SELECT * FROM `tenant` 
         where tenant.tenantID = '$id'";
$conn = getConnection();
$rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
while ($rc = mysqli_fetch_assoc($rs)) {
    echo "Welcome back, " . $rc['name'];
}
?>
</label>
</body>
</html>