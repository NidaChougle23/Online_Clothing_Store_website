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
