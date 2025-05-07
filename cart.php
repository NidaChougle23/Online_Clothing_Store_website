<?php
    include("includes/connect.php");
    include("functions/common_function.php");
    session_start();
    include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart details</title>
    <!-- Bootstrap css link -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <!-- FontAwsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS files for styles -->
    <link rel="stylesheet" href="css/style.css"/>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function(){
    // Event listener for quantity input change
    $('.qty-input').on('input', function(){
        var quantity = $(this).val();  // Get the updated quantity
        var product_id = $(this).data('product-id');  // Get product ID
        var ip_address = "<?php echo getIPAddress(); ?>";  // Pass the IP address

        // Log to check if the correct data is being sent
        console.log("Product ID: " + product_id + ", Quantity: " + quantity);

        $.ajax({
            url: 'update_cart.php',  // URL to PHP script handling the update
            method: 'POST',
            data: {
                product_id: product_id,
                quantity: quantity,
                ip_address: ip_address
            },
            success: function(response){
                try {
                    var data = JSON.parse(response); // Parse JSON response
                    if(data.new_price && data.total_price) {
                        // Update the price for the specific product
                        $('td.price-cell[data-product-id="' + product_id + '"]').text(data.new_price);
                        // Update the total price in the cart
                        $('#total-price').text(data.total_price);
                    } else if (data.error) {
                        console.error(data.error);
                    }
                } catch(e) {
                    console.error("Invalid JSON response: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error);
            }
        });
    });
});

    </script>

    <style>
        .cart_img img{
            width:50px;
            height:50px;
            object-fit: contain;
        }
        .cart-dark-green {
            color: #004d00; /* Dark Green */
        }

        .cart-yellow {
            color: #ffc107; /* Yellow */
        }

        .cart-blue {
            color: #007bff; /* Blue */
        }
    </style>
</head>
<body>
    
    

        <!--cart function calling-->
        <?php cart(); ?>

        <!--second child-->
        <nav class="navbar navbar-expand-lg bg-light-pink">
            <ul class="navbar-nav me-auto">
            <?php
                if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                    </li>";
                }
            ?>
            
            </ul>
        </nav>

        <!--third child-->
        <div class="container">
            <div class="row">
            <form action="" method="post">
    <table class="table table-border">
        <tbody>
            <?php
            $get_ip_add = getIPAddress();
            $total_price = 0;
            $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if($result_count > 0) {
                echo "<thead>
                        <tr> 
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Operations</th>
                        </tr>
                    </thead>";
                while($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                    $result_product = mysqli_query($con, $select_products);
                    while($row_product_price = mysqli_fetch_array($result_product)) {
                        $product_price = array($row_product_price['product_price']);
                        $price_table = (int) $row_product_price['product_price'];
                        $quantity=$row['quantity'];
                        $product_title = $row_product_price['product_title'];
                        $product_image1 = $row_product_price['product_image1'];
                        $product_values = array_sum($product_price);
                        $total_price += $product_values;
            ?>
            <tr>
                <td><?php echo $product_title; ?></td>
                <td class="cart_img"><img src="admin_area/product_images/<?php echo $product_image1; ?>"/></td>
                <td><input type="number" class="form-input w-50 qty-input" name="qty" min="1"  data-product-id="<?php echo $product_id; ?>" value="1" /></td>
                <td class="price-cell" data-product-id="<?php echo $product_id; ?>"><?php echo $price_table; ?></td>
                
                <!-- Delete functionality wrapped in a form -->
                <td class="d-flex">
                    <form action="cart.php" method="post">
                        <input type="hidden" name="remove_cart" value="<?php echo $product_id; ?>" />
                        <button type="submit" name="remove_btn" class="btn text-danger">
                            <i class="fa-solid fa-trash px-4 py-4"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php
                    }
                }
            } else {
                echo "<h2 class='text-center text-danger'>The cart is empty</h2>";
            }
            ?>
        </tbody>
    </table>

    <div class="d-flex mb-5">
    <?php
        $get_ip_add = getIPAddress();
        $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
        $result = mysqli_query($con, $cart_query);
        $result_count = mysqli_num_rows($result);
        if($result_count > 0){
            echo "<h4 class='px-3'>Subtotal:<strong class='text-info'><span id='total-price'>" . $total_price . "</span>/-</strong></h4>

            <input type='submit' value='Continue Shopping' class='border bg-mint-green px-3 py-2 mx-3' name='continue_shopping'/>
            <button class='border bg-success text-light px-3 py-2'><a href='user_area/payment.php' class='text-light text-decoration-none'>Buy Now</a></button>";
        } else {
            echo "<input type='submit' value='Continue Shopping' class='border bg-mint-green px-3 py-2 mx-3' name='continue_shopping'/>";
        }

        if(isset($_POST['continue_shopping'])){
            echo "<script>window.open('index.php','_self')</script>";
        }
    ?>
    </div>
</form>

                <?php
                function remove_cart_item() {
                    global $con;
                    if (isset($_POST['remove_btn'])) {
                        $remove_id = $_POST['remove_cart'];  // Get the product ID from the form
                        $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id";
                        $run_delete = mysqli_query($con, $delete_query);
                        if ($run_delete) {
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }
                }
                
                // Call the remove_cart_item function to handle form submissions
                if (isset($_POST['remove_btn'])) {
                    remove_cart_item();
                }
                ?>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzXr0SuL+4L2Jp2mPwTxpIChl2j50Fn27NXB6Zv7fVor" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-QF5om5ww5SYn8IgoX+1QFoa6K9K1vKoA3EzlGOevV0NCHk/hCf4Ksl0TbtmK6dno" crossorigin="anonymous"></script>

</body>
</html>

