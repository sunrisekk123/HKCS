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
<h3>Report</h3>
<!--<div class="container">-->
<!--    <i class="fa fa-fw fa-search"></i>-->
<!--    <input type="text" id="search" placeholder="Search.." style="margin: 10px; width: 70%;">-->
<!--</div>-->
<?php
$id = $_COOKIE['loginCookie'];
require_once("Connections/mylib.php");
$SQL = "SELECT * FROM `orders` 
        inner join orderitem on orders.orderID = orderitem.orderID
        inner join goods on orderitem.goodsID = goods.goodsID
        inner join showcase on goods.showcaseID = showcase.showcaseID 
        where showcase.tenantID = '$id' 
        group by orders.orderDateTime
        order by `orderDateTime` DESC";
$conn = getConnection();
$rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
?>

<form id="genReport" action="report.php" method="post" class="dataGroup">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Report Date</th>
                <th scope="col"></th>
                <th scope="col">View</th>
<!--                <th scope="col">Save</th>-->
            </tr>
            </thead>
            <?php
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
                ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo date('d-m-Y', strtotime($rc['orderDateTime'])); ?></th>
                    <th scope="row"><input type="hidden" name="dateTime"
                                           value="<?php $d = date('Y-m-d', strtotime($rc['orderDateTime']));
                                           echo $d; ?>" style="border: 0px" readonly></th>
                    <?php echo
                    "<td>
                    <input type='button' name='view' id='view' class='btn btn-info'  onclick=window.location.href='report.php?dateTime=$d' value='View Details'>
                </td>";
                    ?>
<!--                    <td><input type='button' name='save' id='save' class='btn btn-info' onclick=window.location.href='#'-->
<!--                               value='Save PDF'></td>-->
                </tr>

                </tbody>
            <?php } ?>
        </table>
    </div>
</form>

</body>
</html>