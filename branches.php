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
  <title>Add product</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<header>
  <a href="#" class=" logo">P-LINK</a>
</header>
<body>
    <section class="container">
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
            <h2 class="form-title">Add Branch</h2>
            <form  action="add_branch.php" method="POST" id="branch-form">
                <div class="donor-info">
                <div class=" flexx">
                    <div class="user-input-box">
                        <input type="text"
                            id="name-of-branch"
                            name="branch-name"
                            required         
                            autofocus
                            placeholder="Enter Branch Name"/>
                    </div>

                    <div class="user-input-box">
                    
                        <input type="text"
                            id="branch-number"
                            name="branch-number"
                            required
                            placeholder="Branch Contact Number"/>
                    </div> 
                  </div>
                    <label for="Governorate">Governorate :</label>
                    <div class="user-input-box select"> 
                    <select id="Governorate" name="Governorate" onchange="updateSecondList()">
                    <option value="select">select</option>
                    <option value="cairo">Cairo</option>
                    <option value="alexandria">Alexandria</option>
                    <option value="giza">Giza</option>
                    <option value="assiut">Asyut</option>
                    <option value="aswan">Aswan</option>
                    <option value="luxor">Luxor</option>
                    <option value="redsea">Red Sea</option>
                    <option value="beheira">Beheira</option>
                    <option value="benisuef">Beni Suef</option>
                    <option value="port said">Port Said</option>
                    <option value="damietta">Damietta</option>
                    <option value="sohag">Sohag</option>
                    <option value="suez">Suez</option>
                    <option value="sharqia">Sharqia</option>
                    <option value="northsinai">North Sinai</option>
                    <option value="southsinai">South Sinai</option>
                    <option value="kafrelsheikh">Kafr El Sheikh</option>
                    <option value="matrouh">Matrouh</option>
                    <option value="monufia">Monufia</option>
                    <option value="qalyubia">Qalyubia</option>
                    <option value="fayoum">Fayoum</option>
                    </select>
                    </div>
                
                    <label for="City">City :</label>
                    <div class="user-input-box">
                    <select id="City" name="City"></select>
                    </div>
                    <label for="address">Address :</label>
                    <div class="user-input-box">
                    <input type="text"
                        id="address"
                        name="address"
                        required
                        placeholder="Address"/>
                    </div>
                <div class="form-submit-btn">
                    <button type="submit" name="submit">Add Branch</button>
                </div>
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

        <script>
            function updateSecondList() {
                var firstList = document.getElementById("Governorate");
                var secondList = document.getElementById("City");

                // Clear existing options
                secondList.innerHTML = "";

                // Define subcategories based on the selected category
                var subcategories = [];
                if (firstList.value === 'cairo') {
                  subcategories = ['Cairo', 'Giza', 'Shubra El Kheima', 'Helwan', '6th of October City', 'Nasr City', 'Heliopolis', 'Maadi', 'Zamalek', 'Mohandessin', 'Dokki', 'Agouza', 'Imbaba', 'Maadi Degla', 'New Cairo', 'Sheikh Zayed City', 'Al Rehab City', 'Madinaty', 'Mokattam', 'Ain Shams'];
                } else if (firstList.value === 'alexandria') {
                  subcategories = ['Alexandria', 'Borg El Arab', 'Abu Qir', 'Montaza', 'Miami', 'Sidi Gaber', 'Raml Station', 'Smouha', 'Sporting', 'El Shatby', 'Moharam Bek', 'Al Ibrahimiyya', 'Al Mansheya', 'El Raml', 'Kafr Abdo'];
                } else if (firstList.value === 'giza') {
                  subcategories = ["Giza", "6th of October City", "Sheikh Zayed City", "Haram", "Dokki", "Mohandessin", "Agouza", "Imbaba", "Bulaq", "Giza Square"];
                } else if (firstList.value === 'assiut') {
                  subcategories = subcategories = ['Assiut', 'Abnoub', 'Abu Tig', 'Dayrout', 'El Badari', 'El Qusiya', 'Manfalut', 'New Assiut City', 'Sahel Selim', 'Sidfa', 'Sohag'];
                }

                // Populate the second dropdown with the subcategories
                subcategories.forEach(function(subcategory) {
                  var option = document.createElement("option");
                  option.value = subcategory;
                  option.text = subcategory;
                  secondList.add(option);
                });
              }
        </script>
    
     <table class="product-table">
        <thead>
        <tr>
           <th>Branch Name</th>
           <th>Contact Number</th>
           <th>Address</th>
           <th>Action</th>
        </tr>
       </thead>
         <?php
            $branshes = $con->query("SELECT * FROM branches WHERE taxre_num = '".$tax."'");
            while($row = $branshes->fetch(PDO::FETCH_ASSOC)){
                echo"
                <tbody id='product-table-body'>
                    <td>" . $row['branch_name'] . "</td>
                    <td>0" . $row['branch_phone'] . "</td>
                    <td>" . $row['governorate'] .", ". $row['city'] .", ". $row['address'] . "</td> 
                    <td>
                        <button onclick=\"window.location.href='delete.php?branch_id=".$row['branch_id']."&b_name=".$row['branch_name']."&type=branch';\" class='delete-button' >Delete</button>
                    </td>
                </tbody>
                ";
                }
        ?>
   </table>
    </section>
</body>
</html>