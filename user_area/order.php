<?php
include("../includes/connect.php");
include("../functions/common_function.php");
session_start();

// Get the logged-in username from the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch the user_id and address using the username
    $user_query = "SELECT * FROM user_table WHERE username='$username'";
    $result_user = mysqli_query($con, $user_query);
    $row_user = mysqli_fetch_array($result_user);

    if ($row_user) {
        $user_id = $row_user['user_id'];  // Get the user_id
        $address = $row_user['user_address'];  // Get the address
    }
} else {
    // If the user is not logged in, redirect them to the login page
    echo "<script>alert('You need to log in first.')</script>";
    echo "<script>window.open('user_login.php', '_self')</script>";
    exit();
}

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);

// First, check if all products have enough stock
$stock_available = true;  // Flag to track stock availability

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity'];  // Get the quantity from the cart

    // Fetch product details from the database
    $select_products = "SELECT * FROM products WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_products);
    $row_product_price = mysqli_fetch_array($run_price);

    if ($row_product_price) {
        $available_quantity = $row_product_price['quantity'];  // Available quantity

        // Check if enough stock is available for this product
        if ($available_quantity < $quantity) {
            echo "<script>alert('Insufficient stock for product ID: $product_id. Available: $available_quantity, Requested: $quantity.')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
            exit();  // Stop further processing if stock is insufficient
        }
    }
}

// Now reduce stock for each product, only after confirming all stock is available
mysqli_data_seek($result_cart_price, 0); // Reset the result pointer for the second loop

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity'];

    // Fetch product details again for the stock reduction
    $select_products = "SELECT * FROM products WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_products);
    $row_product_price = mysqli_fetch_array($run_price);

    if ($row_product_price) {
        $available_quantity = $row_product_price['quantity'];

        // Reduce the product quantity in the products table
        $new_quantity = $available_quantity - $quantity;
        $update_product_query = "UPDATE products SET quantity='$new_quantity' WHERE product_id='$product_id'";
        mysqli_query($con, $update_product_query);
    }

    // Calculate the total price for this product and add to total price
    $product_price = $row_product_price['product_price'];
    $total_price += $product_price * $quantity;
}

// Insert order details (including the user's address)
$insert_orders = "INSERT INTO user_orders (user_id, amount_due, invoice_number, total_products, address, order_date, order_status) 
                  VALUES ($user_id, $total_price, $invoice_number, $count_products, '$address', NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);

if ($result_query) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

// Insert into pending orders
$cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
$run_cart = mysqli_query($con, $cart_query);

while ($row_cart = mysqli_fetch_array($run_cart)) {
    $product_id = $row_cart['product_id'];
    $quantity = $row_cart['quantity'];  // Use the quantity from the cart

    $insert_pending_orders = "INSERT INTO orders_pending (user_id, invoice_number, product_id, quantity, order_status) 
                               VALUES ($user_id, $invoice_number, $product_id, $quantity, '$status')";
    mysqli_query($con, $insert_pending_orders);
}

// Empty the cart after successful order
$empty_cart = "DELETE FROM cart_details WHERE ip_address='$get_ip_address'";
mysqli_query($con, $empty_cart);

?>
