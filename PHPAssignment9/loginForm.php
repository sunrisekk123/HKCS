<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="loginForm.css">
</head>
<body>
<?php
    if (isset($_COOKIE['emailOrId'])) {
        $emailOrId = $_COOKIE['emailOrId'];
    } else {
        $emailOrId = "";
    }

    if (isset($_COOKIE['pwd'])) {
        $pwd = $_COOKIE['pwd'];
    } else {
        $pwd = "";
    }

    if (isset($_COOKIE['remember'])) {
        $remember = "checked";
    } else {
        $remember = "";
    }
?>
<form id="login" action="login.php" method="post" class="dataGroup" >
    <h1>Login</h1>
    <td>
        <input type='radio' name="loginAs" value="customer" checked> As Customer
        <input type='radio' name="loginAs" value="tenant" > As Tenant
    </td>
    <input type="text" name="emailOrId" class="form-control" id="email" placeholder="Email address or ID" value="<?php echo "$emailOrId" ?>" required>
    <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password" value="<?php echo "$pwd" ?>" required>
    <div class="checkbox">
        <label><input type="checkbox" name="remember" value="Remember me" placeholder="Remember me" <?php echo "$remember" ?> > Remember me</label>
    </div>
    <button type="submit" class="btnSubmit" id="btnSubmit">Submit</button>
    <a href="index.php"><button type="button" class="btnCancel" id="btnCancel"  >Cancel </button></a>
</form>
</body>
</html>