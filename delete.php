<?php
require 'config.php';
$type = $_GET['type'];
if(isset($type)){
    if($type == "product"){
        $p_id = $_GET['product_id'];
        if (isset($p_id)){
            $img = $con->query("SELECT image_path FROM products WHERE product_id = " . $p_id);
            $arr = $img->fetch(PDO::FETCH_ASSOC);
            unlink($arr['image_path']);
            $con->exec("DELETE FROM products WHERE product_id = " . $p_id);
            header('location:product.php');
        }
    }
    elseif($type == "branch"){
        $b_id = $_GET['branch_id'];
        if (isset($b_id)){
            $b_name = $_GET['b_name'];
            if(isset($b_name) && $b_name != "Main Bransh"){
                $con->exec("DELETE FROM branches WHERE branch_id = " . $b_id);
                header('location:Branches.php');
            }else{
                $e = "You can't delete the main branch";
                header('location:Branches.php?e='.$e);
            }
        }
    } 
}
?>
