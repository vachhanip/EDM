<?php
session_start();
?>

<html>
<head>
    <title>Home</title>
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
            if (isset($_SESSION['id'])) {
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
            }else{
                echo"<div class='navbar' style='margin-left: 65.9%;'>
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
                        <a href='login.php'>Login</a>
			        </div>";
            }
            ?>
		</div>
    </form>
    <form method="post">
        <div class="product-list">
            <?php
                require '../config/db.php';
                $prip = mysqli_query($conn, "SELECT * FROM product ORDER BY RAND() LIMIT 7");
                if (mysqli_num_rows($prip) == 0) {
                    echo "Product is not available";
                } else {
                    while ($row = mysqli_fetch_array($prip)) {
                        echo "<div class='product'><a href='product_page.php?id={$row[0]}'><div>
                        <img src='../images/{$row[3]}' alt='{$row['name']}' width='150'>
                        <h3>{$row[1]}</h3>
                        <p>Price: ₹{$row[5]}</p></div>
                    </a></div>";
                    }
                }
            ?>
        </div>
    </form>
</body>

</html>