<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
    require '../config/db.php';
?>

<html>
<head>
    <title>Completed Orders</title>
    <link rel="icon" type="image/x-icon" href="../images/alogo.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
    <form method="post">
        <div class="header">
            <IMG src="../images/alogo.png" width="55px" height="55px">
            <h2 style="margin:15px 0;">Admin Panel</h2>
            <div class="sodiv">
                <a class="soa" href="logout.php">Logout</a>
            </div>
        </div>
        <ul align="center">
            <li><a class="active" href="view_c_orders.php">Completed Orders</a></li>
            <li><a href="view_p_orders.php">Pending Orders</a></li>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="view_category.php">View Category</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
            <li><a href="view_customers.php">View Customers</a></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">Completed Orders</h2>
            <?php
                require '../config/db.php';
                $prio=mysqli_query($conn, "SELECT * from orders WHERE status = 'delivered'");
                if(mysqli_num_rows($prio) == 0){
                    echo "<script>
                            alert('No Orders found');
                        </script>";
                } else {
                    echo "<table class='table'>
    					<tr>
						    <th>Order Id.</th>
                            <th>Date</th>						
                            <th>Shipping Info</th>
                            <th>Payment Type</th>
                            <th>Total Amount(₹)</th>
						    <th>Order Detail</th>
					    </tr>
                    ";
                    while ($row = mysqli_fetch_array($prio)) {
                        echo "
					    <tr align='center'>
                            <td>" . $row[0] . "</td>
						    <td>" . $row[6] . "</td>
                            <td>" . $row[3] . "</td>
                            <td>" . $row[4] . "</td>
                            <td>" . $row[2]."</td>
                            <td><a href='order_detail.php?id=" . $row[0] . "'>View</a></td>
					    </tr>";
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </form>
</body>

</html>