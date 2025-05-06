<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_brand'])){
        $brand_title=$_POST['brand_title'];
        $select_query="select * from brands where brand_title='$brand_title'";
        $result_select=mysqli_query($con,$select_query);
        $number=mysqli_num_rows($result_select);
        if($number>0){
            echo "<script>alert('This Brand already Exists')</script>";
        }
        else{
            $insert_query="insert into brands (brand_title) values('$brand_title')";
            $result=mysqli_query($con,$insert_query);
            if($result){
                echo "<script>alert('Brand has been inserted successfully')</script>";
            }
        }
        
    }
?>

<h2 class="text-center mb-4">Insert Brand</h2>
<hr/>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brand" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-3 m-auto">
        <input type="submit" class="bg-mint-green my-3 p-2 border text-dark" name="insert_brand" value="Insert Brand">
    </div>
</form>