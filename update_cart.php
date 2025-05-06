<?php
include("includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $ip_address = $_POST['ip_address'];

    $query = "SELECT product_price FROM products WHERE product_id='$product_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $price = $row['product_price'];

    // Calculate the new price based on the updated quantity
    $new_price = $price * $quantity;

    // Update the quantity in the cart
    $update_cart_query = "UPDATE cart_details SET quantity='$quantity' WHERE product_id='$product_id' AND ip_address='$ip_address'";
    mysqli_query($con, $update_cart_query);

    // Recalculate the total price of the cart
    $cart_query = "SELECT cd.product_id, cd.quantity, p.product_price FROM cart_details cd JOIN products p ON cd.product_id = p.product_id WHERE cd.ip_address='$ip_address'";
    $cart_result = mysqli_query($con, $cart_query);
    $total_price = 0;

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $total_price += $cart_row['product_price'] * $cart_row['quantity'];
    }

    // Return new product price and updated total price in JSON format
    echo json_encode([
        'new_price' => $new_price,
        'total_price' => $total_price
    ]);
}
