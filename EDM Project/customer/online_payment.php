<!-- customer/online_payment.php -->
<?php
    session_start();
    if (isset($_SESSION['id'])) {
    } else {
        header("Location: login.php");
    }
    $apiKey = "rzp_test_pLl681e9OrLq4X";
    require '../config/db.php';
    $selu=mysqli_query($conn, "SELECT * FROM user WHERE id = ".$_SESSION['id']);
    $info = mysqli_fetch_array($selu);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Online Payment</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <form action="success.php" method="POST">
        <?php
            $_SESSION['payment'] = "online";
        ?>
        <script
            src="https://checkout.razorpay.com/v2/checkout.js"
            data-key="<?php echo $apiKey; ?>"
            data-amount="<?php echo intval($_SESSION['price']) * 100; ?>"
            data-currency="INR"
            data-id="<?php echo $_SESSION['order_id']; ?>"
            data-buttontext="Pay with Razorpay"
            data-name="Online Cloth Store"
            data-description="Complete Business Solution"
            data-image="https://oibp1.000webhostapp.com/logo.PNG"
            data-prefill.name="<?php echo $info[1]; ?>"
            data-prefill.email="<?php echo $info[3]; ?>"
            data-prefill.contact="<?php echo $info[2]; ?>"
            data-theme.color="#ff9902">
        </script>
    </form>
</body>

</html>