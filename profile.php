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
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='user_login.php'><i class='fa fa-sign-in' aria-hidden='true'></i>  Login</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='logout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>  Logout</a>
                        </li>";
                    }
                ?>
            </ul>
        </nav>

        <div class="row">
            <div class="col-md-2 navbar-nav bg-light text-center border my-5 p-0" style="height:470px">
                <li class="nav-item bg-light-pink py-2 border">
                    <a class="nav-item text-dark" href="#"><h4><?php echo ".$_SESSION['username']."; ?></h4></a>
                </li>
                <?php
                    $username=$_SESSION['username'];
                    $user_image="select * from user_table where username='$username'";
                    $result_image=mysqli_query($con,$user_image);
                    $row_image=mysqli_fetch_array($result_image);
                    $user_image=$row_image['user_image'];
                    echo "<li class='align-center profile-img m-3'>
                            <img src='./user_images/$user_image' alt=''>
                        </li>";
                ?>
                
                <li class="align-center profile-img m-3">
                    <a class="nav-item text-dark" href="profile.php">Pending Orders</a>
                </li>
                <li class="align-center profile-img m-3">
                    <a class="nav-item text-dark" href="profile.php?edit_account">Edit Account</a>
                </li>
                <li class="align-center profile-img m-3">
                    <a class="nav-item text-dark" href="profile.php?my_orders">My Orders</a>
                </li>
                <li class="align-center profile-img m-3">
                    <a class="nav-item text-dark" href="profile.php?delete_account">Delete Account</a>
                </li>
                <li class="align-center profile-img m-3">
                    <a class="nav-item text-dark" href="logout.php">Logout</a>
                </li>

            </div>
            <div class="col-md-10 text-center">
                <?php 
                    get_user_order_details();
                    if(isset($_GET['edit_account'])){
                        include('edit_account.php');
                    }
                    if(isset($_GET['my_orders'])){
                        include('my_orders.php');
                    }
                    if(isset($_GET['delete_account'])){
                        include('delete_account.php');
                    }
                ?>
            </div>
        </div>
        <!--footer-->
        <?php
            include("../includes/footer.php");
        ?>


    </div>



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/style.js"></script>
</body>
</html>