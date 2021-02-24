<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
<?php
    $dataOK = true;
    extract($_POST);
//login as customer
    if ($loginAs == 'customer') {
    //email validation
        if ($emailOrId == "") {
            $dataOK = false;
            echo "<p>Email address must be provided for account login!</p>";
            echo '<p><a href="loginForm.php">Click here and try again</a></p>';
        } else if (strpos($emailOrId, '@') === false || strpos($emailOrId, '.com') === false) {
            $dataOK = false;
            echo "<p>Email address format is not matched! a proper email address contains '@' and 'com'.</p>";
            echo '<p><a href="loginForm.php">Click here and try again</a></p>';
        } else {
            $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
            $SQL = "SELECT * FROM customer";
            $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
            $hasRecord = false;
            while ($rc = mysqli_fetch_assoc($rs)) {
                //  var_dump($rc);
                extract($rc);
    //to see if the emaill has been registered
                if ($customerEmail == $emailOrId)
                    $hasRecord = true;
            }
            if (!$hasRecord) {
                $dataOK = false;
                echo "<p>Email address is not found. Click the link below to register a new account!</p>";
                echo '<p><a href="register.html">New customer account registration</a></p>';
                echo '<p><a href="loginForm.php">Or click here and try again</a></p>';
            }
            mysqli_free_result($rs);
            mysqli_close($conn);
        }
    //to see if the password is correct
        if ($dataOK) {
            $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
            $SQL = "SELECT * FROM customer WHERE customerEmail = '$emailOrId';";
            $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
            $rc = mysqli_fetch_assoc($rs);

            if ($rc["password"] == "$_POST[pwd]") {
                echo "<p>Login successful!</p>";
                echo '<p><a href="indexCustomer.php">Click here to proceed</a></p>';
                setcookie("loginCookie", $emailOrId, time() + 2*60*60);
            } else {
                echo "<p>Login unsuccessful! Password not matched</p>";
                echo '<p><a href="loginForm.php">Click here and try again</a></p>';
            }
            mysqli_free_result($rs);
            mysqli_close($conn);
        }
    }
//login as tenant
    else if ($loginAs == 'tenant') {
    //ID validation
        if (strlen($emailOrId)<7 || strlen($emailOrId)>16) {
            echo "<p>Invalid tenant ID!</p>";
            echo '<p><a href="loginForm.php">Click here and try again</a></p>';
        } else {
            $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
            $SQL = "SELECT * FROM tenant";
            $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
            $hasRecord = false;
            while ($rc = mysqli_fetch_assoc($rs)) {
                //  var_dump($rc);
                extract($rc);
    //to see if the tenant ID has been registered
                if ($tenantID == $emailOrId)
                    $hasRecord = true;
            }
            if (!$hasRecord) {
                $dataOK = false;
                echo "<p>Tenant ID is not found!</p>";
                echo '<p><a href="loginForm.php">Click here and try again</a></p>';
            }
            mysqli_free_result($rs);
            mysqli_close($conn);
        }
    //to see if the password is correct
        if ($dataOK) {
            $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
            $SQL = "SELECT * FROM tenant WHERE tenantID = '$emailOrId';";
            $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
            $rc = mysqli_fetch_assoc($rs);

            if ($rc["password"] == "$_POST[pwd]") {
                echo "<p>Login successful!</p>";
                echo '<p><a href="loginHomeT.php">Click here to proceed</a></p>';
                setcookie("loginCookie", $emailOrId, time() + 2*60*60);
            } else {
                echo "<p>Login unsuccessful! Password not matched</p>";
                echo '<p><a href="loginForm.php">Click here and try again</a></p>';
            }
            mysqli_free_result($rs);
            mysqli_close($conn);
        }
    }
    if (isset($remember)) {
        setcookie("emailOrId", $emailOrId, time() + 7*24*60*60);
        setcookie("pwd", $pwd, time() + 7*24*60*60);
        setcookie("remember", true, time() + 7*24*60*60);
    } else {
        setcookie("emailOrId", "", time() - 60 );
        setcookie("pwd", "", time() - 60 );
        setcookie("remember", "", time() - 60);
    }
?>
</body>
</html>
