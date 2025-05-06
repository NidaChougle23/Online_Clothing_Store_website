<?php
if(isset($_GET['delete_payment'])){
    $payment_id=$_GET['delete_payment'];
    // echo $delete_id;
    // delete query

    $delete_payment="Delete from user_payments where payment_id=$payment_id";
    $result_payment=mysqli_query($con,$delete_payment);
    if($result_payment){
        echo "<script>alert('Payment record deleted successfully')</script>";
        echo "<script>window.open('./index.php?all_payments','_self')</script>";
    }
}
?>