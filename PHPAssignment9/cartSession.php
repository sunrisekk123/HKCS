<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
session_start();
$i = 0;
$duplicate = false;

foreach ($_SESSION as $index => $value) {
    if ($value == $_POST['goodsID'])
        $duplicate = true;
}
while (!$duplicate) {
    if (isset($_SESSION["ShoppingCart$i"])) {
        $i++;
    } else {
        $_SESSION["ShoppingCart$i"] = $_POST['goodsID'];
        break;
    }
}
header("Location:index.php");
?>

</body>
</html>
