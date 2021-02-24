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
            <li><a href="indexCustomer.php"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="shoppingCart.php"><i class="fa fa-shopping-basket"></i>Cart</a></li>
            <li><a href="profile.php">My Account</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</div>

<div class="vl col-lg-3 col-md-3" ></div>
<section class="gallery-block cards-gallery">
    <div class="container-fluid">
        <div>
            <div style="text-align: center;"><h2>Product</h2></div>
        </div>
        <hr>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shop
                </button>

                <ul class="dropdown-menu">
                    <li class="dropdown-item"  value="all" id="all" onclick="window.location.href='indexCustomer.php'">All</li>
                    <?php
                    require_once("Connections/mylib.php");
                    $SQL3 = "SELECT * FROM `shop`";
                    $conn = getConnection();
                    $rs3 = mysqli_query($conn, $SQL3) or print(mysqli_error($conn));
                    while ($rc3 = mysqli_fetch_assoc($rs3)) {
                    extract($rc3);
                    if($shopID == 1){
                        $sID = "Mong Kok";
                    }
                    else if($shopID == 2){
                        $sID = "Tsuen Wan";
                    }
                    ?>
                    <li class="dropdown-item" onclick="window.location.href='indexCustomer.php?sID=<?php echo "$shopID"; ?>'"><?php echo "$sID"; ?></li>

                    <?php

                }
                ?>
                </ul>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">

                <?php
                if (isset($_COOKIE['loginCookie']))
                    $location = "cartSession.php";
                else
                    $location = "loginForm.php";
                $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
                if(isset($_GET['sID'])){
                    $sID = $_GET['sID'];
                    $sql = "SELECT * FROM goods
                                inner join showcase on goods.showcaseID = showcase.showcaseID
                                where showcase.shopID = $sID";
                }
                else{
                    $sql = "SELECT * FROM goods";
                }

                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                while ($rc = mysqli_fetch_assoc($rs)) {
                    if ($rc["status"] == 1) {
                        ?>

                        <div class="col-md-3 col-lg-3">
                            <div class="card border-0 transform-on-hover">
                                <form action="<?php echo $location; ?>" name="itemList" method="post">
                                    <a class ="lightbox" >
                                        <img src="Image/<?php echo $rc["goodsName"]; ?>.jpg" alt="<?php echo $rc["goodsName"]; ?>" class="card-img-top" width="90%" height="90%">
                                    </a>
                                    <div class="card-body">
                                        <input type="text" name="goodsID" id="goodsID" value="<?php echo $rc["goodsID"]; ?>" readonly required/>
                                        <h6><a href="#"><?php echo $rc["goodsName"]; ?></a> </h6>
                                        <p>HKD$<?php echo $rc["stockPrice"]; ?></p>
                                        <p>Status : remain <?php echo $rc["remainingStock"]; ?> available</p>
                                        <button type="submit" id="addToSC2" class="btn btn-warning"><i class="fa fa-shopping-cart" aria-hidden="true" >Add to Shopping Cart</i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                    }
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
                ?>

            </div>
        </div>

    </div>
</section>
<ul class="pagination" id="pageNum" style="margin-left: 40%; position: static;">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item "><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>
<script>
    function openmenu()
    {
        document.getElementById("side-menu").style.display="block";
        document.getElementById("menu-btn").style.display="none";
        document.getElementById("close-btn").style.display="block";
    }
    function closemenu()
    {
        document.getElementById("side-menu").style.display="none";
        document.getElementById("menu-btn").style.display="block";
        document.getElementById("close-btn").style.display="none";
    }
</script>
</body>

</html>
