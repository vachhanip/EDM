<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
?>

<html>
<head>
    <title>Edit Product</title>
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
            <h2 align="center">Edit Product</h2>
            <?php
                require '../config/db.php';
                if (isset($_GET["no"])) {
                    $selp = mysqli_query($conn, "SELECT * from product where id=" . $_GET["no"]);
                    $row = mysqli_fetch_array($selp);
                    $description = $row[4];
                    $price = $row[5];
                    $quantity = $row[6];
                }
                if (isset($_POST["submit"])) {
                    $description = $_POST["description"];
                    $price = $_POST["price"];
                    $quantity = $_POST["quantity"];
                    $editpd = mysqli_query($conn, "UPDATE product set description='$description' where id=" . $_GET["no"]);
                    $editpp = mysqli_query($conn, "UPDATE product set price='$price' where id=" . $_GET["no"]);
                    $editpq = mysqli_query($conn, "UPDATE product set quantity='$quantity' where id=" . $_GET["no"]);
                    if ($editpd && $editpp && $editpq) {
						header("location:view_products.php");
					} else {
						echo "Something wrong in edit data.......!";
					}
                }
            ?>
            <table align="center">
                <tr>
					<td><textarea class="atexa" name="description" value="<?php echo $description; ?>" placeholder="Description(use '<br>' before new line )" required></textarea></td></tr>
                <tr>
					<td><input type="number" class="atex" name="price" value="<?php echo $price; ?>" step="1" placeholder="Price" required></td></tr>
                <tr>
					<td><input type="number" class="atex" name="quantity" value="<?php echo $quantity; ?>" placeholder="Quantity" required></td></tr>
                <tr>
					<td align="center"><input type="submit" class="abtn" class="abtn" name="submit" value="Edit Product"></td></tr>
            </table>
        </div>
    </form>
</body>

</html>