<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registerC</title>
</head>
<body>
<?php
    $dataOK = true;
    extract($_POST);
//validation for first name & last name
    if ($fname == "") {
        $dataOK = false;
        echo "<p>First name is required!</p>";
    }
    if ($lname == "") {
        $dataOK = false;
        echo "<p>Last name is required!</p>";
    }
//email validation
    if ($emailAdd == "") {
        $dataOK = false;
        echo "<p>Email address must be provided for account login!</p>";
    } else if (strpos($emailAdd, '@') === false || strpos($emailAdd, '.com') === false) {
        $dataOK = false;
        echo "<p>Email address format is not matched! a proper email address contains '@' and 'com'.</p>";
    } else {
        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $SQL = "SELECT * FROM customer";
        $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
        while ($rc = mysqli_fetch_assoc($rs)) {
            //  var_dump($rc);
            extract($rc);
//to see if the emaill has been registered
            if ($customerEmail == $emailAdd) {
                $dataOK = false;
                echo "<p>Email address has already been used, please provide another one!</p>";
            }
        }
        mysqli_free_result($rs);
        mysqli_close($conn);
    }
//phone number validation
    if ($phoneNo == "") {
        $dataOK = false;
        echo "<p>Phone number is required!</p>";
    } else if (strlen($phoneNo) != 8) {
        $dataOK = false;
        echo "<p>Please provide a phone number with 8 digits!</p>";
    }
//password validation
    if ($passw == "") {
        $dataOK = false;
        echo "<p>For security reason, you must set up your account password!</p>";
    }
    if ($passwC == "") {
        $dataOK = false;
        echo "<p>Please reconfirm your password!</p>";
    } else if ($passw != $passwC) {
        $dataOK = false;
        echo "<p>Password not matched, please reconfirm your password!</p>";
    } else if (strlen($passw)<8 || strlen($passw)>16) {
        $dataOK = false;
        echo "<p>For security reasons, password within 8-16 letters (case sensitive) and numbers is recommended!</p>";
    }
//to see if customer agree with terms and condition
    if (!isset($_POST['checkbox'])) {
        $dataOK = false;
        echo "<p>To proceed further account register, you must agree with the terms and condition!</p>";
    }

    if ($dataOK == false) {
        echo "<p>Please re-enter the information</p>";
        echo '<p><a href="register.html">Go back to previous page</a></p>';
    }

//if there is nothing wrong with the data, a new customer account will be created
    if ($dataOK) {
        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $sql = "INSERT INTO customer
                (`customerEmail`, `firstName`, `lastName`, `password`, `phoneNumber`)
                 VALUES ('$emailAdd', '$fname', '$lname', '$passw', '$phoneNo');";

        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $num = mysqli_affected_rows($conn);

        mysqli_close($conn);

        if ($num == 1) {
            echo "Verification link has been sent to your email. Please have a look!";
        }
    }
?>
</body>
</html>