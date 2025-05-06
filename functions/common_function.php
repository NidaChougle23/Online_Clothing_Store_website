<?php
//include("./includes/connect.php");

//getting products
function getproducts(){
global $con;

//condition to check isset or not
if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
        if(!isset($_GET['section'])){
            $select_query="select * from products order by rand() limit 0,100";
            $result_query=mysqli_query($con,$select_query);
            //$row=mysqli_fetch_assoc($result_query);
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                //$prod_id=$row['product_keywords'];
                $product_image1=$row['product_image1'];
                //$prod_id=$row['product_image2'];
                //$prod_id=$row['product_image3'];
                $product_price=$row['product_price'];
                $quantity=$row['quantity'];
                $brand_id=$row['brand_id'];
                $section_id=$row['section_id'];
                $category_id=$row['category_id'];
                echo "<div class='col-md-4 mb-4'>
                        <div class='card' >
                            <img src='./admin_area/product_images/$product_image1' class='mt-2 card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_desc</p>
                                <p>Price: <b>$product_price</b>/-</p>
                                <p>Available Quantity: <span class='fw-bold'>$quantity</span></p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn text-dark bg-mint-green'>View More</a>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
    }
}

//getting unique categories

function get_unique_categories(){
    global $con;

//condition to check isset or not
if(isset($_GET['category'])){
    $category_id=$_GET['category'];
        $select_query="select * from products where category_id=$category_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>No stock for this category.</h2>";
        }
        //$row=mysqli_fetch_assoc($result_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_desc=$row['product_desc'];
            //$prod_id=$row['product_keywords'];
            $product_image1=$row['product_image1'];
            //$prod_id=$row['product_image2'];
            //$prod_id=$row['product_image3'];
            $product_price=$row['product_price'];
            $brand_id=$row['brand_id'];
            $section_id=$row['section_id'];
            $category_id=$row['category_id'];
            echo "<div class='col-md-4 mb-4'>
                    <div class='card' >
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_desc</p>
                            <p>Price: <b>$product_price</b>/-</p><br/>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn bg-mint-green'>View More</a>
                        </div>
                    </div>
                </div>";
            }
        }
}

//getting unique brands

function get_unique_brands(){
    global $con;

//condition to check isset or not
if(isset($_GET['brand'])){
    $brand_id=$_GET['brand'];
        $select_query="select * from products where brand_id=$brand_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>No stock of this Brand is available.</h2>";
        }
        //$row=mysqli_fetch_assoc($result_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_desc=$row['product_desc'];
            //$prod_id=$row['product_keywords'];
            $product_image1=$row['product_image1'];
            //$prod_id=$row['product_image2'];
            //$prod_id=$row['product_image3'];
            $product_price=$row['product_price'];
            $brand_id=$row['brand_id'];
            $section_id=$row['section_id'];
            $category_id=$row['category_id'];
            echo "<div class='col-md-4 mb-4'>
                    <div class='card' >
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_desc</p>
                            <p>Price: <b>$product_price</b>/-</p><br/>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn bg-mint-green'>View More</a>
                        </div>
                    </div>
                </div>";
            }
        }
}

//getting unique section

function get_unique_section(){
    global $con;

//condition to check isset or not
if(isset($_GET['section'])){
    $section_id=$_GET['section'];
        $select_query="select * from products where section_id=$section_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>No stock of this Section is available.</h2>";
        }
        //$row=mysqli_fetch_assoc($result_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_desc=$row['product_desc'];
            //$prod_id=$row['product_keywords'];
            $product_image1=$row['product_image1'];
            //$prod_id=$row['product_image2'];
            //$prod_id=$row['product_image3'];
            $product_price=$row['product_price'];
            $brand_id=$row['brand_id'];
            $section_id=$row['section_id'];
            $category_id=$row['category_id'];
            echo "<div class='col-md-4 mb-4'>
                    <div class='card' >
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_desc</p>
                            <p>Price: <b>$product_price</b>/-</p><br/>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn bg-mint-green'>View More</a>
                        </div>
                    </div>
                </div>";
            }
        }

    }

    function getsection_nav(){
        global $con;
        $select_section="select * from section";
        $result_section=mysqli_query($con,$select_section);
        //$row_data=mysqli_fetch_assoc($result_section);
        while($row_data=mysqli_fetch_assoc($result_section)){
            $section_title=$row_data['section_title'];
            $section_id=$row_data['id'];
            echo "<li class='nav-item'>
                <a onclick='myFunction()' href='index.php?section=$section_id' class='nav-link'>$section_title</a>
                </li>";
        }
    }

