<?php 
    session_start(); 
    if (isset($_SESSION['id'])) {
		header("Location: index.php");
	}
?>
<html>

<head>
	<title> Register </title>
	<link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <form method="POST">
        <div class="login-box">
			<h1>Register</h1>
            <div class="login">
                <i class="fa-solid fa-user"></i>
                <input type="text" placeholder="Name" name="name" required>
			</div>
            <div class="login">
            <i class="fa-solid fa-phone"></i>
                <input type="text" placeholder="Phone Number" name="phone" pattern="[0-9]{10}" required>
			</div>
			<div class="login">
				<i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Email" name="email" required>
			</div>
			<div class="login">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password" name="password" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="Address" name="address" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="City" name="city" required>
			</div>
            <div class="login">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="State" name="state" required>
			</div>
			<input type="submit" class="btn" value="Login" name="login">
		</div>
    </form>
    <?php
	require "../config/db.php";
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
    
        $qury = mysqli_query($conn, "INSERT INTO user (name, phone, email, password, address, city, state) 
            VALUES ('$name', '$phone', '$email', '$password', '$address', '$city', '$state')");
        if ($qury) {
            header("Location: login.php");
        } else {
            echo "<script>
					alert('Email or Phone no already used');
				</script>";
        }
    }
    ?>
</body>
</html>