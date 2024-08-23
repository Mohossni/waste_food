<?php
require 'config.php';

session_start();

$tax = $_SESSION['TAX_NUM'];

function isEgyptianNumber(){
    $phoneNumber = $_POST['branch-number'];
    if (preg_match('/^(?:\+20|0)?1[0-2,5]\d{8}$/', $phoneNumber)){
        return true;
    }else{
        return false;
    }
}

if(isset($_POST['submit'])){
    if(isEgyptianNumber()){
        $con->exec("INSERT INTO branches VALUES (NULL, '". $_POST['branch-name']."','". $_POST['Governorate']."','". $_POST['City']."','". $_POST['address']."','". $_POST['branch-number']."','". $tax."');");
        $msg = "Successful added!";
        header('location:Branches.php?e='.$msg);
    }else{
        $msg = "invalid phone number";
        header('location:Branches.php?e='.$msg);
    }
}
?>