<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
?>

<html>
<head>
    <title>Delete Customers</title>
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
            <li><a href="view_products.php">View Products</a></li>
            <li><a class="active" href="view_customers.php">View Customers</a></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">Delete Customers</h2>
            <?php
                require '../config/db.php';
                if (isset($_GET["no"])) {
                    $selu = mysqli_query($conn, "SELECT * from user where id=" . $_GET["no"]);
                    $row = mysqli_fetch_array($selu);
                    $user = $row[1];
                }
                if (isset($_POST["submit"])) {
                    $delu = mysqli_query($conn, "DELETE from user where id=" . $_GET["no"]);
                    if ($delu) {
						header("location:view_customers.php");
					} else {
						echo "Something wrong in delete data.......!";
					}
                }
            ?>
            Are you sure to delete the <b><u><?php echo $user; ?></u></b> from user.
            <input type="submit" class="abtn" name="submit" value="Delete User">
        </div>
    </form>
</body>

</html>
