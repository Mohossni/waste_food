<?php
session_start();
if(isset($_SESSION['TAX_NUM'])){
    header('location: product.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-LINK</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>

    <div class="wrapper">
        <form action="login.php" method="POST">
            <h2>Login Here</h2>
            <div class="input-field">
                <input type="text" name="email" required>
                <label>Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Enter your password</label>
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
            </div>
            <button type="submit">Log In</button>
            <div class="register">
                <p>Don't have an account? <a href="../register.php">Register</a></p>
                <br>
                <p><?php if(isset($_GET['e'])){ echo $_GET['e']; } ?></p>
            </div>
        </form>
    </div>

    /body>
</html>