<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
?>

<html>
<head>
    <title>Add Product</title>
    <link rel="icon" type="image/x-icon" href="../images/alogo.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
    <form method="post" enctype="multipart/form-data">
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
            <li><a class="active" href="add_product.php">Add Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
            <li><a href="view_customers.php">View Customers</a></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">Add Product</h2>
            <table align="center">
				<tr>
					<td><input type="text" class="atex" name="proname" placeholder="Product Name" required></td></tr>
                <tr>
					<td><select class="atex" name="category" required>
                            <option disabled="disabled" selected>select category</option>
                            <?php
                            require '../config/db.php';
                            $selc=mysqli_query($conn, "SELECT * from categorie");
                            if ($selc) {
                                while ($row = mysqli_fetch_array($selc)) {
                                    echo "<option value='{$row[1]}'>{$row[1]}</option>";
                                }
                            }
                            ?>
                        </select></td></tr>
                <tr>
					<td><input type="file" class="afile" name="photo" accept="image/jpg" required></td></tr>
                <tr>
					<td><textarea class="atexa" name="description" placeholder="Description(use '<br>' before new line )" required></textarea></td></tr>
                <tr>
					<td><input type="number" class="atex" name="price" step="1" placeholder="Price" required></td></tr>
                <tr>
					<td><input type="number" class="atex" name="quantity" placeholder="Quantity" required></td></tr>
                <tr>
					<td align="center"><input type="submit" class="abtn" class="abtn" name="submit" value="Add Product"></td></tr>
            </table>
            <?php
                if (isset($_POST["submit"])) {
                    if (isset($_FILES['photo'])){
                        $locp = "../images/";
                        $photo = $_FILES['photo'];
	    				$photoName = $photo['name'];
    					$addphoto = $locp . $photoName;
					    move_uploaded_file($photo['tmp_name'], $addphoto);
                    }
                    $proname = $_POST["proname"];
                    $category = $_POST["category"];
                    $photo = $photo['name'];
                    $description = $_POST["description"];
                    $price = $_POST["price"];
                    $quantity = $_POST["quantity"];
                    
                    $addp = mysqli_query($conn, "INSERT into product (`name`,`categorie`,`photo`,`description`,`price`,`quantity`)
						values('$proname','$category','$photo','$description','$price','$quantity') ");
                    if($addp){
                        header("location:view_products.php");
                    }else{
                        echo "Error: " . $addp . "<br>" . $conn->error;
                    }
                }
            ?>
        </div>
    </form>
</body>

</html>