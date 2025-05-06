<?php
    include("../includes/connect.php");
    include("../functions/common_function.php");
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!--css files for styles-->
    <link rel="stylesheet" href="../css/style.css"/>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        img{
            width:90%;
            height:90%;
            margin:auto;
            display:block;
        }
        .form-label{
            display:inline-block;
        }
    </style>
</head>
<body class="bg-soft-light-pink">
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="../img/Logo.png" class="logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">All</a>
                        </li>
                        
                        <?php
                            if(isset($_SESSION['username'])){
                                echo "<li class='nav-item'>
                                    <a class='nav-link' href='./profile.php'>My Account</a>
                                    </li>";
                            }
                            else{
                                echo "<li class='nav-item'>
                                    <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                                    </li>";
                            }
                        ?>
                    </ul>
                    <form action="search_products.php" method="get" class="d-flex" role="search p-0">
                        <input id="search" name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button id="isearch" name="search_data_product" class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
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

        <?php
            $username =$_SESSION['username'];
            $get_user = "select * from user_table where username='$username'";
            $result = mysqli_query($con, $get_user);
            $run_query = mysqli_fetch_array($result);
            $user_id = $run_query['user_id'];
            $email = $run_query['user_email'];
            $fullname=$run_query['user_fullname'];
            $contact = $run_query['user_contact'];
            $address = $run_query['user_address'];
        ?>

        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="checkout.php" method="post">
                    <!-- Row 1: Username and Name -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="user_username" class="form-label">Username</label><span class="error text-danger fw-bold">  *</span>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username" value="<?php echo $username ;?>"/>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="user_name" class="form-label">Name</label><span class="error text-danger fw-bold">  *</span>
                            <input type="text" id="user_name" class="form-control" placeholder="Enter your name" autocomplete="off" required="required" name="user_name" value="<?php echo $fullname; ?>"/>
                        </div>
                    </div>
                    
                    <!-- Row 2: Email and Address -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="user_email" class="form-label">Email</label><span class="error text-danger fw-bold">  *</span>
                            <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email" value="<?php echo $email ;?>"/>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="user_address" class="form-label">Address</label><span class="error text-danger fw-bold">  *</span>
                            <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address" value="<?php echo $address ;?>"/>
                        </div>
                    </div>
                    
                    <!-- Row 3: Pincode and Contact -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="user_pincode" class="form-label">Pincode</label><span class="error text-danger fw-bold">  *</span>
                            <input type="text" id="user_pincode" class="form-control" placeholder="Enter pincode" autocomplete="off" required="required" name="user_pincode"/>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="user_contact" class="form-label">Contact</label><span class="error text-danger fw-bold">  *</span>
                            <input type="text" id="user_contact" class="form-control" placeholder="Enter your Mobile number" autocomplete="off" required="required" name="user_contact" value="<?php echo $contact ;?>"/>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="mb-5 pt-2">
                        <button type="submit" class="fw-bolder bg-paradise-pink py-2 px-3 text-decoration-none">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
