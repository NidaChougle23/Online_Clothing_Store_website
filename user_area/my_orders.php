<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $username=$_SESSION['username'];
        $get_user="Select * from `user_table` where username='$username'";
        $result=mysqli_query($con,$get_user);
        $row_fetch=mysqli_fetch_assoc($result);
        $user_id=$row_fetch['user_id'];
    ?>
    <h3 class="text-success mt-3">All my Orders</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th class="bg-mint-green text-dark">Sr. no.</th>
                <th class="bg-mint-green text-dark">Amount Due</th>
                <th class="bg-mint-green text-dark">Total Products</th>
                <th class="bg-mint-green text-dark">Invoice number</th>
                <th class="bg-mint-green text-dark">Date</th>
                <th class="bg-mint-green text-dark">Complete/Incomplete</th>
                <th class="bg-mint-green text-dark">Status</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            $get_order_details="Select * from `user_orders` where user_id=$user_id";
            $result_orders=mysqli_query($con,$get_order_details);
            $number=1;
            while($row_orders=mysqli_fetch_assoc($result_orders)){
                $order_id=$row_orders['order_id'];
                $amount_due=$row_orders['amount_due'];
                $total_products=$row_orders['total_products'];
                $invoice_number=$row_orders['invoice_number'];
                $order_date=$row_orders['order_date'];
                $order_status=$row_orders['order_status'];
                if($order_status=='pending'){
                    $order_status='Incomplete';
                }
                else{
                    $order_status='Complete';
                }
                
                echo "<tr>
                        <td class='bg-light '>$number</td>
                        <td class='bg-light'>$amount_due</td>
                        <td class='bg-light'>$total_products</td>
                        <td class='bg-light'>$invoice_number</td>
                        <td class='bg-light'>$order_date</td>
                        <td class='bg-light'>$order_status</td>";
                        $number++;
                        if($order_status=='Complete'){
                            echo "<td class='bg-light'>Paid</td>";
                        }
                        else{
                           echo "<td class='bg-light'><a href='confirm_payment.php?order_id=$order_id' class='text-dark nav-item'>Confirm</a></td>
                           </tr>";
                        }
                    
            }
        ?>
        </tbody>
    </table>
</body>
</html>