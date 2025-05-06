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

<h3 class="text-center text-success mt-5">All Categories</h3>
<hr/>
<table class="table table-bordered mt-3 text-center">
    <thead>
        <tr>
            <th class="bg-mint-green text-dark">Sr. no.</th>
            <th class="bg-mint-green text-dark">Category Title</th>
            <th class="bg-mint-green text-dark">Edit</th>
            <th class="bg-mint-green text-dark">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select_cat="select * from categories";
        $result=mysqli_query($con,$select_cat);
        while($row=mysqli_fetch_assoc($result)){
            $category_id=$row['id'];
            $category_title=$row['category_title'];
            echo "<tr>
            <td class='bg-light'>$category_id</td>
            <td class='bg-light'>$category_title</td>
            <td class='bg-light'><a href='index.php?edit_category=$category_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td class='bg-light'><a href='index.php?delete_category=$category_id' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
        }
        ?>
        
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?view_categories" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_category=<?php echo $category_id ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>