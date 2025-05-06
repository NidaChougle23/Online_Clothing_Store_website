<?php
    // Include your database connection file to establish connection
    include('../includes/connect.php'); 

    // Your query logic
    $get_products = "select * from products";
    $result = mysqli_query($con, $get_products);

    if(!$result){
        die("Query Failed: " . mysqli_error($con)); // Optional error handling
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <style>
        .product_image {
            width: 50px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <h3 class="text-center text-success">All Products</h3>
    <hr/>
    <table class="table table-bordered mt-5 text-center">
        <thead>
            <tr>
                <th class="bg-mint-green text-dark">Product ID</th>
                <th class="bg-mint-green text-dark">Product Title</th>
                <th class="bg-mint-green text-dark">Product Image</th>
                <th class="bg-mint-green text-dark">Product Price</th>
                <th class="bg-mint-green text-dark">Avl Quantity</th>
                <th class="bg-mint-green text-dark">Total Sold</th>
                <th class="bg-mint-green text-dark">Status</th>
                <th class="bg-mint-green text-dark">Edit</th>
                <th class="bg-mint-green text-dark">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $number=1;
                while($row = mysqli_fetch_assoc($result)){
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
                    $status = $row['status'];
                    $quantity=$row['quantity'];
                    ?>
                    <tr>
                        <td class='bg-light text-dark'><?php echo "$number"; ?></td>
                        <td class='bg-light text-dark'><?php echo "$product_title"; ?></td>
                        <td class='bg-light text-dark'><?php echo "<img class='product_image' src='./product_images/$product_image1'/>"; ?></td>
                        <td class='bg-light text-dark'><?php echo "$product_price/-"; ?></td>
                        <td class='bg-light text-dark'><?php echo "$quantity"; ?></td>
                        <td class='bg-light text-dark'>
                            <?php
                                $get_count = "select * from orders_pending where product_id=$product_id";
                                $result_count = mysqli_query($con, $get_count);
                                $rows_count = mysqli_num_rows($result_count);
                                echo $rows_count;
                                $number++;
                            ?>
                        </td>
                        <td class='bg-light text-dark'><?php echo "$status"; ?></td>
                        <td class='bg-light'><a href='index.php?edit_products=<?php echo $product_id ?>'><i class='fas fa-edit'></i></a></td>
                        <td class='bg-light'><a href='index.php?delete_products=<?php echo $product_id ?>'><i class='fa fa-trash'></i></a></td>
                    </tr>
                    
                    <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>
