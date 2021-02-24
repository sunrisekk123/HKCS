<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile Card</title>
    <link rel="stylesheet" href="profileStyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
<?php
if (isset($_COOKIE['loginCookie'])) {
    if (strpos($_COOKIE['loginCookie'], '@') === false) {
        $role = "Tenant";

        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $SQL = "SELECT * FROM tenant WHERE tenantID = '{$_COOKIE['loginCookie']}';";
        $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
        $rc = mysqli_fetch_assoc($rs);

        $fastName = $rc["name"];
        $lastName = "";
        $emailOrID = $rc["tenantID"];
        $phone = "N/A";
        $emailOrPhone = "ID";
    }
    else {
        $role = "Customer";

        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $SQL = "SELECT * FROM customer WHERE customerEmail = '{$_COOKIE['loginCookie']}';";
        $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
        $rc = mysqli_fetch_assoc($rs);

        $fastName = $rc["firstName"];
        $lastName = $rc["lastName"];
        $emailOrID = $rc["customerEmail"];
        $phone = $rc["phoneNumber"];
        $emailOrPhone = "Email";
    }
}
?>
<div class="wrapper">
    <div class="left">
        <img src="Image/cubeShopLogo.png"
             alt="user" width="100">
        <h4><?php echo "$fastName $lastName" ?></h4>
        <p><?php echo "$role" ?></p>
    </div>
    <div class="right">
        <div class="info">
            <h3>personal info</h3>
            <div class="info_data">
                <div class="data">
                    <h4><?php echo "$emailOrPhone" ?></h4>
                    <p><?php echo "$emailOrID" ?></p>
                </div>
                <div class="data">
                    <h4>Phone</h4>
                    <p><?php echo "$phone" ?></p>
                </div>
            </div>
        </div>

        <div class="projects">
            <h3></h3>
            <div class="projects_data">
                <div class="data">
                    <h4>Gender</h4>
                    <p>N/A</p>
                </div>
                <div class="data">
                    <h4>Preference</h4>
                    <p>N/A</p>
                </div>
            </div>
        </div>

        <div class="social_media">
            <ul>

                <?php
                if ($role == "Customer")
                    $email=$_COOKIE['loginCookie'];
                    echo "<li style='width: 255px;'><a href=\"profileDel.php?cemail=$email\">Delete account</a></li>";
                ?>
            </ul>
        </div>
    </div>
</div>
<?php
    mysqli_free_result($rs);
    mysqli_close($conn);
?>
</body>
</html>
