<?php
require 'config.php';
session_start();


$email = $_POST['email'];
$check = $con->query("SELECT taxre_num, email, password FROM business_users WHERE email='$email'");
$arr = $check->fetch(PDO::FETCH_ASSOC);


// Check if $arr is not false before attempting to count its elements
if ( is_array($arr) && count($arr) > 0) {
    if (($arr["email"] === $_POST["email"]) && password_verify($_POST['password'], $arr["password"]) ) {
        $_SESSION['TAX_NUM'] = $arr["taxre_num"];
        header('location: product.php');
        exit;
    } else {
        $msg = "Invalid email or password";
        header('location: index.php?e='.$msg);
        exit;
    }
} else {
    $msg = "You are not registered with us";
    header('location: index.php?e='.$msg);
    exit;
}
?>
