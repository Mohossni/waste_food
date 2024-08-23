<?php
session_start();
$tax = $_SESSION['TAX_NUM'];

if(!isset($tax)){
    header('location:index.php');
}
require 'config.php';

$code = $_GET['order_id'];

if(!isset($code)){
    header('location:index.php');
}

$action = $_GET['action'];

if(isset($action)){
    if($action == 'Accept'){
        $result = $con->query("SELECT * FROM orders WHERE track_code = '$code'");
        $get = $result->fetch(PDO::FETCH_ASSOC);
        $product_id = $get['product_id'];

        $sql = "
            START TRANSACTION;

            UPDATE orders SET status = 'Prepartion' 
            WHERE track_code = '$code';

            UPDATE products SET available = available - 1 
            WHERE product_id = $product_id;

            COMMIT;
        ";
        $con->exec($sql);
        header('location:Requests.php');

    }elseif($action == 'Reject'){
        $sql =  "UPDATE orders SET status = 'Rejected' WHERE track_code = '$code'";
        $con->exec($sql);
        header('location:Requests.php');
    }elseif($action == 'Done'){
        $sql =  "UPDATE orders SET status = 'Ready To Pick Up' WHERE track_code = '$code'";
        $con->exec($sql);
        header('location:Prepartion.php');
    }
}else{
    header('location:index.php');
}


?>