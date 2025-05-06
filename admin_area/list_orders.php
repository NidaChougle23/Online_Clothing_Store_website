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

<h3 class="text-center text-success">All orders</h3>
<hr/>
<table class="table table-bordered mt-5 text-center">
    <thead>
<?php

$get_orders = "Select * from `user_orders`";
$result = mysqli_query($con, $get_orders);
$row_count = mysqli_num_rows($result);



if($row_count == 0){
    echo "<h2 class='text-danger text-center mt-5'>No orders yet</h2>";
} else {
    $number = 0;
    echo "<tr>
                <th class='bg-mint-green text-dark'>Sr. no.</th>
                <th class='bg-mint-green text-dark'>Due Amount</th>
                <th class='bg-mint-green text-dark'>Invoice number</th>
                <th class='bg-mint-green text-dark'>Total products</th>
                <th class='bg-mint-green text-dark'>Address</th>
                <th class='bg-mint-green text-dark'>Order Date</th>
                <th class='bg-mint-green text-dark'>Status</th>
                <th class='bg-mint-green text-dark'>Delete</th>
            </tr>
            </thead>
            <tbody>";
    while($row_data = mysqli_fetch_assoc($result)){
        $order_id = $row_data['order_id'];
        $user_id = $row_data['user_id'];
        $amount_due = $row_data['amount_due'];
        $invoice_number = $row_data['invoice_number'];
        $total_products = $row_data['total_products'];
        $address=$row_data['address'];
        $order_date = $row_data['order_date'];
        $order_status = $row_data['order_status'];
        $number++;
        echo "<tr>
            <td class='bg-light'>$number</td>
            <td class='bg-light'>$amount_due</td>
            <td class='bg-light'>$invoice_number</td>
            <td class='bg-light'>$total_products</td>
            <td class='bg-light'>$address</td>
            <td class='bg-light'>$order_date</td>
            <td class='bg-light'>$order_status</td>
            <td class='bg-light'><a href='index.php?delete_order=$order_id' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
    }
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?list_orders" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_order=<?php echo $order_id ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>