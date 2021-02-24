<?php
require_once("Connections/mylib.php");
$conn = getConnection();
if(isset($_GET['cemail'])){

    $cemail = $_GET['cemail'];
    $SQL2 = "DELETE `orderitem` FROM `orderitem` 
            inner join orders on orderitem.orderID = orders.orderID  
                where orders.customerEmail = '$cemail'
                ";
    mysqli_query($conn, $SQL2) or die(mysqli_error($conn));
    $SQL3 = "DELETE FROM `orders`
                where customerEmail = '$cemail'
                ";
    mysqli_query($conn, $SQL3) or die(mysqli_error($conn));
    $SQL4 = "DELETE FROM `customer`
                where customerEmail = '$cemail'
                ";
    mysqli_query($conn, $SQL4) or die(mysqli_error($conn));

    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num == 1) {
        setcookie("loginCookie", "",time()-7*24*60*60);
        setcookie("emailOrId","",time()-7*24*60*60);
        header("Location:index.php");
    } else {
        echo "Del fail!";
    }
}
