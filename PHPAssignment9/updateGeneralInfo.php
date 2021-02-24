<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
//    extract($_POST);

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];

    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $sql = "UPDATE customer
                SET firstName = '$firstName',
                    lastName = '$lastName',
                    phoneNumber = '$phoneNumber'
                    WHERE customerEmail = '$email';";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);

    mysqli_close($conn);

    if ($num == 1) {
        header("Location:profile.php");
    } else {
        header("Location:updateProfile.php?change=notChanged");
    }
?>
</body>
</html>