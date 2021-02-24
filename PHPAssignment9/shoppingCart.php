<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
?>
<div class="top-nav-bar">
    <div class="search-box">
        <i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
        <i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>

        <img src="Image/cubeShopLogo.png" class="logo">
        <input type="text" class="form-control">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
    </div>
    <div class="menu-bar">
        <ul>
            <li><a href="shoppingCart1.html"><i class="fa fa-shopping-basket"></i>Cart</a></li>
            <li><a href="registerC.html">Sign up</a></li>
            <li><a href="loginForm.php">Log In</a></li>
        </ul>
    </div>
</div>
<h3>Shopping cart</h3>
<div class="container">
    <i class="fa fa-fw fa-search"></i>
    <input type="text" id="search" placeholder="Search.." style="margin: 10px; width: 70%;" >
</div>
<form id="viewOrderRecord" action="addOrder.php" method="post" class="dataGroup">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price per unit</th>
                <th scope="col">Remaining Stock</th>
                <th scope="col">Order Quantity</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION as $index => $value) {
                $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
                $sql = "SELECT * FROM goods WHERE goodsID = '$value';";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $rc = mysqli_fetch_assoc($rs);

                $total += $rc["stockPrice"];
                ?>
                <tr>
                    <th scope="row"><img src="Image/<?php echo $rc["goodsName"]; ?>.jpg" width="100" height="100"></th>
                    <td><?php echo $rc["goodsName"]; ?></td>
                    <td>$<?php echo $rc["stockPrice"]; ?></td>
                    <td><?php echo $rc["remainingStock"]; ?></td>
                    <td>
                        <input type="number" name="number" id="number" min="0" max="<?php echo $rc["remainingStock"]; ?>" required/>
                    </td>
                    <td><button type="button" class="btn btn-secondary" >Delete</button></td>
                </tr>
                <?php
                mysqli_free_result($rs);
                mysqli_close($conn);
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <hr>
        <label style="float: right;">Total price: <?php echo $total; ?></label>
    </div>
    <div class="container">
        <button type="submit" class="btn btn-secondary" style="float: left;">Confirm Order</button>
    </div>


</form>
</body>
</html>