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
  <title>P-LINK Products</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<header>
  <a href="#" class=" logo">P-LINK</a>
</header>
<body>
    <section class="container1">
      <div class="sidebar">
        <button onclick="window.location.href='product.php';" class="sidebar-btn">Product</button>
        <button onclick="window.location.href='Requests.php';" class="sidebar-btn">Requests</button>
        <button onclick="window.location.href='prepartion.php';" class="sidebar-btn">In Preparations</button>
        <button onclick="window.location.href='Branches.php';" class="sidebar-btn">Branches</button>
        <button onclick="window.location.href='Logout.php';" class="sidebar-btn">Log Out</button>
      </div>

      <div class="main-content">
        <div class=" background">
        
            <div class="black">
            
            <div class="Container">
            <h2 class="form-title">Add Product</h2>
            <form  action="add_product.php" method="POST" id="product-form" enctype="multipart/form-data">
                <div class="donor-info">
                <div class=" flexx">
                    <div class="user-input-box">
                        <input type="text"
                            id="name-of-product"
                            name="product-name"
                            required         
                            autofocus
                            placeholder="Enter Product Name"/>
                    </div>
                    <div class="user-input-box">
                        <label for="img">Select image:</label>
                        <input type="file" id="img" name="img" required accept="image/*">
                    </div>
                    
                    <div class="user-input-box">
                    
                        <input type="number"
                            id="availability"
                            name="availability"
                            required
                            placeholder="Enter Number Available product"/>
                    </div>                    
                </div>
                    <div id="branch_id" >
                        <div class="user-input-box">
                        <select id="branch-name" name="branch-id" required>
                            <option>Select Branch</option> 
                            <?php 
                                $branshes = $con->query("SELECT * FROM branches WHERE taxre_num = '".$tax."'");
                                while($row = $branshes->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$row['branch_id']."'>".$row['branch_name']."</option>";

                                }
                            ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-submit-btn">
                    <button type="submit" name="submit">Add Product</button>
                </div>
            </form>
            <pre><?php 
                if(isset($_GET['e'])){
                    echo $_GET['e'];
                }
            ?></pre>
            </div>
        </div>
    
     </div>
     <table class="product-table">
        <thead>
        <tr>
           <th>Product Name</th>
           <th>Branch Name</th>
           <th>Available</th>
           <th>Action</th>
        </tr>
       </thead>
        <?php
            $branshes = $con->query("SELECT * FROM branches WHERE taxre_num = '".$tax."'");
            while($row = $branshes->fetch(PDO::FETCH_ASSOC)){
                $product = $con->query("SELECT * FROM products WHERE branch_id = ".$row['branch_id']);
                while($row2= $product->fetch(PDO::FETCH_ASSOC)){
                echo"
                <tbody id='product-table-body'>
                    <td>" . $row2['product_name'] . "</td>
                    <td>" . $row['branch_name'] . "</td>
                    <td>" . $row2['available'] . "</td> 
                    <td>
                        <button onclick=\"window.location.href='delete.php?product_id=".$row2['product_id']."&type=product';\" class='delete-button' >Delete</button>
                    </td>
                </tbody>
                ";
                }
            }
        ?>
   </table>
      </div>
    </section>
</body>
</html>

