<!--navbar-->
<div class="container-fluid p-0 m-0">
        <!--first child-->
        <nav class="navbar -top border-bottom navbar-expand-lg bg-body-tertiary m-0">
            <div class="container-fluid m-0">
                <img src="img/Logo.png" class="logo"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active text-danger fw-bold" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            All 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="display_all.php">All</a></li>
                            <?php getsection_nav(); ?>
                        </ul>
                    </li>

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
                                <a class='nav-link' data-bs-toggle='modal' data-bs-target='#registrationModal'>Register</a>
                                </li>";
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                            <a class='nav-link' data-bs-toggle='modal' data-bs-target='#loginModal' ><i class='fa fa-sign-in' aria-hidden='true'></i>  Login</a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='user_area/logout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>  Logout</a>
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


        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title text-paradise-pink" id="loginModalLabel">User Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" name="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" name="user_password" class="form-control toggle-password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()"> Show Password
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" value="Login" name="user_login" class="btn bg-paradise-pink fw-bold text-white">
                </div>

                </form>
            </div>
            </div>
        </div>
        </div>
        <?php
        if (isset($_POST['user_login'])) {
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];
            $user_ip = getIPAddress();

            $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
            $result = mysqli_query($con, $select_query);
            $row_count = mysqli_num_rows($result);
                
            if ($row_count > 0) {
                $row_data = mysqli_fetch_assoc($result);
                    
                if (password_verify($user_password, $row_data['password'])) {
                $_SESSION['user_id'] = $row_data['user_id'];
                    $_SESSION['username'] = $user_username;

                    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
                    $select_cart = mysqli_query($con, $select_query_cart);
                    $row_count_cart = mysqli_num_rows($select_cart);

                    echo "<script>alert('Logged in Successfully!!');</script>";
                    if ($row_count_cart == 0) {
                        echo "<script>window.open('user_area/profile.php','_self');</script>";
                    } else {
                        echo "<script>window.open('user_area/checkout.php','_self');</script>";
                    }
                } else {
                    echo "<script>alert('Invalid Credentials');</script>";
                }
            } else {
                echo "<script>alert('Invalid Credentials');</script>";
            }
        }
        ?>


        <!-- Registration Modal -->
        <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title text-paradise-pink" id="registrationModalLabel">New User Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <!-- Username -->
                <div class="mb-3">
                    <label for="user_username" class="form-label">Username *</label>
                    <input type="text" class="form-control" name="user_username" id="user_username" required autocomplete="off">
                </div>

                <!-- Full Name -->
                <div class="mb-3">
                    <label for="user_fullname" class="form-label">Full Name *</label>
                    <input type="text" class="form-control" name="user_fullname" id="user_fullname" required autocomplete="off">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email *</label>
                    <input type="email" class="form-control" name="user_email" id="user_email" required>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="user_image" class="form-label">Image *</label>
                    <input type="file" class="form-control" name="user_image" id="user_image">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password *</label>
                    <input type="password" class="form-control toggle-password" name="user_password" id="user_password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirm_user_password" class="form-label">Confirm Password *</label>
                    <input type="password" class="form-control toggle-password" name="conf_user_password" id="confirm_user_password" required>
                </div>

                <!-- Show/Hide Password -->
                <div class="mb-3">
                    <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()"> Show Password
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="user_address" class="form-label">Address *</label>
                    <input type="text" class="form-control" name="user_address" id="user_address" required>
                </div>

                <!-- Contact -->
                <div class="mb-3">
                    <label for="user_contact" class="form-label">Contact *</label>
                    <input type="text" class="form-control" name="user_contact" id="user_contact" required>
                </div>
                </div>
                <div class="d-grid gap-2">
                <input type="submit" name="user_register" class="btn bg-paradise-pink fw-bold text-white" value="Register">
                </div>
            </form>
            </div>
        </div>
        </div>

        <?php

            if(isset($_POST['user_register'])){
                $user_username=$_POST['user_username'];
                $user_fullname=$_POST['user_fullname'];
                $user_email=$_POST['user_email'];
                $user_password=$_POST['user_password'];
                $conf_user_password=$_POST['conf_user_password'];
                $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
                $user_address=$_POST['user_address'];
                $user_contact=$_POST['user_contact'];
                $user_image=$_FILES['user_image']['name'];
                $user_image_tmp=$_FILES['user_image']['tmp_name'];
                $user_ip=getIPAddress();
                //select query

                $select_query="select * from user_table where username='$user_username' or user_email='$user_email'";
                $result=mysqli_query($con,$select_query);
                $rows_count=mysqli_num_rows($result);
                if($rows_count>0){
                    echo "<script>alert('Username and email Already exists.')</script>";
                }
                else if($user_password!=$conf_user_password){
                    echo "<script>alert('Passwords do not match.')</script>";
                }
                else{
                    move_uploaded_file($user_image_tmp,"user_area/user_images/$user_image");
                    $insert_query="insert into user_table (username, user_fullname, user_email, user_image, password, user_contact, user_ip, user_address) values 
                    ('$user_username','$user_fullname','$user_email','$user_image','$hash_password',$user_contact,'$user_ip','$user_address')";
                    $sql_execute=mysqli_query($con,$insert_query);
                    if($sql_execute){
                        echo "<script>alert('Data inserted successfully');
                                var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                myModal.show();
                            </script>";
                    }else{
                        die(mysqli_error($con));
                    }
                }
            }

        ?>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Reset login form when login modal is closed
            var loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.addEventListener('hidden.bs.modal', function () {
                    loginModal.querySelector('form').reset();
                });
            }

            // Reset register form when register modal is closed
            var registerModal = document.getElementById('registrationModal');
            if (registerModal) {
                registerModal.addEventListener('hidden.bs.modal', function () {
                    registerModal.querySelector('form').reset();
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
        const modals = ['loginModal', 'registrationModal'];

        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);

            if (modal) {
                modal.addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });

                const form = modal.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        location.reload();
                    });
                }
            }
        });
    });
    </script>

    <script>
        function togglePasswordVisibility() {
            // Get all password fields by class
            var passwordFields = document.querySelectorAll('.toggle-password');
            var toggleButton = document.getElementById('togglePassword');

            passwordFields.forEach(function(field) {
                if (field.type === 'password') {
                    field.type = 'text';
                    toggleButton.textContent = 'Hide Password';
                } else {
                    field.type = 'password';
                    toggleButton.textContent = 'Show Password';
                }
            });
        }
    </script>