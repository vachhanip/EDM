<?php
    session_start();
    $n = "abc@gmail.com";
	$p = "123";
    if (isset($_POST['login'])) //signin
	{
		$_SESSION['ID'] = $_POST['email'];
		$_SESSION['password'] = $_POST['password'];
		$a = $_SESSION['ID'];
		$b = $_SESSION['password'];
		if ($n == $a && $p == $b) {
			header("Location: view_orders.php");
		}
	}
	if (isset($_SESSION['ID'])) //relod
	{
		$a = $_SESSION['ID'];
		$b = $_SESSION['password'];
		if ($n == $a && $p == $b) {
			header("Location: view_c_orders.php");
		}
	}
?>

<html>
<head>
    <title>Login</title>
	<link rel="icon" type="image/x-icon" href="../images/alogo.png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="POST" action="">
		<div class="login-box">
			<h1>Login</h1>
			<div class="ltextbox">
				<i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" autocomplete="off" required>
			</div>

			<div class="ltextbox">
				<i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
			</div>

			<input type="submit" class="lbtn" value="Login" name="login">
		</div>
	</form>
</body>
</html>