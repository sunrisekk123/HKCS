<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
    $dataOK = true;
    extract($_POST);

    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $SQL = "SELECT * FROM customer WHERE customerEmail = '{$_COOKIE['loginCookie']}';";
    $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
    $rc = mysqli_fetch_assoc($rs);

    mysqli_free_result($rs);
    mysqli_close($conn);

    if ($rc["password"] != $oldPassword) {
        $dataOK = false;
        echo "<p>Your old password provided is not correct! Please try again.</p>";
    }
    if (strlen($newPassword)<8 || strlen($newPassword)>16) {
        $dataOK = false;
        echo "<p>For security reasons, password within 8-16 letters (case sensitive) and numbers is recommended!</p>";
    }
    if ($newPassword != $confirmPassword) {
        $dataOK = false;
        echo "<p>Password not matched, please reconfirm your password!</p>";
    }
    if (!$dataOK) {
        echo '<p><a href="updateProfile.php?updatePassword=true">Go back to previous page</a></p>';
    } else {
//        echo "<p>Password has been changed!</p>";
//        echo '<p><a href="profile.php">Go back to your profile</a></p>';

        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $sql = "UPDATE customer
                SET password = '$newPassword'
                    WHERE customerEmail = '$email';";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $num = mysqli_affected_rows($conn);

        mysqli_close($conn);

        if ($num == 1) {
            echo "<p>Password has been changed!</p>";
            echo '<p><a href="profile.php">Go back to your profile</a></p>';
        }
    }
?>
</body>
</html>
