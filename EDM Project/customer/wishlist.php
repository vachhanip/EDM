<?php
session_start();
if (isset($_SESSION['id'])) {
} else {
	header("Location: login.php");
}
?>
<html>
<head>
    <title>My Wishlist</title>
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
        <h1 align="center">My Wishlist</h1>
        <?php
            require '../config/db.php';
            $user_id = $_SESSION['id'];
            $selw=mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id = '".$_SESSION['id']."'");
            if(mysqli_num_rows($selw) == 0){
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
                            <th>Price</th>
                        </tr>
                ";
                $no = 0;
                while ($wrow = mysqli_fetch_array($selw)) {
                    $prip=mysqli_query($conn, "SELECT * from product WHERE id = $wrow[2]");
                    $prow = mysqli_fetch_array($prip);
                    $no += 1;
                    echo "
					<tr align='center'>
                        <td>" . $no . "</td>
						<td>" . $prow[1] . "</td>
                        <td><a style='color: black;text-decoration: none;' href='product_page.php?id={$prow[0]}'>
                            <img src='../images/" . $prow[3] . "' height='150' width='150'></a></td>
                        <td>" . $prow[4] . "</td>
                        <td>" . $prow[5] . "&emsp; 
                            <a style='color: black;text-decoration: none;' href='delete.php?id={$wrow[0]}&table=wishlist'>
                            <i class='fa-solid fa-trash' style='color: red;'></i></a></td>
					</tr>";
                }
                echo "</table>";     
            }
        ?>
    </form>
</body>

</html>