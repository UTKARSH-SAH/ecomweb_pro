<?php
include "authguard.php";
include "../shared/connection.php";

$userid = $_SESSION['userid'];

$sql_result = mysqli_query($conn, "SELECT * FROM cart JOIN product ON cart.pid = product.pid WHERE userid = $userid");

if (mysqli_num_rows($sql_result) > 0) {
    
    $orderDate = date('Y-m-d H:i:s'); 
    $total = 0;

    
    mysqli_begin_transaction($conn);

    try {
        
        while ($row = mysqli_fetch_assoc($sql_result)) {
            $productId = $row['pid'];
            $productPrice = $row['price'];
            $cartId = $row['cartid'];
            
            $insertOrderQuery = "INSERT INTO `order` (cartid,userid, pid, price, order_date) VALUES ( $cartId ,$userid, $productId, $productPrice, '$orderDate')";
            mysqli_query($conn, $insertOrderQuery);

            
            $total += $productPrice;
        }

        
        mysqli_query($conn, "DELETE FROM cart WHERE userid = $userid");

        
        mysqli_commit($conn);

        
        header("Location: viewcart.php?success=1&total=$total");
        exit();
    } catch (Exception $e) {
        
        mysqli_rollback($conn);
        
        echo "Error placing the order: " . $e->getMessage();
    }
} else {
    
    echo "Your cart is empty. Add items to your cart before placing an order.";
}

mysqli_close($conn);
?>
