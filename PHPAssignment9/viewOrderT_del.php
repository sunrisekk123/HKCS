<?php
session_start();
require_once("Connections/mylib.php");
$conn = getConnection();

if(isset($_GET['del'])) {
    $del = $_GET['del'];

    $SQL2 = "SELECT *,count(*)  FROM `orders`
            inner join orderitem on orders.orderID = orderitem.orderID
            
            where orders.orderID = $del";
    $rs = mysqli_query($conn, $SQL2) or print(mysqli_error($conn));
    while ($rc = mysqli_fetch_assoc($rs)) {

        $status = $rc['status'];
        $countQuantity = $rc['count(*)'];
    if($status == 1 && $countQuantity == 1  ){
//        $SQL0 = "ALTER TABLE `orderitem` DROP FOREIGN KEY `orderitem_ibfk_1`";
//        mysqli_query($conn, $SQL0) or die(mysqli_error($conn));
//        $SQL1 = " ALTER TABLE `orderitem` ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders`(`orderID`) ON DELETE CASCADE ON UPDATE RESTRICT;";
//        mysqli_query($conn, $SQL1) or die(mysqli_error($conn));
        $SQL4 = "DELETE FROM `orderitem`
                where orderID = $del
                ";
        mysqli_query($conn, $SQL4) or die(mysqli_error($conn));
        $SQL3 = "DELETE FROM `orders`
                where orderID = $del
                ";
        mysqli_query($conn, $SQL3) or die(mysqli_error($conn));
        $num = mysqli_affected_rows($conn);
        mysqli_close($conn);
        if ($num == 1) {
            $_SESSION['message'] = "Order Deleted!";
            header("Location:viewOrderT.php");
        } else {
            echo "Del fail!";
        }
    }
    else{
        $_SESSION['message'] = "Order cannot be delete!";
        header("Location:viewOrderT.php");
    }
    }


}