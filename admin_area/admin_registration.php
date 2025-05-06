<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap css link -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <!--FontAwesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- CSS for custom styling -->
    <link rel="stylesheet" href="../css/style.css"/>
    <style>
        body {
            background-image: url('../img/log_reg_back.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .admin_register img {
            width: 100%;
            height: 70%;
            align-items: center;
        }
    </style>

    <!-- JavaScript for password validation and toggle -->
    <script>
        function validatePasswords() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }
            return true;
        }

        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('confirm_password');
            var toggleButton = document.getElementById('togglePassword');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
                toggleButton.textContent = 'Hide Password';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
                toggleButton.textContent = 'Show Password';
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid m-3 back">
        <h2 class="text-center text-success mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 admin_register">
                <img src="../img/register.avif" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post" onsubmit="return validatePasswords()">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username" required="required" minlength="3" maxlength="30" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" required="required" class="form-control">
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required="required" minlength="6" maxlength="20" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label fw-bold">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required="required" minlength="6" maxlength="20" class="form-control">
                    </div>
                    
                    <!-- Show/Hide Password Button -->
                    <div class="mb-4">
                        <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()" >  Show Password"
                    </div>

                    <div>
                        <input type="submit" class="bg-mint-green fw-bold py-2 px-3 border-1" name="admin_registration" value="Register">
                    </div>
                    <p class="small fw-bold mt-2 pt-1">Already have an Account? <a href="admin_login.php" class="text-decoration-none fw-bolder link-danger">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include('../includes/connect.php');

if(isset($_POST['admin_registration'])){
    // Sanitize and trim inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    
    // Hash the password for security
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the username or email already exists
    $select_query = "SELECT * FROM admin_table WHERE admin_name=? OR admin_email=?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists.')</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        // Insert the new admin into the database
        $insert_query = "INSERT INTO admin_table (admin_name, admin_email, admin_password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash_password);
        $sql_execute = mysqli_stmt_execute($stmt);

        if ($sql_execute) {
            echo "<script>alert('Data inserted successfully.')</script>";
            echo "<script>window.open('./admin_login.php','_self')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>
