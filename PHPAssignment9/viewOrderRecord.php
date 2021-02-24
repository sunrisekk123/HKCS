<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Order Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <h3>My Order</h3>
    <div class="container">
    <i class="fa fa-fw fa-search"></i>
    <input type="text" id="search" placeholder="Search.." style="margin: 10px; width: 70%;" >
</div>
    <?php
    if (!isset($_COOKIE['loginCookie'])) {
        header("Location:loginForm.php");
    } else {
$id = $_COOKIE['loginCookie'];
require_once("Connections/mylib.php");
$SQL = "SELECT * FROM orders 
        inner join shop on orders.shopID = shop.shopID
        where orders.customerEmail = '$id';";
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
                    <th scope="col">Shop</th>
                    <th scope="col">Shop Address</th>
                    <th scope="col">Order Status</th>
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
                            if ($rc["shopID"]==1)
                                echo "Mong Kok";
                            else
                                echo"Tsuen Wan";
                             ?></th>
                        <th scope="col"><?php echo $rc['address']; ?></th>
                        <th scope="col"><?php
                            if ($rc['status'] == 1) {
                                echo "Delivery";
                            } elseif ($rc['status'] == 2) {
                                echo "Awaiting";
                            } else {
                                echo "Completed";
                            } ?></th>
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
                        where orders.orderID = '$orderID'
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
                }
                ?>
            </table>
        </div>
    </form>

























</body>
</html>