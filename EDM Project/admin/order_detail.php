<?php
    session_start();
    if (isset($_SESSION['ID'])) {
    } else {
        header("Location: login.php");
    }
    require '../config/db.php';
?>

<html>
<head>
    <title>Pending Orders</title>
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
            <li><a href="view_customers.php">View Customers</a></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">Orders</h2>
            <?php
                require '../config/db.php';
                $prio=mysqli_query($conn, "SELECT * from orders WHERE id = ".$_GET['id']);
                $orow = mysqli_fetch_array($prio);
                $priu=mysqli_query($conn, "SELECT * from user WHERE id = ".$orow[1]);
                $row = mysqli_fetch_array($priu);
                $priod=mysqli_query($conn, "SELECT * from ordered_item WHERE order_id = ".$_GET['id']);
                if(mysqli_num_rows($priod) == 0){
                    echo "<script>
                            alert('No Product in Order');
                        </script>";
                } else {
                    echo "<h3 align='center'>Customer name : ".$row[1]."</h3>
                    <table class='table'>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Delivery Status</th>
                            <th>Price(₹)</th>
                            <th>Quantity</th>
                            <th>Total(₹)</th>
                        </tr>
                    ";
                    $no = 0;
                    $total_price = 0;
                    while ($odrow = mysqli_fetch_array($priod)){
                        $prip=mysqli_query($conn, "SELECT * from product WHERE id = $odrow[2]");
                        $prow = mysqli_fetch_array($prip);
                        $no += 1;
                        $total_price += $prow[5] * $odrow[3];
                        echo "
					    <tr align='center'>
                            <td>" . $no . "</td>
						    <td>" . $prow[1] . "</td>
                            <td><img src='../images/" . $prow[3] . "' height='150' width='150'></td>
                            <td>" . $prow[4] . "</td>
                            <td>" . $orow[5] . "</td>
                            <td>" . $prow[5] . "</td>
                            <td>" . $odrow[3] . "</td>
                            <td>" . $prow[5]*$odrow[3] . "</td>
                        </tr>";
                    
                    }
                    if($orow[5] == "delivered"){
                        echo "<tr align='center'>
					        <td colspan=10><h3>Total Price:₹ $total_price</h3></td>
				        </tr></table>";   
                    }
                    else{
                        echo "<tr align='center'>
                            <td colspan=10><h3>Total Price:₹ $total_price</h3>
                            <input type='submit' class='abtn' value='Order Delivered' name='delivered'></td>
                        </tr></table>";  
                        if (isset($_POST['delivered'])) {
                            $updpsy = mysqli_query($conn, "UPDATE orders set status='delivered' where id=".$_GET['id']);
                            header("Location: view_c_orders.php");                            
                        }
                    }  
                }
            ?>
        </div>
    </form>
</body>

</html>