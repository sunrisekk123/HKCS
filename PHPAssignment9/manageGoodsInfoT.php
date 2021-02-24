<?php include('manageGoodsInfoT_crud.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Goods</title>
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
        #btnCancel {
            box-shadow: 2px 2px 2px gray;
            transition: 0.15s;
            outline: none;
            border-radius: 10px;
            position: relative;
            display: block;
            margin: auto;
            background: orange;
            color: white;
            font-family: Verdana, serif;
        }

        #btnAdd {
            box-shadow: 2px 2px 2px gray;
            transition: 0.15s;
            outline: none;
            border-radius: 10px;
            position: relative;
            display: block;
            margin: auto 10px;
            background: orange;
            color: white;
            font-family: Verdana;
        }

        #btnUpdate {
            box-shadow: 2px 2px 2px gray;
            transition: 0.15s;
            outline: none;
            border-radius: 10px;
            position: relative;
            display: block;
            margin: auto;
            background: orange;
            color: white;
            font-family: Verdana, serif;
        }

        #btnAdd:hover {
            background: #FF8C00;
            color: white;
            box-shadow: none;
        }

        #btnUpdate:hover {
            background: linear-gradient(to left, #e66465, #c82333);
            color: white;
        }

        .form-row {
            border: 2px solid orange;
            border-radius: 5px;
            width: 85%;
            margin: 20px auto;
            text-align: left;
        }

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
<!-- form for tenant to modify product information -->

<h1 class="text-center">Manage Goods</h1>
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<form id="headChoose" action="manageGoodsInfoT.php" method="post">
    <div class="form-group col-lg-3 col-md-3">
        <!-- sorting -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                ShowcaseID
            </button>
            <ul class="dropdown-menu"  id="chooseShow">
                <li class="dropdown-item"  value="all" id="all" onclick="window.location.href='manageGoodsInfoT.php?all=all'">All</li>
                <?php
                $id = $_COOKIE['emailOrId'];
                require_once("Connections/mylib.php");
                $SQL = "SELECT * FROM `showcase` where showcase.tenantID = '$id'";
                $conn = getConnection();
                $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    extract($rc)
                   ?>
                    <li class="dropdown-item" value="<?php echo " $showcaseID"; ?>" id="showID" onclick="window.location.href='manageGoodsInfoT.php?showID=<?php echo "$showcaseID"; ?>'"> <?php echo "$showcaseID"; ?></li>
                <?php
                }
                ?>
            </ul>
            <!-- add product button -->
            <input type="button" name="btnAddProduct" value="Add Product" id="btnAdd" class="btn btn-warning"
                   onclick="location.href='manageGoodsInfoT.php?add=add'">
        </div>

    </div>
</form>
<!-- add product -->
<?php
if (isset($_GET['add'])) {
    ?>
    <form action="manageGoodsInfoT_crud.php" method="post">

        <div class="form-row">
            <div class="form-group col-lg-2 col-md-2">
                <label for="sID">Showcase ID</label>
                <input type="number" class="form-control" id="sID" name="sID" placeholder="Showcase ID"
                       style="margin: 0px;" required>
            </div>
            <div class="form-group col-lg-3 col-md-3">
                <label for="gName">Goods Name</label>
                <input type="text" class="form-control" id="gName" name="gName" placeholder="Goods Name"
                       style="margin: 0px;" required>
            </div>
            <div class="form-group col-lg-2 col-md-2">
                <label for="stockPrice">Stock Price</label>
                <input type="number" class="form-control" placeholder="0.0" name="stockPrice" id="stockPrice" min="0"
                       value="0.0" step="0.1" pattern="^\d+(?:\.\d{1,2})?$" style="margin: 0px;" required>
            </div>
            <div class="form-group col-lg-2 col-md-2">
                <label for="stockQuantity">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" placeholder="0"
                       style="margin: 0px;" required>
            </div>
            <div class="form-group col-lg-3 col-md-3 select-outline">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status"
                       style="margin: 0px;" value="Available" readonly>
            </div>
            <div class="form-group col-lg-6 col-md-6">
                <input type="submit" name="btnAdd" value="Add" id="btnAdd" class="btn-lg">
            </div>
        </div>

    </form>
    <?php

}


