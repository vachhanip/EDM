<?php
    session_start();
    if (isset($_SESSION['id'])) {
    } else {
    	header("Location: login.php");
    }
?>
<html>
<head>
    <title>My Orders</title>
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
        <h1 align="center">My Orders</h1>
        <?php
            require '../config/db.php';
            $user_id = $_SESSION['id'];
            $selo=mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '".$_SESSION['id']."'");
            if(mysqli_num_rows($selo) == 0){
                echo "<script>
                        alert('You not order anything');
                    </script>";
            } else {
                echo "<table class='table'>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Payment Type</th>
                            <th>Delivery Status</th>
                            <th>Price(₹)</th>
                            <th>Quantity</th>
                            <th>Total(₹)</th>
                        </tr>
                ";
                $no = 0;
                $total_price = 0;
                while ($orow = mysqli_fetch_array($selo)) {
                    $seloi=mysqli_query($conn, "SELECT * from ordered_item WHERE order_id = $orow[0]");
                    while ($oirow = mysqli_fetch_array($seloi)){

                        $prip=mysqli_query($conn, "SELECT * from product WHERE id = $oirow[2]");
                        $prow = mysqli_fetch_array($prip);
                        $no += 1;
                        $total_price += $orow[2];
                        echo "
					    <tr align='center'>
                            <td>" . $no . "</td>
						    <td>" . $prow[1] . "</td>
                            <td><img src='../images/" . $prow[3] . "' height='150' width='150'></td>
                            <td>" . $prow[4] . "</td>
					        <td>" . $orow[6] . "</td>
                            <td>";  if($orow[4]=="cod"){
                                echo"Cash on delivery";
                            }else{
                                echo"Online";
                            }  
                        echo"</td>
                            <td>" . $orow[5] . "</td>
                            <td>" . $prow[5] . "</td>
                            <td>" . $oirow[3] . "</td>
                            <td>" . $prow[5]*$oirow[3] . "</td>
                        </tr>";
                    }
                }
                $_SESSION['price'] = $total_price;
                echo "<tr align='center'>
					    <td colspan=10><h3>Total Price:₹ $total_price</h3></td>
				    </tr></table>";     
            }
        ?>
    </form>
</body>

</html>