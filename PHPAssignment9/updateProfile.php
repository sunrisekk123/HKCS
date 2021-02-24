<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
    $SQL = "SELECT * FROM customer WHERE customerEmail = '{$_COOKIE['loginCookie']}';";
    $rs = mysqli_query($conn, $SQL) or print(mysqli_error($conn));
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);

    mysqli_free_result($rs);
    mysqli_close($conn);
?>
<h1>Update Profile</h1>
<form action="updateGeneralInfo.php" name="Profile" method="post">
    <table border="1" width="100%">
        <tr>
            <td>Email</td>
            <td>
                <input type="Email" name="email" id="email" value="<?php echo "$customerEmail" ?>" readonly/>
            </td>
        </tr>
        <tr>
            <td>First Name</td>
            <td>
                <input type="text" name="firstName" id="firstName" value="<?php echo "$firstName" ?>" required/>
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>
                <input type="text" name="lastName" id="lastName" value="<?php echo "$lastName" ?>" required/>
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input type="number" name="phoneNumber" id="phoneNumber" value="<?php echo "$phoneNumber" ?>" required/>
            </td>
        </tr>
    </table>
    <?php
        if (isset($_GET['change'])) {
            echo "<h5 style=\"color:red\">Customer info has not been changed!</h5>";
        } else {
            echo "<br><br>";
        }
    ?>
    <h5 style="color:red">* Email address cannot be changed after account registration</h5>
    <input type="submit" name="submit_btn" id="submit_btn" value="Update" />
    <input type="button" value="Cancel" onclick="window.location.href='profile.php';">
    <input type="button" value="Delete" onclick="window.location.href='profile.php';">
</form>
<br>
<a href="updateProfile.php?updatePassword=true">Click here if you would like to update your password</a>

<?php
    if (isset($_GET['updatePassword'])) {
?>
    <form action="updatePassword.php" name="Profile" method="post">
        <table border="1" width="100%">
            <tr>
                <td>Email</td>
                <td>
                    <input type="Email" name="email" id="email" value="<?php echo "$customerEmail" ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td>Old Password</td>
                <td>
                    <input type="password" name="oldPassword" id="oldPassword" value="" required/>
                </td>
            </tr>
            <tr>
                <td>New Password</td>
                <td>
                    <input type="password" name="newPassword" id="newPassword" value="" required/>
                </td>
            </tr>
            <tr>
                <td>Comfirm New Password</td>
                <td>
                    <input type="password" name="confirmPassword" id="confirmPassword" value="" required/>
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" name="submit_btn" id="submit_btn" value="Update" />
        <input type="button" value="Cancel" onclick="window.location.href='profile.php';">
    </form>
<?php
    }
?>
</body>
</html>
