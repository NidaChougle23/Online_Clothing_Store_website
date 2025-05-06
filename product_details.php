<?php
session_start();
include("includes/connect.php");
include("functions/common_function.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        .view-more img{
            width:200px;
            height:300px;
        }
    </style>
</head>
<body class="bg-soft-light-pink">
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar -top border-bottom navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="img/Logo.png" class="logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link fw-bold active text-danger" href="display_all.php">All</a>
                    </li>
                    <?php
                    getsection_nav();
                    ?>
                    <li class="nav-item">
                    <div class="">
                        <a href="cart.php" class="btn btn-light">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger"><?php cart_item(); ?></span>
                        </a>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Total price: <?php total_cart_price();?></a>
                    </li>
                    <?php
                        if(isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                                </li>";
                        }
                        else{
                            echo "<li class='nav-item'>
                                <a class='nav-link text-success fw-bolder' href='./user_area/user_registration.php'>Register</a>
                                </li>";
                        }
                    ?>
                </ul>
                <form action="search_products.php" method="get" class="d-flex" role="search p-0">
                    <input id="search" name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button id="isearch" name="search_data_product" class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
                    <!--<input type="submit" id="isearch" class="btn btn-outline-dark" value="" />-->
                </form>
                </div>
            </div>
        </nav>

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
    <div class="container">
        <div class="row">
            <?php
                view_details();
            ?>
            
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
