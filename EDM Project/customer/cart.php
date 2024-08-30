<?php
    session_start();
    if (isset($_SESSION['id'])) {
    } else {
    	header("Location: login.php");
    }
    if (isset($_POST['order'])) {
        header("Location: place_order.php");
    }
?>

<html>
<head>
    <title>My Cart</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
	<form method="post">
		<div class="header">
			<IMG src="../images/logo.png" width="65px" height="65px">
			<h2 style="margin:15px 0;">Grocery Mart</h2>
            <?php 
                echo"<div class='navbar' style='margin-left: 55.3%;'>
                    <a href='index.php'>Home</a>
                    <div class='dropdown'>
                        <button class='dropbtn'>
                            <a class='dropbtn' style='padding:0;' href='products.php'>Products <i class='fa fa-caret-down'></i></a>
                        </button>
                        <div class='dropdown-content'>";
                            require '../config/db.php';
                            $pric=mysqli_query($conn, "SELECT * from categorie");
                            if ($pric) {
                                while ($row = mysqli_fetch_array($pric)) {
                                echo "
                                <a href='products.php?categorie={$row[1]}'>{$row[1]}</a>";
                                }
                            }
                        echo"</div>
                    </div>
                    <a href='cart.php'>My Cart</a>
                    <div class='dropdown'>
                        <button class='dropbtn'>My Account <i class='fa fa-caret-down'></i></button>
                        <div class='dropdown-content'>
                            <a href='wishlist.php'>Wishlist</a>
                            <a href='my_orders.php'>My Orders</a>
                            <a href='logout.php'>Logout</a>
                        </div>
                    </div> 
                </div>";
            ?>
		</div>
    </form>
    <form method="post">
        <h1 align="center">My Cart</h1>
        <?php
            require '../config/db.php';
            $user_id = $_SESSION['id'];
            $selc=mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '".$_SESSION['id']."'");
            if(mysqli_num_rows($selc) == 0){
                echo "<script>
                        alert('No items in the cart');
                    </script>
                    <h3 align='center'><a href='index.php'>GO to Home</a></h3>";
            } else {
                echo "<table class='table'>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Price(₹)</th>
                            <th>Quantity</th>
                            <th>Total(₹)</th>
                        </tr>
                ";
                $no = 0;
                $total_price = 0;
                while ($crow = mysqli_fetch_array($selc)) {
                    $prip=mysqli_query($conn, "SELECT * from product WHERE id = $crow[2]");
                    $prow = mysqli_fetch_array($prip);
                    $no += 1;
                    $total_price += $prow[5] * $crow[3];
                    echo "
					<tr align='center'>
                        <td>" . $no . "</td>
						<td>" . $prow[1] . "</td>
                        <td><img src='../images/" . $prow[3] . "' height='150' width='150'></td>
                        <td>" . $prow[4] . "</td>
                        <td>" . $prow[5] . "</td>
                        <td><a style='color: black;text-decoration: none;' href='product_page.php?id={$prow[0]}'>" . $crow[3] . "</a></td>
                        <td>" . $prow[5]*$crow[3] . "&emsp; 
                            <a style='color: black;text-decoration: none;' href='delete.php?id={$crow[0]}&table=cart'>
                            <i class='fa-solid fa-trash' style='color: red;'></i></a></td>
					</tr>";
                }
                $_SESSION['price'] = $total_price;
                echo "<tr align='center'>
					    <td colspan=7><h3>Total Price:₹ $total_price</h3>
                        <input type='submit' class='btn' value='Place Order' name='order'></td>
				    </tr></table>";     
            }
        ?>
    </form>
</body>

</html>