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
    // Check if edit_category is set and fetch category data
    if(isset($_GET['edit_category'])){
        $edit_category = $_GET['edit_category'];

        // Fetch category data from the database
        $get_category = "SELECT * FROM categories WHERE id=$edit_category";
        $result = mysqli_query($con, $get_category);

        // Check if the query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
            $category_title = $rows['category_title'];
        } else {
            // Handle error if the query fails
            die("Error fetching category: " . mysqli_error($con));
        }
    }

    // Check if the form was submitted
    if(isset($_POST['edit_cat'])){
        $cat_title = $_POST['category_title'];

        // Update the category title
        $update_query = "UPDATE categories SET category_title='$cat_title' WHERE id=$edit_category";
        $result_cat = mysqli_query($con, $update_query);

        // Check if the update was successful
        if($result_cat){
            echo "<script>alert('Category updated successfully.');</script>";
            echo "<script>window.open('index.php?view_categories', '_self');</script>";
        } else {
            // Handle error if the update fails
            die("Error updating category: " . mysqli_error($con));
        }
    }
?>

<div class="container mt-3">
    <h3 class="text-center text-success">Edit Category</h3>
    <hr/>
    <form action="" method="post" class="text-center">
        <div class="form-outline mt-4 mb-4 w-50 m-auto">
            <label for="category_title" class="form-label fw-bold">Category Title</label>
            <input type="text" id="category_title" name="category_title" class="w-50 form_control" value="<?php echo $category_title ?>" required="required">
        </div>
        <input type="submit" class="btn bg-mint-green border px-2 mb-3" value="Update Category" name="edit_cat">
    </form>
</div>
