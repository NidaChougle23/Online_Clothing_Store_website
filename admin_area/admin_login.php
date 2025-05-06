<?php
include('../includes/connect.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS files for styles-->
    <link rel="stylesheet" href="../css/style.css"/>
    <style>
        body {
            background-image: url('../img/log_reg_back.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 0;
            margin: 0;
        }
        .admin_register img{
            width: 100%;
            height: 100%;
            align-items: center;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var toggleButton = document.getElementById('togglePassword');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = 'Hide Password';
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = 'Show Password';
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid m-3 back">
        <h2 class="text-center mb-5 text-danger fw-bolder">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 admin_register">
                <img src="../img/admin_login.jpg" alt="Admin Login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username" required="required" minlength="3" maxlength="30" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required="required" minlength="6" maxlength="20" class="form-control">
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()" >  Show Password
                    </div>
                    <div>
                        <input type="submit" class="bg-paradise-pink fw-bold py-2 px-3 border rounded" name="admin_login" value="Login">
                    </div>
                    <p class="small fw-bold mt-2 pt-1">Don't have an Account? <a href="admin_registration.php" class="text-decoration-none fw-bolder link-danger">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();

if(isset($_POST['admin_login'])){
    // Sanitize user input
    $admin_name = htmlspecialchars(trim($_POST['username']));
    $admin_password = htmlspecialchars(trim($_POST['password']));

    // Basic validation (server-side)
    if(empty($admin_name) || empty($admin_password)){
        echo "<script>alert('Both fields are required.')</script>";
        exit();
    }

    // Check username format
    if(strlen($admin_name) < 3 || strlen($admin_name) > 30){
        echo "<script>alert('Username must be between 3 and 30 characters.')</script>";
        exit();
    }

    // Check password length
    if(strlen($admin_password) < 6 || strlen($admin_password) > 20){
        echo "<script>alert('Password must be between 6 and 20 characters.')</script>";
        exit();
    }

    // Query the database to find the user
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name=?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, 's', $admin_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if($row_count > 0){
        if(password_verify($admin_password, $row_data['admin_password'])){
            // Password matches, proceed with login
            $_SESSION['username'] = $admin_name;
            echo "<script>alert('Logged in Successfully!!')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        } else {
            // Password does not match
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        // Username does not exist
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
