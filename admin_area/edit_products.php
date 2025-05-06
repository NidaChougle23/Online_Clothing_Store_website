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

<?php
    if(isset($_GET['edit_products'])){
        $edit_id=$_GET['edit_products'];
        $get_data="select * from products where product_id=$edit_id";
        $result=mysqli_query($con,$get_data);
        $row=mysqli_fetch_assoc($result);
        $product_title=$row['product_title'];
        $product_desc=$row['product_desc'];
        $product_keywords=$row['product_keywords'];
        $product_brand=$row['brand_id'];
        $product_section=$row['section_id'];
        $product_category=$row['category_id'];
        $product_image1=$row['product_image1'];
        $product_image2=$row['product_image2'];
        $product_image3=$row['product_image3'];
        $product_price=$row['product_price'];


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .product_image{
            width:50px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Edit Product</h3>
        <hr/>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" id="product_title" name="product_title" class="form-control" value="<?php echo $product_title ?>" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_desc" class="form-label">Product Description</label>
                <input type="text" id="product_desc" name="product_desc" class="form-control" value="<?php echo $product_desc ?>" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" id="product_keywords" name="product_keywords" class="form-control" value="<?php echo $product_keywords ?>" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_brands" class="form-label">Product Brands</label>
                <select name="product_brands" class="form-select">
                    <option value="">Select a Brand</option>
                        <?php
                            $select_query="select * from brands";
                            $result_query=mysqli_query($con,$select_query);
                            while($row=mysqli_fetch_assoc($result_query)){
                                $brand_title=$row['brand_title'];
                                $brand_id=$row['id'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_section" class="form-label">Product Section</label>
                <select name="product_section" class="form-select">
                <option value="">Select a section</option>
                    <?php
                        $select_query="select * from section";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $section_title=$row['section_title'];
                            $section_id=$row['id'];
                            echo "<option value='$section_id'>$section_title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_category" class="form-label">Product Categories</label>
                <select name="product_category" class="form-select">
                <option value="">Select a Category</option>
                    <?php
                        $select_query="select * from categories";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title'];
                            $category_id=$row['id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image1" class="form-label">Product Image1</label>
                <div class="d-flex">
                    <input type="file" id="product_image1" name="product_image1" class="form-control w-90 " required="required">
                    <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_image">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image2" class="form-label">Product Image2</label>
                <div class="d-flex">
                    <input type="file" id="product_image2" name="product_image2" class="form-control w-90 " required="required">
                    <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="product_image">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image3" class="form-label">Product Image3</label>
                <div class="d-flex">
                    <input type="file" id="product_image3" name="product_image3" class="form-control w-90 " required="required">
                    <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="product_image">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo $product_price ?>" required="required">
            </div>

            <div class="w-50 m-auto">
                <input type="submit" name="edit_product" value="Update product" class="btn bg-mint-green px-3 mb-3">
            </div>
            

        </form>
    </div>
    <!--Editing products-->
    <?php
        if(isset($_POST['edit_product'])){
            $product_title=$_POST['product_title'];
            $product_desc=$_POST['product_desc'];
            $product_keywords=$_POST['product_keywords'];
            $product_brands=$_POST['product_brands'];
            $product_section=$_POST['product_section'];
            $product_category=$_POST['product_category'];
            $product_price=$_POST['product_price'];
            
            $product_image1=$_FILES['product_image1']['name'];
            $product_image2=$_FILES['product_image2']['name'];
            $product_image3=$_FILES['product_image3']['name'];
            //accessing images temp name
            $temp_image1=$_FILES['product_image1']['tmp_name'];
            $temp_image2=$_FILES['product_image2']['tmp_name'];
            $temp_image3=$_FILES['product_image3']['tmp_name'];

            //checking for empty fields
            if($product_title=='' or $product_desc=='' or $product_keywords=='' or $product_brand=='' or $product_section=='' or $product_category=='' or $product_price=='' or $temp_image1=='' or $temp_image2=='' or $temp_image3==''){
                echo "<script>alert('Please fill All the required fields')</script>";
            }
            else{
                move_uploaded_file($temp_image1,"./product_images/$product_image1");
                move_uploaded_file($temp_image2,"./product_images/$product_image2");
                move_uploaded_file($temp_image3,"./product_images/$product_image3");
                //update query
                $update_product = "UPDATE products 
                   SET product_title='$product_title',
                       product_desc='$product_desc',
                       product_keywords='$product_keywords',
                       category_id='$product_category',
                       brand_id='$product_brands',
                       section_id='$product_section',
                       product_image1='$product_image1',
                       product_image2='$product_image2',
                       product_image3='$product_image3',
                       product_price='$product_price',
                       date=NOW() 
                   WHERE product_id='$edit_id'";
$result_update = mysqli_query($con, $update_product);
                if($result_update){
                    echo "<script>alert('Product updated successfully')</script>";
                    echo "<script>window.open('./index.php?view_products','_self')</script>";
                }
            }
        }
    ?>
</body>
</html>

