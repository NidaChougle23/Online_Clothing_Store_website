<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete account</title>
</head>
<body>
    <h3 class="text-danger mb-4 mt-5">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline">
            <input type="submit" class="form-control w-50 m-auto mb-3 border text-danger fw-bolder bg-mint-green" name="delete" value="Delete Account">
        </div>
        <div class="form-outline">
            <input type="submit" class="form-control w-50 m-auto mb-5 border text-success fw-bolder bg-light" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>

    <?php
        $username_session=$_SESSION['username'];
        if(isset($_POST['delete'])){
            $delete_query="delete from user_table where username='$username_session'";
            $result=mysqli_query($con,$delete_query);
            if($result){
                session_destroy();
                echo "<script>alert('Account Deleted Successfully')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            }
        
        }
        if(isset($_POST['dont_delete'])){
            echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
</body>
</html>