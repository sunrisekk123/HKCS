<?php include('viewOrderT_del.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Report</title>
    <link rel="stylesheet" href="style.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<style>
    .msg {
        margin: 10px auto;
        padding: 10px;
        border-radius: 5px;
        color: #FF4500;
        background: #FFE5CC;
        border: 1px solid #FF4500;
        width: 50%;
        text-align: center;
    }
</style>
</head>
<body>
<div class="top-nav-bar">
    <div class="search-box">


        <img src="Image/cubeShopLogo.png" class="logo">

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
<?php if (isset($_SESSION['message'])): ?>
<div class="msg">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    </div>
<?php endif;
$id = $_COOKIE['loginCookie'];
require_once("Connections/mylib.php");
$SQL = "SELECT *,orders.status as oStatus FROM `orders` 
        inner join orderitem on orders.orderID = orderitem.orderID
        inner join goods on orderitem.goodsID = goods.goodsID
        inner join shop on orders.shopID = shop.shopID
        inner join customer on orders.customerEmail = customer.customerEmail
        inner join showcase on goods.showcaseID = showcase.showcaseID  
        where showcase.tenantID = '$id' 
        group by orders.orderID
        order by `orderDateTime` DESC";
$conn = getConnection();
$rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
?>
<form id="viewOrder" action="viewOrderT.php" method="post" class="dataGroup">
    <div class="table-responsive">
        <table class="table table-hover" id="tableGoods">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Order Date</th>
                <th scope="col">Order Status</th>
                <th scope="col">Customer ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Shop Address</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <?php

            while ($rc = mysqli_fetch_assoc($rs)) {


                ?>
            <thead class="thead-light">
            <tr>
                <th scope="col"><?php echo $rc['orderID']; ?></th>
                <th scope="col"><?php echo date('d-m-Y', strtotime($rc['orderDateTime'])); ?></th>
                <th scope="col"><?php
                    if ($rc['oStatus'] == 1) {
                        echo "Delivery";
                    } elseif ($rc['oStatus'] == 2) {
                        echo "Awaiting";
                    } else {
                        echo "Completed";
                    } ?></th>
                <th scope="col"><?php echo $rc['customerEmail']; ?></th>
                <th scope="col"><?php echo $rc['firstName'] . " " . $rc['lastName']; ?></th>
                <th scope="col"><?php echo $rc['address']; ?></th>
                <th scope="col"><a href="viewOrderT_del.php?del=<?php echo $rc['orderID']; ?>">Delete Order</a></th>
            </tr>
            </thead>
            <thead class="thead-light table-sm">
            <tr>
                <th scope="col "></th>
                <th scope="col">Goods ID</th>
                <th scope="col">Goods Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Selling price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <?php
            $orderID = $rc['orderID'];
            $SQL2 = "SELECT *  FROM `orders` 
                        inner join orderitem on orders.orderID = orderitem.orderID
                        inner join shop on orders.shopID = shop.shopID
                        inner join customer on orders.customerEmail = customer.customerEmail
                        inner join goods on orderitem.goodsID = goods.goodsID
                        where orders.orderID = $orderID
                        order by orderDateTime DESC";
            $rs2 = mysqli_query($conn, $SQL2) or print(mysqli_error($conn));
            $price = 0;
            while ($rc = mysqli_fetch_assoc($rs2)) {
            extract($rc);
            $price += (float)$sellingPrice * (float)$quantity ;
            ?>
            <tbody>
            <thead class="thead-light table-sm">
            <tr>
                <th scope="row"></th>
                <td><?php echo $rc['goodsID']; ?></td>
                <td><?php echo $rc['goodsName']; ?></td>
                <td><?php echo $rc['quantity']; ?></td>
                <td><?php echo $rc['sellingPrice']; ?></td>
                <td></td>
            </tr>
            </thead>

            </tbody>

            <?php

            }
            echo "  <td>Total Price: </td>
                <td> " . number_format($price,1,'.','') . "</td> "
            ?>
            <th></th>
            <?php }
             ?>
        </table>
    </div>
</form>


</body>
</html>