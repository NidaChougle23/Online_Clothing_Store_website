<?php
    session_start();
    include("includes/connect.php");
    include("functions/common_function.php");
    include("includes/header.php");
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

        <!--card function calling-->
        <?php
            cart();
        ?>
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

        <!-- fourth child-->
         <div class="d-flex m-2">
            <div class="col-md-10">
                <!--all products-->
                <div class="row">
                    <!--fetching products-->
                    <?php
                    getproducts();
                    get_unique_section();
                    get_unique_brands();
                    get_unique_categories();
                    // $ip = getIPAddress();  
                    // echo 'User Real IP Address - '.$ip;  
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
                <ul class="navbar-nav me-auto">
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
    <script src="js/style.js"></script>
</body>
</html>