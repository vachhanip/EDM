<?php
    session_start();
    session_destroy();
    header('Location: login.php');
?>

<html>
<head>
    <title>Login</title>
	<link rel="icon" type="image/x-icon" href="../images/alogo.png">
</head>
</html>