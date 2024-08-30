<?php 
	session_start(); 
	if (isset($_SESSION['id'])) {
		header("Location: index.php");
	}
?>
<html>

<head>
	<title> Login </title>
	<link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <form method="POST">
        <div class="login-box">
			<h1>Login</h1>
			<div class="login">
				<i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Email" name="email" required>
			</div>
			<div class="login">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password" name="password" required>
			</div>
			<input type="submit" class="btn" value="Login" name="login">
            <a href='register.php'>register if you haven't an account</a>
		</div>
    </form>
    <?php
	require "../config/db.php";
	if (isset($_POST['login'])) {
		
		$x = $_POST['email'];
		$y = $_POST['password'];
		$qury = mysqli_query($conn, "SELECT * from user where email='".$_POST['email']."'");
		$row = mysqli_fetch_array($qury);
		$a = $row[3];
		$b = $row[4];

		if ($x == $a && $y == $b) {
            $_SESSION['id'] = $row[0];
			header("Location: index.php");
		} else {
			echo "	<script>
						alert('Sumthing was wrong');
					</script>";
		}
	}
	?>
</body>

</html>