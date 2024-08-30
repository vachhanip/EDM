<?php
    session_start();
    if (isset($_SESSION['id'])) {
    } else {
    	header("Location: login.php");
    }
    require '../config/db.php';
    if (isset($_SESSION['payment'])) {
        $updpsy = mysqli_query($conn, "UPDATE orders set payment_type='online' where id=".$_SESSION['order_id']);
        unset($_SESSION['payment']);
    }
?>

<html>
<head>
    <title>Success</title>
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
    <h1 style="color: green; font-style: italic; text-align: center;" >Your Order has been Placed Successfully</h1><br/>
    <h3>Want to continue shopping ? <a href="index.php"> Click Here</a></h3>
    </form>
</body>

</html>