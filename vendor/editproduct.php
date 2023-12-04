<?php
include "authguard.php";
include "menu.html";
include "../shared/connection.php";

if (isset($_GET['pid'])) {
    $product_id = $_GET['pid'];

    
    $query = "SELECT * FROM product WHERE pid = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        
        if ($product['uploaded_by'] == $_SESSION['userid']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                $newName = $_POST['name'];
                $newPrice = $_POST['price'];
                $newDescription = $_POST['description'];

                

                $updateQuery = "UPDATE product SET name = '$newName', price = $newPrice, detail = '$newDescription' WHERE pid = $product_id";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "Product updated successfully!";
                } else {
                    echo "Error updating product: " . mysqli_error($conn);
                }
            }

            
            echo "<div style='text-align: center;'>";
            echo "<fieldset style='width: 50%; margin: 10 auto; padding: 25px; background-color:#f4f4f4;'>";
            echo "<legend>Edit Product</legend>";
            echo "<form method='POST' action='editproduct.php?pid=$product_id'>";
            echo "<label for='name'>Name:</label><br>";
            echo "<input type='text' name='name' id='name' value='" . $product['name'] . "'><br>";
            echo "<label for='price'>Price:</label><br>";
            echo "<input type='text' name='price' id='price' value='" . $product['price'] . "'><br>";
            echo "<label for='description'>Description:</label><br>";
            echo "<textarea name='description' id='description'>" . $product['detail'] . "</textarea><br><br>";
            echo "<input type='submit' value='Save Changes'>";
            echo "</form>";
            echo "</fieldset>";
            echo "</div>";
        } else {
           
            echo "You do not have permission to edit this product.";
        }
    } else {
        
        echo "Product not found.";
    }
} else {
    
    echo "Product ID not provided.";
}
