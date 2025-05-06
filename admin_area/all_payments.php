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

<h3 class="text-center text-success">All Payments</h3>
<hr/>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
<?php
$get_payment = "Select * from `user_payments`";
$result = mysqli_query($con, $get_payment);
$row_count = mysqli_num_rows($result);


if($row_count == 0){
    echo "<h2 class='text-danger text-center mt-5'>No Payments yet</h2>";
} else {
    $number = 0;
    echo "<tr>
                <th class='bg-mint-green text-dark'>Sr. no.</th>
                <th class='bg-mint-green text-dark'>Invoice number</th>
                <th class='bg-mint-green text-dark'>Amount</th>
                <th class='bg-mint-green text-dark'>Payment mode</th>
                <th class='bg-mint-green text-dark'>Order Date</th>
                <th class='bg-mint-green text-dark'>Delete</th>
            </tr>
            </thead>
            <tbody class='bg-secondary text-light'>";
    while($row_data = mysqli_fetch_assoc($result)){
        $payment_id = $row_data['payment_id'];
        $order_id = $row_data['order_id'];
        $amount = $row_data['amount'];
        $invoice_number = $row_data['invoice_number'];
        $payment_mode = $row_data['payment_mode'];
        $date = $row_data['date'];

        $number++;
        echo "<tr>
            <td class='bg-light'>$number</td>
            <td class='bg-light'>$invoice_number</td>
            <td class='bg-light'>$amount</td>
            <td class='bg-light'>$payment_mode</td>
            <td class='bg-light'>$date</td>
            <td class='bg-light'><a href='index.php?delete_payment=$payment_id' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?all_payments" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_payment=<?php echo $payment_id ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>