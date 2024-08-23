<?php
session_start();
unset($_SESSION['TAX_NUM']);
session_destroy();
header('location:index.php');
?>