?>
<!-- update product -->
<?php
require_once("Connections/mylib.php");
$conn = getConnection();
if (isset($_GET['goodsID'])) {
    extract($_GET);
    $SQL = "SELECT * FROM goods WHERE goodsID={$goodsID}";
    $rs = mysqli_query($conn, $SQL);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);
    if ($status == 1) {
        $status = "Available";
    } elseif ($status == 2) {
        $status = "Unavailable";
    }

    ?>

    <form action="manageGoodsInfoT_crud.php" method="post">

        <div class="form-row">
            <div class="form-group col-lg-2 col-md-2">
                <label for="gID">Goods ID</label>
                <input type="text" class="form-control" id="gID" name="gID" value="<?php echo $goodsID; ?>"
                       style="margin: 0px;" required readonly>
            </div>
            <div class="form-group col-lg-3 col-md-3">
                <label for="gName">Goods Name</label>
                <input type="text" class="form-control" id="gName" name="gName" value="<?php echo $goodsName; ?>"
                       style="margin: 0px;" required readonly>
            </div>
            <div class="form-group col-lg-2 col-md-2">
                <label for="stockPrice">Stock Price</label>
                <input type="number" class="form-control" value="<?php echo $stockPrice; ?>" name="stockPrice"
                       id="stockPrice" min="0" value="0.0" step="0.1" pattern="^\d+(?:\.\d{1,2})?$" style="margin: 0px;"
                       required>
            </div>
            <div class="form-group col-lg-2 col-md-2">
                <label for="stockQuantity">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stockQuantity"
                       value="<?php echo $remainingStock; ?>" style="margin: 0px;" required>
            </div>
            <div class="form-group col-lg-3 col-md-3 select-outline">
                <label for="status">Status</label>
                <select class="form-control mdb-select md-form md-outline colorful-select dropdown-warning" id="status"
                        name="status" style="margin: 0px;" required>
                    <option value="1">Available</option>
                    <option value="2">Unavailable</option>
                </select>
            </div>
            <div class="form-group col-lg-6 col-md-6">
                <input type="submit" name="btnUpdate" value="Update" id="btnUpdate" class="btn-lg">
            </div>
            <div class="form-group col-lg-6 col-md-6">
                <input type="button" name="btnCancel" value="Cancel" id="btnCancel"
                       onclick="window.location.href='manageGoodsInfoT.php';" class="btn-lg">
            </div>
        </div>

    </form>
    <?php
    mysqli_free_result($rs);
}
mysqli_close($conn);

?>

<!-- view product -->
<form id="modifyGoodsInfo" action="manageGoodsInfoT.php" method="post" class="dataGroup">
    <div class="table-responsive">
        <table class="table table-hover" id="tableGoods">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ShowcaseID</th>
                <th scope="col">GoodsID</th>
                <th scope="col">Goods Name</th>
                <th scope="col">Stock Price</th>
                <th scope="col">Stock Quantity</th>
                <th scope="col">Status</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $id = $_COOKIE['loginCookie'];
            require_once("Connections/mylib.php");

                if(isset($_GET['all'])){
                    $SQL = "SELECT * FROM `goods` inner join showcase on goods.showcaseID = showcase.showcaseID where showcase.tenantID = '$id'";
                }
                else if (isset($_GET['showID'])){
                    $showID = $_GET['showID'];
                    $SQL = "SELECT * FROM `goods` inner join showcase on goods.showcaseID = showcase.showcaseID where showcase.tenantID = '$id' AND showcase.showcaseID = '$showID'";
                }
                else{
                    $SQL = "SELECT * FROM `goods` inner join showcase on goods.showcaseID = showcase.showcaseID where showcase.tenantID = '$id'";
                }


            $conn = getConnection();
            $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
                echo "
       <tr> 
       <td >$showcaseID</td>
       <td >$goodsID</td>
       <td >$goodsName</td>
       <td >$stockPrice</td>
       <td >$remainingStock</td>";
                if ($status == 1) {
                    echo "<td>Available</td>";
                } elseif ($status == 2) {
                    echo "<td>Unavailable</td>";
                }

                echo "
        <td><a href='manageGoodsInfoT.php?goodsID=$goodsID' >Update Goods</a></td>
        <td><a href='manageGoodsInfoT_crud.php?del=$goodsID' class='btn-default'>Delete Goods</a></td>
        </tr>";
            }

            mysqli_free_result($rs);
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
</form>


</body>
</html>