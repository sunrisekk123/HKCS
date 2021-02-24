<?php
session_start();
require_once("Connections/mylib.php");
$conn = getConnection();
$id = $_COOKIE['loginCookie'];


if(isset($_POST['btnAdd'])){
    extract($_POST);
    $SQL2 = "SELECT * FROM `showcase` where showcase.tenantID = '$id'";
    $conn = getConnection();
    $rs2 = mysqli_query($conn, $SQL2) or print(mysqli_error($conn));
    while ($rc2 = mysqli_fetch_assoc($rs2)) {
        $showcaseBelongs[] = $rc2['showcaseID'];

    }
    foreach($showcaseBelongs as $key => $value){
        if($sID == $value){
            $SQL = "INSERT INTO `goods` (`goodsID`, `showcaseID`, `goodsName`, `stockPrice`, `remainingStock`, `status`) values (NULL, '$sID', '$gName', '$stockPrice', '$stockQuantity' ,'1')";
            mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $_SESSION['message'] = "Add product Successfully";
            header("Location:manageGoodsInfoT.php");
            break;
        }
        else{
            $_SESSION['message'] = "This showcase is not belongs to you";
            header("Location:manageGoodsInfoT.php");
        }
    }

}

if(isset($_POST['btnUpdate'])){
    extract($_POST);
    $SQL = "UPDATE `goods` SET `goodsName` = '$gName', `stockPrice` = '$stockPrice', `remainingStock` = '$stockQuantity' , `status` = '$status' WHERE `goods`.`goodsID` = '$gID';";
    mysqli_query($conn, $SQL) or die(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);

    if ($num == 1) {

        $_SESSION['message'] = "Product updated!";
        header("Location:manageGoodsInfoT.php");
    } else {
        echo "Update fail!";

    }
}
if(isset($_GET['del'])) {
    extract($_GET);
    $SQL1 = "SELECT * FROM `goods` inner join showcase on goods.showcaseID = showcase.showcaseID where goods.goodsID = '$del'";
    $conn = getConnection();
    $rs1 = mysqli_query($conn, $SQL1) or print(mysqli_error($conn));
    $rc1 = mysqli_fetch_assoc($rs1);
    $status1 = $rc1['status'];

    if($status1 == "1"){

        $SQL = "UPDATE `goods` SET `status` = '2' WHERE `goods`.`goodsID` = '$del';";
        mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $num = mysqli_affected_rows($conn);
        mysqli_close($conn);
        if ($num == 1) {
            $_SESSION['message'] = "Product status change to unavailable!";
            header("Location:manageGoodsInfoT.php");
        } else {
            echo "Del fail!";
        }
    }
    else{
        $_SESSION['message'] = "Product is Unavailable already";
        header("Location:manageGoodsInfoT.php");
    }

}