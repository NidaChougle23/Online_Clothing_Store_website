<?php
    include("includes/connect.php");
    include("functions/common_function.php");
    @session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Website</title>
    <!-- Bootstrap css link -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files for styles-->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="bg-soft-light-pink">
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="img/Logo.png" class="logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link text-danger fw-bold" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="display_all.php">All</a>
                    </li>
                    <?php
                    getsection_nav();
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><span class="badge bg-danger"><?php cart_item(); ?></span></a>
                    </li>
                    <?php
                        if(isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                                </li>";
                        }
                        else{
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                                </li>";
                        }
                    ?>
                </ul>
                <form method="get" class="d-flex" role="search p-0">
                    <input id="search" name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button id="isearch" name="search_data_product" class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
                    <!--<input type="submit" id="isearch" class="btn btn-outline-dark" value="" />-->
                </form>
                </div>
            </div>
        </nav>


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
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='user_area/user_login.php'><i class='fa fa-sign-in' aria-hidden='true'></i>  Login</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='user_area/logout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>  Logout</a>
                        </li>";
                    }
                ?>
            </ul>
        </nav>

        <!--third child
        <div class="bg-light m-3 mx-5">
            <img src="img/home.png" style="width:100%; height:500px;"/>
        </div>-->

        <!-- fourth child-->
         <div class="d-flex m-2">
            <div class="col-md-10">
                <!--all products-->
                <div class="row">
                    <!--fetching products-->
                    <?php
                    search_products();
                    get_unique_section();
                    get_unique_brands();
                    get_unique_categories();
                    ?>
                    
                    <!--<div class="col-md-4 mb-4">
                        <div class="card" >
                            <img src="img/products/pro1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">add to cart</a>
                                <a href="#" class="btn btn-secondary">View More</a>
                            </div>
                        </div>
                    </div>-->
                    
                </div>

            </div>
            <!--side nav-->
            <div class="rounded sidenav col-md-2 bg-mint-green p-0 text-center mx-2">
                <!--section-->
                <ul class="navbar-nav border me-auto">
                    <li class="nav-item ">
                        <a href="#" class="bg-light-pink text-dark fw-bolder nav-link"><h4>Section</h4></a>
                    </li>
                    <?php
                       getsection();
                    ?>
                    
                    
                </ul>
                
                <!--brands-->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item ">
                        <a href="#" class="bg-light-pink text-dark fw-bolder nav-link"><h4>Brands</h4></a>
                    </li>
                    <?php
                       getbrands();
                    ?>
                    
                    
                </ul>

                <!--categories-->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item ">
                        <a href="#" class="bg-light-pink text-dark fw-bolder nav-link"><h4>Categories</h4></a>
                    </li>
                    
                    <?php
                        getcategory();
                    ?>
                </ul>

            </div>
            

         </div>

        <!--footer-->
        <?php
            include("includes/footer.php");
        ?>
    </div>



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>