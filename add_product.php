<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"]; // file extension allowed

    $fileExtension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        $error = "File Not Allowed!";
        header('location: product.php?e=' . $error);
        exit;
    }

    // Check if the file was uploaded successfully
    if ($_FILES["img"]["error"] != 0 ) {
        $error = "Error uploading file.";
        header('location: product.php?e=' . $error);
        exit;
    }

    $get = $con->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 1;");
    $arr = $get->fetch(PDO::FETCH_ASSOC);
    $new_id = $arr["product_id"];
    $targetFile = "images/". ($new_id + 1) .$_FILES["img"]["name"];

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
        $branchId = $_POST['branch-id'];
        $productName = $_POST['product-name'];
        $availability = $_POST['availability'];

        // Using prepared statement to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO products VALUES (NULL, :branchId, :productName, :availability, :image_path)");
        $stmt->bindParam(':branchId', $branchId);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':image_path', $targetFile);
        $stmt->execute();
        header('location: product.php');
    } else {
        $error = "Error moving uploaded file.";
        header('location: product.php?e=' . $error);
    }
}
?>