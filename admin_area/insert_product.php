<?php
    include("../includes/connect.php");

    if(isset($_POST['insert_product'])){
        $product_title=$_POST['product_title'];
        $description=$_POST['description'];
        $product_keywords=$_POST['product_keywords'];
        $product_brands=$_POST['product_brands'];
        $product_section=$_POST['product_section'];
        $product_categories=$_POST['product_categories'];
        //accessing images
        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];
        //accessing images temp name
        $temp_image1=$_FILES['product_image1']['tmp_name'];
        $temp_image2=$_FILES['product_image2']['tmp_name'];
        $temp_image3=$_FILES['product_image3']['tmp_name'];
        //
        $product_price=$_POST['product_price'];
        $quantity=$_POST['quantity'];
        $product_status="True";
        
        //checking empty condition
        if($product_title=='' or $description=='' or $product_keywords=='' or $product_brands=='' or $product_section=='' or $product_categories=='' or $product_price=='' or $temp_image1=='' or $temp_image2=='' or $temp_image3==''){
            echo "<script>alert('Please fill All the required fields')</script>";
            exit();
        }
        else
        {
            move_uploaded_file($temp_image1,"./product_images/$product_image1");
            move_uploaded_file($temp_image2,"./product_images/$product_image2");
            move_uploaded_file($temp_image3,"./product_images/$product_image3");
            //insert query
            $insert_products="insert into products (product_title, product_desc, product_keywords, brand_id, section_id, category_id, product_image1, product_image2, product_image3, product_price, quantity, date, status) values('$product_title','$description','$product_keywords',$product_brands,$product_section,$product_categories,'$product_image1','$product_image2','$product_image3',$product_price, $quantity, NOW(),'$product_status')";
            $result_query=mysqli_query($con,$insert_products);
            if($result_query){
                echo "<script>alert('Successfully inserted the product')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files for styles-->
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>

    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert Product</h1>
        <hr/>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4">
                <label for="product-title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required/>
            </div>

            <!--description-->
            <div class="form-outline mb-4">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required/>
            </div>

            <!--keywords-->
            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product Keyword" autocomplete="off" required/>
            </div>

            <!--brands-->
            <div class="form-outline mb-4">
                <select name="product_brands" id="" class="form-select product_brands" required>
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

            <!--section-->
            <div class="form-outline mb-4">
                <select name="product_section" id="" class="form-select product_section" required>
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

            <!--categories-->
            <div class="form-outline mb-4">
                <select name="product_categories" id="" class="form-select product_categories" required>
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


            <!--img1-->
            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"  autocomplete="off" required/>
            </div>

            <!--img2-->
            <div class="form-outline mb-4">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"  autocomplete="off" required/>
            </div>

            <!--img3-->
            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"  autocomplete="off" required/>
            </div>

            <!--Price-->
            <div class="form-outline mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off" required/>
            </div>

            <!--Quantity-->
            <div class="form-outline mb-4">
                <label for="quantity" class="form-label">Product Quantity</label>
                <input type="text" name="quantity" id="product_price" class="form-control" placeholder="Enter Product Quantity" autocomplete="off" required/>
            </div>

            <!--insert product button-->
            <div class="form-outline mb-4">
                <input type="submit" name="insert_product" id="insert_product" class="bg-mint-green text-dark fw-bold border-0 btn btn-outline-dark p-2" value="Insert Product"/>
            </div>

        </form>

    </div>

    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>