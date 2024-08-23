<?php
$host = 'localhost';
$db = 'database_p';
$user = 'root';
$pass = '';

try {

    $con = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
  } catch (PDOException $error) {
    echo "Failed: " . $error->getMessage();
  }

?>