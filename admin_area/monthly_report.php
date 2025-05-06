<?php
    // Include your database connection file to establish connection
    include('../includes/connect.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        /* Flexbox container to align reports side by side */
        .sales-container {
            display: flex;
            flex-wrap: wrap; /* Allows items to wrap if they don't fit in one row */
            justify-content: space-between; /* Spaces items evenly */
            gap: 20px; /* Adds space between the divs */
        }

        /* Individual sales report boxes */
        .sales-info {
            flex: 1 1 calc(50% - 20px); /* Each div takes up roughly 50% of the width minus spacing */
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 15px;
            text-align: left;
        }

        th {
            border-bottom: 1px solid #ddd;
        }

        td {
            border-bottom: 1px solid #f1f1f1;
        }

        @media (max-width: 768px) {
            /* For smaller screens, make divs full width */
            .sales-info {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>

<div class="sales-container">

    <?php
    // ========== Monthly Sales Report ==========
    $sql_monthly = "SELECT YEAR(date) as year, MONTH(date) as month, SUM(amount) as total_sales
                    FROM user_payments
                    GROUP BY YEAR(date), MONTH(date)
                    ORDER BY YEAR(date) DESC, MONTH(date) DESC";
    $result_monthly = $con->query($sql_monthly);

    echo "<div class='card sales-info'>";
    echo "<h4>Total Sales by Month</h4>";
    echo "<table><tr><th>Month</th><th>Total Sales (INR)</th></tr>";
    if ($result_monthly->num_rows > 0) {
        while ($row = $result_monthly->fetch_assoc()) {
            $monthName = date('F', mktime(0, 0, 0, $row['month'], 10));
            echo "<tr><td>{$monthName} {$row['year']}</td><td>" . number_format($row['total_sales'], 2) . " INR</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No sales data available.</td></tr>";
    }
    echo "</table></div>";

    // ========== Quarterly Sales Report ==========
    $sql_quarterly = "SELECT YEAR(date) as year, QUARTER(date) as quarter, SUM(amount) as total_sales
                      FROM user_payments
                      GROUP BY YEAR(date), QUARTER(date)
                      ORDER BY YEAR(date) DESC, QUARTER(date) DESC";
    $result_quarterly = $con->query($sql_quarterly);

    echo "<div class='card sales-info'>";
    echo "<h4>Total Sales by Quarter</h4>";
    echo "<table><tr><th>Year</th><th>Quarter</th><th>Total Sales (INR)</th></tr>";
    if ($result_quarterly->num_rows > 0) {
        while ($row = $result_quarterly->fetch_assoc()) {
            echo "<tr><td>{$row['year']}</td><td>Q{$row['quarter']}</td><td>" . number_format($row['total_sales'], 2) . " INR</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No sales data available.</td></tr>";
    }
    echo "</table></div>";

    // ========== Half-Yearly Sales Report ==========
    $sql_half_yearly = "SELECT YEAR(date) as year,
                               CASE 
                                   WHEN MONTH(date) <= 6 THEN 'H1'
                                   ELSE 'H2'
                               END as half_year,
                               SUM(amount) as total_sales
                        FROM user_payments
                        GROUP BY YEAR(date), half_year
                        ORDER BY YEAR(date) DESC, half_year ASC";
    $result_half_yearly = $con->query($sql_half_yearly);

    echo "<div class='card sales-info'>";
    echo "<h4>Total Sales by Half-Year</h4>";
    echo "<table><tr><th>Year</th><th>Half-Year</th><th>Total Sales (INR)</th></tr>";
    if ($result_half_yearly->num_rows > 0) {
        while ($row = $result_half_yearly->fetch_assoc()) {
            echo "<tr><td>{$row['year']}</td><td>{$row['half_year']}</td><td>" . number_format($row['total_sales'], 2) . " INR</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No sales data available.</td></tr>";
    }
    echo "</table></div>";

    // ========== Yearly Sales Report ==========
    $sql_yearly = "SELECT YEAR(date) as year, SUM(amount) as total_sales
                   FROM user_payments
                   GROUP BY YEAR(date)
                   ORDER BY YEAR(date) DESC";
    $result_yearly = $con->query($sql_yearly);

    echo "<div class='card sales-info'>";
    echo "<h4>Total Sales by Year</h4>";
    echo "<table><tr><th>Year</th><th>Total Sales (INR)</th></tr>";
    if ($result_yearly->num_rows > 0) {
        while ($row = $result_yearly->fetch_assoc()) {
            echo "<tr><td>{$row['year']}</td><td>" . number_format($row['total_sales'], 2) . " INR</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No sales data available.</td></tr>";
    }
    echo "</table></div>";

    ?>

</div>

</body>
</html>
