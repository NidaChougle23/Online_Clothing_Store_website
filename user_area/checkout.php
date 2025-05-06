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
    <title>Online Shopping Website</title>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files for styles-->
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body class="bg-soft-light-pink">
    <!--navbar-->
    <div class="container-fluid p-0 m-0">
        <!--first child-->
        <nav class="navbar -top border-bottom navbar-expand-lg bg-body-tertiary m-0">
            <div class="container-fluid m-0">
                <img src="../img/Logo.png" class="logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active text-danger fw-bold" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../display_all.php">All</a>
                    </li>
                    

                    <li class="nav-item">
                    <div class="">
                        <a href="../cart.php" class="btn btn-light">
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
                                <a class='nav-link' href='profile.php'>My Account</a>
                                </li>";
                        }
                        else{
                            echo "<li class='nav-item'>
                                <a class='nav-link text-success fw-bold' href='./user_area/user_registration.php'>Register</a>
                                </li>";
                        }
                    ?>
                </ul>
                <form action="../search_products.php" method="get" class="d-flex" role="search p-0">
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
                        echo "<li class='nav-item text-dark'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item text-dark'>
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
        
        <?php
        $user_ip=getIPAddress();
        $get_user="select * from user_table where user_ip='$user_ip'";
        $result=mysqli_query($con,$get_user);
        $run_query=mysqli_fetch_array($result);
        $user_id=$run_query['user_id'];
    ?>

        <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row">
            <div class="upi col-md-6 justify-content-center align-center">
                <h3>Pay online using <a href="https://www.paypal.com" >paypal.com</a></h3>
            </div>
            <div class="col-md-6 justify-content-center align-center text-center">
                <a href="order.php?user_id=<?php echo $user_id ?>" ><h2>Cash on delivery Payment</h2>
                </a>
            </div>
        </div>
    </div>
        

        <!--footer-->
        <?php
            include("../includes/footer.php");
        ?>


    </div>



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></scrip>
    <script src="js/style.js"></script>
</body>
</html>