//displaying section in sidenav

function getsection(){
    global $con;
    $select_section="select * from section";
    $result_section=mysqli_query($con,$select_section);
    //$row_data=mysqli_fetch_assoc($result_section);
    while($row_data=mysqli_fetch_assoc($result_section)){
        $section_title=$row_data['section_title'];
        $section_id=$row_data['id'];
        echo "<li class='nav-item'>
            <a onclick='myFunction()' href='index.php?section=$section_id' class=' nav-link'>$section_title</a>
            </li>";
    }
}


//displaying brands in sidenav

function getbrands(){
    global $con;
    $select_brands="select * from brands";
    $result_brand=mysqli_query($con,$select_brands);
    //$row_data=mysqli_fetch_assoc($result_brands);
    while($row_data=mysqli_fetch_assoc($result_brand)){
        $brand_title=$row_data['brand_title'];
        $brand_id=$row_data['id'];
        echo "<li class='nav-item'>
            <a href='index.php?brand=$brand_id' class=' nav-link'>$brand_title</a>
            </li>";
    }
}


//categories in sidenav
function getcategory(){
    global $con;
    $select_categories="select * from categories";
    $result_category=mysqli_query($con,$select_categories);
    while($row_data=mysqli_fetch_assoc($result_category)){
        $category_title=$row_data['category_title'];
        $category_id=$row_data['id'];
        echo "<li class='nav-item'>
            <a href='index.php?category=$category_id' class=' nav-link'>$category_title</a>
            </li>";
    }
}

//searching products

