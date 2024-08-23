<?php
require 'config.php';

session_start();
$tax = $_SESSION['TAX_NUM'];

if(!isset($tax)){
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>P-LINK</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<header>
  <a href="#" class=" logo">P-LINK</a>
</header>
<body>
  <div class="container">
    <div class="sidebar">
      
      <!-- Sidebar content here -->
      <!-- <h3>Dashboard</h3> -->
      <button onclick="window.location.href='product.php';" class="sidebar-btn">Product</button>
      <button onclick="window.location.href='Requests.php';" class="sidebar-btn">Requests</button>
      <button onclick="window.location.href='prepartion.php';" class="sidebar-btn">In Preparations</button>
      <button onclick="window.location.href='Branches.php';" class="sidebar-btn">Branches</button>
      <button onclick="window.location.href='Logout.php';" class="sidebar-btn">Log Out</button>
    </div>
    <div class="main-content">
      <!-- Main content here -->
      <div class="header">
        <h1> Orders are being prepared </h1>
      </div>
        <table class="request-table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Branches</th>
              <th>Available</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
                $branshes = $con->query("SELECT * FROM branches WHERE taxre_num = '".$tax."'");
                while($row = $branshes->fetch(PDO::FETCH_ASSOC)){
                    $orders = $con->query("SELECT * FROM orders WHERE branch_id = ".$row['branch_id']);           
                    while($row2 = $orders->fetch(PDO::FETCH_ASSOC)){
                      $product_name =  $con->query("SELECT product_name,available FROM products WHERE product_id = ".$row2['product_id']);
                      $row3 = $product_name->fetch(PDO::FETCH_ASSOC);
                      if($row2['status'] == 'Prepartion'){
                    echo"
                    <tr>
                      <td>".$row3['product_name']."</td>
                      <td>".$row['branch_name']."</td>
                      <td>".$row3['available']."</td>
                      <td>
                        <button onclick=\"window.location.href='update.php?order_id=".$row2['track_code']."&action=Done';\" class='accept-btn'>Done</button>
                      </td>
                    </tr>
                    ";}
                    }
                }
            ?>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
  </div>
</body>
</html>

