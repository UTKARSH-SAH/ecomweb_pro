<?php
include "authguard.php";
include "menu.html";
include "../shared/connection.php";

$vendorId = $_SESSION['userid'];


$sql_result = mysqli_query($conn, "SELECT * FROM `order` JOIN product ON `order`.pid = product.pid WHERE product.uploaded_by = $vendorId");

echo "<h1>Order Details</h1>";

if (mysqli_num_rows($sql_result) > 0) {
    echo "<table style='border-collapse: collapse; width: 100%;'>
            <thead>
                <tr>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>Order ID</th>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>User ID</th>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>Product ID</th>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>Product Name</th>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>Product Price</th>
                    <th style='border: 1px solid #000; padding: 8px; background-color: #f0f0f0;'>Order Date</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($sql_result)) {
        $orderId = $row['cartid'];
        $userId = $row['userid'];
        $productId = $row['pid'];
        $productName = $row['name'];
        $productPrice = $row['price'];
        $orderDate = $row['order_date'];

        echo "<tr>
                <td style='border: 1px solid #000; padding: 8px;'>$orderId</td>
                <td style='border: 1px solid #000; padding: 8px;'>$userId</td>
                <td style='border: 1px solid #000; padding: 8px;'>$productId</td>
                <td style='border: 1px solid #000; padding: 8px;'>$productName</td>
                <td style='border: 1px solid #000; padding: 8px;'>$productPrice</td>
                <td style='border: 1px solid #000; padding: 8px;'>$orderDate</td>
            </tr>";
    }

    echo "</tbody>
          </table>";
} else {
    echo "No orders found.";
}

mysqli_close($conn);
?>
