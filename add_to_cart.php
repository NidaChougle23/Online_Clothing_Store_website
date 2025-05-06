<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $product = array(
        'id' => $product_id,
        'title' => $product_title,
        'price' => $product_price,
        'image' => $product_image,
        'quantity' => 1
    );

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $is_product_in_cart = false;

    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id) {
            $cart_item['quantity']++;
            $is_product_in_cart = true;
            break;
        }
    }

    if (!$is_product_in_cart) {
        $_SESSION['cart'][] = $product;
    }

    // Update the cart count
    $_SESSION['cart_count'] = count($_SESSION['cart']);

    header("Location: cart.php");
}
?>
