<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
?>

<html>
<head>
    <title>View Products</title>
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
            <li><a href="view_c_orders.php">Completed Orders</a></li>
            <li><a href="view_p_orders.php">Pending Orders</a></li>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="view_category.php">View Category</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a class="active" href="view_products.php">View Products</a></li>
            <li><a href="view_customers.php">View Customers</a></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">View Products</h2>
            <?php
                require '../config/db.php';
                $prip=mysqli_query($conn, "SELECT * from product");
                echo "<table class='table'>
					<tr>
						<th>No.</th>
                        <th>Name</th>
						<th>Category</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
                ";
                $no = 0;
                while ($row = mysqli_fetch_array($prip)) {
                    $no += 1;
                    echo "
					<tr align='center'>
                        <td>" . $no . "</td>
						<td>" . $row[1] . "</td>
                        <td>" . $row[2] . "</td>
                        <td><img src='../images/" . $row[3] . "' height='150' width='150'></td>
                        <td>" . $row[4] . "</td>
                        <td>" . $row[5] . "</td>
                        <td>" . $row[6] . "</td>
						<td><a href='edit_product.php?no=" . $row[0] . "'>Edit</a></td>
						<td><a href='delete_product.php?no=" . $row[0] . "'>Delete</a></td>
					</tr>";
                }
                echo "</table>";
            ?>
        </div>
    </form>
</body>

</html>