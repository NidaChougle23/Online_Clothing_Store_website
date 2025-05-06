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

<h3 class="text-center text-success">All Users</h3>
<hr/>
<table class="table table-bordered mt-5 text-center">
    <thead>
<?php
$get_user = "Select * from `user_table`";
$result = mysqli_query($con, $get_user);
$row_count = mysqli_num_rows($result);


if($row_count == 0){
    echo "<h2 class='text-danger text-center mt-5'>No Registered Users</h2>";
} else {
    $number = 0;
    echo "<tr>
                <th class='bg-mint-green text-dark'>Sr. no.</th>
                <th class='bg-mint-green text-dark'>Username</th>
                <th class='bg-mint-green text-dark'>Email id</th>
                <th class='bg-mint-green text-dark'>User Image</th>
                <th class='bg-mint-green text-dark'>Mobile no.</th>
                <th class='bg-mint-green text-dark'>Address</th>
            </tr>
            </thead>
            <tbody>";
    while($row_data = mysqli_fetch_assoc($result)){
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $email = $row_data['user_email'];
        $image = $row_data['user_image'];
        $contact = $row_data['user_contact'];
        $address = $row_data['user_address'];

        $number++;
        echo "<tr>
            <td class='bg-light'>$number</td>
            <td class='bg-light'>$username</td>
            <td class='bg-light'>$email</td>
            <td class='bg-light'><img class='product_image' src='../user_area/user_images/$image'></td>
            <td class='bg-light'>$contact</td>
            <td class='bg-light'>$address</td>
        </tr>";
    }
}
?>
        
    </tbody>
</table>

<!-- Modal -->