function search_products(){
    global $con;
    if(isset($_GET['search_data_product'])){
        $search_dat_value=$_GET['search_data'];
    
//condition to check isset or not

            $search_query="select * from products where product_keywords like '%$search_dat_value%'";
            $result_query=mysqli_query($con,$search_query);
            $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>No outfits of this category is available.</h2>";
        }
            //$row=mysqli_fetch_assoc($result_query);
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_desc=$row['product_desc'];
                //$prod_id=$row['product_keywords'];
                $product_image1=$row['product_image1'];
                //$prod_id=$row['product_image2'];
                //$prod_id=$row['product_image3'];
                $product_price=$row['product_price'];
                $brand_id=$row['brand_id'];
                $section_id=$row['section_id'];
                $category_id=$row['category_id'];
                echo "<div class='col-md-4 mb-4'>
                        <div class='card' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_desc</p>
                                <p>Price: <b>$product_price</b>/-</p><br/>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn text-dark bg-mint-green'>View More</a>
                            </div>
                        </div>
                    </div>";
                }
            }
        }

        function view_details(){
            global $con;

            //condition to check isset or not
            if(isset($_GET['product_id'])){
                if(!isset($_GET['category'])){
                    if(!isset($_GET['brand'])){
                        if(!isset($_GET['section'])){
                            $product_id=$_GET['product_id'];
                            $select_query="select * from products where product_id=$product_id";
                            $result_query=mysqli_query($con,$select_query);
                            //$row=mysqli_fetch_assoc($result_query);
                            while($row=mysqli_fetch_assoc($result_query)){
                                $product_id=$row['product_id'];
                                $product_title=$row['product_title'];
                                $product_desc=$row['product_desc'];
                                $product_image1=$row['product_image1'];
                                $product_image2=$row['product_image2'];
                                $product_image3=$row['product_image3'];
                                $product_price=$row['product_price'];
                                $quantity=$row['quantity'];
                                $brand_id=$row['brand_id'];
                                $section_id=$row['section_id'];
                                $category_id=$row['category_id'];

                                echo "<div class='row'>
                                <div class='col-md-5 view-more'>
                                        <img src='./admin_area/product_images/$product_image1' class='img-fluid mb-2' alt='$product_title'>
                                        <img src='./admin_area/product_images/$product_image2' class='img-fluid mb-2' alt='$product_title'>
                                        <img src='./admin_area/product_images/$product_image3' class='img-fluid' alt='$product_title'>
                                    </div>
                                    
                                    <div class='col-md-6'>
                                        <h1>$product_title</h1>
                                        <p>$product_desc</p>
                                        <p>Price: <b>$product_price</b>/-</p><br/>
                                        <p>Available Quantity: <span class='fw-bold'>$quantity</span></p>
                                        <a href='product_details.php?add_to_cart=$product_id' class='btn btn-primary'>add to cart</a>
                                    </div>
                                    </div>
                                    
                                        
                                    ";
                            }
                        }
                    }
                }
            }
        }

        function getIPAddress() {  
            //whether ip is from the share internet  
             if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                        $ip = $_SERVER['HTTP_CLIENT_IP'];  
                }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
             }  
        //whether ip is from the remote address  
            else{  
                     $ip = $_SERVER['REMOTE_ADDR'];  
             }  
             return $ip;  
        }  
        
        

        //cart function
        function cart() {
            if (isset($_GET['add_to_cart'])) {
                global $con;
                $ip = getIPAddress();
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Get user_id from session
                $get_product_id = $_GET['add_to_cart'];
                
                $product_query = "SELECT quantity FROM products WHERE product_id='$get_product_id'";
                $product_result = mysqli_query($con, $product_query);
                $product_data = mysqli_fetch_assoc($product_result);
                $available_quantity = $product_data['quantity'];

                $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id=$get_product_id";
                $result_query = mysqli_query($con, $select_query);
                $num_of_rows = mysqli_num_rows($result_query);
        
                if ($num_of_rows > 0) {
                    echo "<script>alert('This item is already added to cart')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                } 
                else {
                    // Ensure $user_id is not null before inserting
                    if ($user_id !== null) {
                        if ($available_quantity > 0) {
                            $insert_query = "INSERT INTO cart_details (user_id, product_id, ip_address, quantity) VALUES ($user_id, $get_product_id, '$ip', 1)";
                            $result_query = mysqli_query($con, $insert_query);
                            $new_quantity = $available_quantity - 1;
                            $update_product_query = "UPDATE products SET quantity='$new_quantity' WHERE product_id='$get_product_id'";
                            mysqli_query($con, $update_product_query);
                            echo "<script>alert('This item is added to cart')</script>";
                            echo "<script>window.open('index.php','_self')</script>";
                    
                        } else {
                            echo "<script>alert('Sorry, this product is out of stock.')</script>";
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                    }
                    else{
                        echo "<script>alert('Please log in to add items to cart.')</script>";
                        echo "<script>window.open('./user_area/user_login.php','_self')</script>";
                    }
                        
                    }
                }
            }
        

        
        

        //function to get cart item number
        function cart_item(){
            if(isset($_GET['add_to_cart'])){
                global $con;
                $ip=getIPAddress();
                $select_query="select * from cart_details where ip_address='$ip' ";
                $result_query=mysqli_query($con,$select_query);
                $count_cart_items=mysqli_num_rows($result_query);
            }
            else{
                global $con;
                $ip=getIPAddress();
                $select_query="select * from cart_details where ip_address='$ip'";
                $result_query=mysqli_query($con,$select_query);
                $count_cart_items=mysqli_num_rows($result_query);
            }
            echo "$count_cart_items";
        }
    
//total price function
        function total_cart_price(){
            global $con;
            $get_ip_add=getIPAddress();
            $total_price=0;
            $cart_query="Select * from cart_details where ip_address='$get_ip_add'";
            $result=mysqli_query($con,$cart_query);
            while($row=mysqli_fetch_array($result)){
                $product_id=$row['product_id'];
                $select_products="Select * from products where product_id='$product_id'";
                $result_product=mysqli_query($con,$select_products);
                while($row_product_price=mysqli_fetch_array($result_product)){
                    $product_price=array($row_product_price['product_price']);
                    $product_values=array_sum($product_price);
                    $total_price+=$product_values;
                }
            } 
            echo "$total_price";
        }

    // get user order details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="Select * from user_table where username='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="Select * from user_orders where user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='mt-5 text-center text-success'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <a href='profile.php?my_orders'><h6 class='text-center text-dark'>My Orders</h6></a>";
                    }
                    else{
                        echo "<h3 class='text-center text-paradise-pink mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-success text-decoration-none'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}

?>