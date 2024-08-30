<?php
session_start();
?>

<html>
<head>
    <title>Product Details</title>
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
        <?php
            require '../config/db.php';
            $pripd = mysqli_query($conn, "SELECT * FROM product where id=".$_GET['id']);
            $row = mysqli_fetch_array($pripd)
        ?>
        <h1 align="center"><?php echo $row[1]; ?></h1>
        <div class="product-detail">
        
            <div>
                <img src="../images/<?php echo $row[3]; ?>" width="400">
            </div>
            <div>
                <b>Product Description</b>
                <p><?php echo $row[4]; ?></p>
                <?php
                    if($row[6]==0){
                        echo"<p style='color: red;'>Out of Stock</p>";
                    }
                    else if($row[6]<=10){
                        echo"<p style='color: orange;'>Limited Stock available</p>";
                    }
                    else{
                        echo"<p style='color: #00d110;'>In Stock</p>";
                    }
                ?>
                
                <p>Price: ₹<?php echo $row[5]; ?></p>
                <input type="text" class="product-quantity" value="1" name="quantity" min="1" pattern="[0-9]{}" required>
                <input type="submit" class="btn" style="width: 250px;" value="Add to Cart" name="cart_add">
                <input type="submit" class="btn" style="width: 250px;" value="Add to Wishlist" name="wish_add">
                <?php
                if(isset($_POST['quantity']) && $_POST['quantity'] > $row[6]){
                    echo "<script>
                        alert('That much {$row[1]} is not Available!');
                    </script>";
                }else{
                    if(isset($_POST['cart_add'])){
                        if (isset($_SESSION['id'])) {
                            $selc=mysqli_query($conn, "SELECT * FROM cart WHERE product_id = $row[0]");
                            if(mysqli_num_rows($selc) == 0){
                                $quantity = $_POST['quantity'];
                                $user = $_SESSION['id'];
                                $product = $row[0];
                                $addtoc = mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) 
                                VALUES ('$user', '$product', '$quantity')");
                                if ($addtoc) {
                                    echo "<script>
                                            alert('Product added to Cart successfully');
                                        </script>";
                                } else {
                                    echo "<script>
                                            alert('Something Was Wrong!');
                                        </script>";
                                }
                            }else{
                                /*echo "<script>
                                        alert('Product already in Cart');
                                    </script>";*/
                                $quantity = $_POST['quantity'];
                                $updtoc = mysqli_query($conn, "UPDATE cart set quantity=$quantity where product_id = $row[0]");
                                if ($updtoc) {
                                    echo "<script>
                                            alert('Product added to Cart successfully');
                                        </script>";
                                } else {
                                    echo "<script>
                                            alert('Something Was Wrong!');
                                        </script>";
                                }
                            }
                        }
                        else{
                            header('Location: login.php');
                        }
                    }    
                    if(isset($_POST['wish_add'])){
                        if (isset($_SESSION['id'])) {
                            $selw=mysqli_query($conn, "SELECT * FROM wishlist WHERE product_id = $row[0]");
                            if(mysqli_num_rows($selw) == 0){
                                $user = $_SESSION['id'];
                                $product = $row[0];
                                $addtow = mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) 
                                VALUES ('$user', '$product')");
                                if ($addtow) {
                                    echo "<script>
                                            alert('Product added to Wishlist successfully');
                                        </script>";
                                } else {
                                    echo "<script>
                                            alert('Something Was Wrong!');
                                        </script>";
                                }
                            }else{
                                echo "<script>
                                        alert('Product already in Wishlist');
                                    </script>";
                            }
                        }
                        else{
                            header('Location: login.php');
                        }
                        
                    }
                }
                ?>
            </div>
        </div>
    </form>
</body>

</html>