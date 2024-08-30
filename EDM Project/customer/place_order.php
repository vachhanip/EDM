<!-- customer/place_order.php -->
<?php
    session_start();
    if (isset($_SESSION['id'])) {
    } else {
        header("Location: login.php");
    }
?>

<html>
<head>
    <title> Place Order </title>
	<link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="POST">
        <?php 
            require '../config/db.php';
            $selu=mysqli_query($conn, "SELECT * FROM user WHERE id = ".$_SESSION['id']);
            $info = mysqli_fetch_array($selu);
        ?>
        <div class="login-box">
			<h1>Place Order</h1>
            <div class="login">
                <i class="fa-solid fa-user"></i>
                <input type="text" placeholder="Name" name="name" value="<?php echo $info[1]; ?>" required>
			</div>
            <div class="login">
            <i class="fa-solid fa-phone"></i>
                <input type="text" placeholder="Phone Number" name="phone" pattern="[0-9]{10}" value="<?php echo $info[2]; ?>" required>
			</div>
			<div class="login">
				<i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Email" name="email" value="<?php echo $info[3]; ?>" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="Address" name="address" value="<?php echo $info[5]; ?>" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="City" name="city" value="<?php echo $info[6]; ?>" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="State" name="state" value="<?php echo $info[7]; ?>" required>
			</div>
            <div>
                <label>Total Price:₹ <?php echo $_SESSION['price'];?></label><br>
                <input type="radio" name="payment" value="cod" required>Cash on delivery
				<input type="radio" name="payment" value="online" required>Online
			</div>
			<input type="submit" class="btn" value="Confirm Order" name="order">
		</div>
        <?php
            $user_id = $_SESSION['id'];

            if (isset($_POST['order'])) {
                $shipping_info = $_POST['address'].", ".$_POST['city'].", ".$_POST['state'];
                $payment_type = $_POST['payment'];
                $total_price = $_SESSION['price'];
                
                $addtoorders =  mysqli_query($conn, "INSERT INTO orders (user_id, total_price, shipping_info, payment_type, status) 
                    VALUES ('$user_id', '$total_price', '$shipping_info', 'cod', 'pending')");
                $selid=mysqli_query($conn, "SELECT id from orders WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 1");

                if ($addtoorders && $selid) {
                    $oid = mysqli_fetch_array($selid);
                    $order_id = $_SESSION['order_id'] = $oid[0];
                    $selc=mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");

                    while ($crow = mysqli_fetch_array($selc)) {
                        $prip=mysqli_query($conn, "SELECT * from product WHERE id = $crow[2]");
                        $prow = mysqli_fetch_array($prip);
                        $product_id = $crow[2];
                        $quantity = $crow[3];
                        $price = $prow[5]*$crow[3];
                        $addtoorderi = mysqli_query($conn, "INSERT INTO ordered_item (order_id, product_id, quantity, price)
                            VALUES ('$order_id', '$product_id', '$quantity', '$price')");
                        $newqnan = $prow[6]-$crow[3];
                        $updquan = mysqli_query($conn, "UPDATE product set quantity='$newqnan' where id=$crow[2]");
                    }

                    $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");

                    if ($payment_type == 'online') {
                        header('Location: online_payment.php');
                    } else {
                        header('Location: success.php');
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        ?>
    </form>
</body>
</html>