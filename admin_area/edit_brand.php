<?php
    // Include your database connection file to establish connection
    include('../includes/connect.php'); 

    // Your query logic
    $get_products = "select * from products";
    $result = mysqli_query($con, $get_products);

    if(!$result){
        die("Query Failed: " . mysqli_error($con)); // Optional error handling
    }
?>

<?php
    // Check if edit_brand is set and fetch brand data
    if(isset($_GET['edit_brand'])){
        $edit_brand = $_GET['edit_brand'];

        // Fetch brand data from the database
        $get_brand = "SELECT * FROM brands WHERE id=$edit_brand";
        $result = mysqli_query($con, $get_brand);

        // Check if the query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
            $brand_title = $rows['brand_title'];
        } else {
            // Handle error if the query fails
            die("Error fetching brand: " . mysqli_error($con));
        }
    }

    // Check if the form was submitted
    if(isset($_POST['edit_brand'])){
        $brand_title = $_POST['brand_title'];

        // Update the brand title
        $update_query = "UPDATE brands SET brand_title='$brand_title' WHERE id=$edit_brand";
        $result_brand = mysqli_query($con, $update_query);

        // Check if the update was successful
        if($result_brand){
            echo "<script>alert('brand updated successfully.');</script>";
            echo "<script>window.open('index.php?view_brands', '_self');</script>";
        } else {
            // Handle error if the update fails
            die("Error updating brand: " . mysqli_error($con));
        }
    }
?>

<div class="container mt-3">
    <h3 class="text-center text-success">Edit brand</h3>
    <hr/>
    <form action="" method="post" class="text-center">
        <div class="form-outline mt-4 mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label fw-bold">brand Title</label>
            <input type="text" id="brand_title" name="brand_title" class="w-50 form_control" value="<?php echo $brand_title ?>" required="required">
        </div>
        <input type="submit" class="btn bg-mint-green border px-2 mb-3" value="Update brand" name="edit_brand">
    </form>
</div>
