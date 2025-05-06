<?php
    include("../includes/connect.php");
    include("../functions/common_function.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files for styles-->
    <link rel="stylesheet" href="../css/style.css"/>
    <style>
        #image-container{
            text-align: center;
        }
        #image-container img{
            width:600px;
            height:600px;
            display:inline-block;
        }
        .card{
            width:400px;
        }
    </style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <img class="logo" src="../img/Logo.png"/>
            <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <ul class="navbar-nav">
            <?php
                    if(isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../user_area/logout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>  Logout</a>
                        </li>";
                    }
                ?>
            </ul>

            </nav>
        </nav>

        <!--second child-->
        <div class="">
            <h1 class="text-center text-danger my-2 p-2">Manage Details</h1>
        </div>

        <!--third child-->
<div class="row">
<div class="sidenav rounded text-center my-5 px-3 col-md-2 bg-dark">
        <div class="admin_image p-3 align-center">
            <a href="index.php"  class="profile-img"><img src="../img/admin.png"></img></a>
            <?php
            if(isset($_SESSION['username'])){
                $username=$_SESSION['username'];
                echo "<h2 class='text-light'>$username</h2>";
            }
            else{
                echo "<script>window.open('./admin_login.php','_self')</script>";
            }
            ?>
            
        </div>
            <ul class="navbar-nav text-light me-auto">
                <li class="nav-item ">
                    <a href="index.php?view_products" class="nav-link my-1">View Products</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?insert_product" class="nav-link my-1">Insert Products</a>
                </li> 
                <li class="nav-item ">
                    <a href="index.php?insert_categories" class="nav-link my-1">Insert Categories</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?view_categories" class="nav-link my-1">View Categories</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?insert_brands" class="nav-link my-1">Insert Brands</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?view_brands" class="nav-link my-1">View Brands</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?list_orders" class="nav-link my-1">All Orders</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?all_payments" class="nav-link my-1">All Payments</a>
                </li>
                <li class="nav-item ">
                    <a href="index.php?view_users" class="nav-link my-1">List Users</a>
                </li>  
                <li class="nav-item ">
                    <a href="index.php?report" class="nav-link my-1">Show Report</a>
                </li> 
            </ul>
        </div>
        <div class="container my-5 col-md-9">
            
        <?php
// Check if any of the GET parameters are set
$showImage = true;

if (isset($_GET['insert_categories'])) {
    include('insert_categories.php');
    $showImage = false;
} elseif (isset($_GET['insert_brands'])) {
    include('insert_brands.php');
    $showImage = false;
} elseif (isset($_GET['insert_product'])) {
    include('insert_product.php');
    $showImage = false;
} elseif (isset($_GET['view_products'])) {
    include('view_products.php');
    $showImage = false;
} elseif (isset($_GET['edit_products'])) {
    include('edit_products.php');
    $showImage = false;
} elseif (isset($_GET['delete_products'])) {
    include('delete_products.php');
    $showImage = false;
} elseif (isset($_GET['view_categories'])) {
    include('view_categories.php');
    $showImage = false;
} elseif (isset($_GET['view_brands'])) {
    include('view_brands.php');
    $showImage = false;
} elseif (isset($_GET['edit_category'])) {
    include('edit_category.php');
    $showImage = false;
} elseif (isset($_GET['edit_brand'])) {
    include('edit_brand.php');
    $showImage = false;
} elseif (isset($_GET['delete_category'])) {
    include('delete_category.php');
    $showImage = false;
} elseif (isset($_GET['delete_brand'])) {
    include('delete_brand.php');
    $showImage = false;
} elseif (isset($_GET['list_orders'])) {
    include('list_orders.php');
    $showImage = false;
} elseif (isset($_GET['delete_order'])) {
    include('delete_order.php');
    $showImage = false;
} elseif (isset($_GET['all_payments'])) {
    include('all_payments.php');
    $showImage = false;
} elseif (isset($_GET['delete_payment'])) {
    include('delete_payment.php');
    $showImage = false;
} elseif (isset($_GET['view_users'])) {
    include('view_users.php');
    $showImage = false;
} elseif (isset($_GET['report'])) {
    include('monthly_report.php');
    $showImage = false;
}

?>

<!-- HTML part for displaying the image -->
<div id="image-container" style="text-align: center;">
    <?php if ($showImage): ?>
        <img src="../img/coder3_admin.png" alt="Your Image" id="display-image">
    <?php endif; ?>
</div>

        </div>
</div>
        
        <!--fourth child-->
        
        </div>
    <!--footer-->
    <?php
        include("../includes/footer.php");
    ?>


    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>