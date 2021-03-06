<?php
	if(isset($_GET['logout'])){
		session_start();
		session_unset();
		session_destroy();
	} else {
		session_start();
	}
?>
<html>
<head>
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; child-src 'none'; object-src 'none'; img-src 'self' *.gsmarena.com *.ndtv.com *.flaticon.com *.burnerapp.com">
<title>ExpressPhone Store</title>
<link rel="stylesheet" type="text/css" href="mall.css" />
</head>
<body>
	<nav class="col-1">
		<ul>
			<li><a href="index.php">Home</a></li>
  		<li><a href="products.php">Products</a></li>
  		<li><a href="contact.php">Contact</a></li>
  		<li><a href="about.php">About</a></li>
		</ul>
	</nav>
	<div class="col-2">
		<header>
			<div class=header-titel>
				<img src = "https://challenge.burnerapp.com/img/logo.png" alt="Logo" height="50px">
				<h1> ExpressPhone Store </h1>
			</div>
			<div class=header-info>
				<div class=active-user>
					<?php if(isset($_SESSION['username'])){
						echo 'Logged in as ' . $_SESSION['username'] . '<br /><a href="index.php?logout=true">Log out</a>';
						} else {
						echo 'Not logged in.<br /><a href="index.php">Log in</a> | <a href="register.php">Register new user</a>';
						}
					?>
				</div>
				<div class=shopping-cart>
				<a href="cart.php"><img src="https://image.flaticon.com/icons/svg/2/2772.svg" alt="Shopping Cart"height="30px">Shopping Cart <?php if(isset($_SESSION['username'])&&$_SESSION['num_products']>0) echo '<strong>(' . $_SESSION['num_products'] . ')</strong>'; ?></a>
			</div>
			</div>
		</header>
		<main class="content">
			<div class="login-form">
				<?php

	$servername = "localhost";

// Create connection
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

				$stmt = $conn->prepare("SELECT * FROM users WHERE (username) LIKE (?)");
				$stmt2 = $conn->prepare("INSERT INTO users (username, address, password, lastLoginAttempt, loginAttemptCount) VALUES ( (?), (?), (?), (?), (?) )");
				$username = $_POST['username'];
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				$address = htmlspecialchars($_POST['address']);

				$blacklistTest = false;

				$sql = "SELECT * FROM blacklist";
				$result = $conn->query($sql);
				$n = $result->num_rows;
				$i = 0;
				while($i < $n){
	if($password === $result->fetch_assoc()['password']){
		$blacklistTest = true;
		$i = $n;
	}
	$i++;
}

if($blacklistTest){

	echo 'Too common password!';

} else if($username == "" || $username == null || $password == "" || $password == null){

	echo '<h3>Username and/or password not filled in.</h3>';
	echo '<a href="register.php"> Back to register </a>';

} else if(!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {

	echo '<h3>Password is not strong enough, not containing password conditions </h3>';
	echo '<a href="register.php"> Back to register </a>';

} else if(!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $username)){

	echo 'The username is not an email-adress';
	echo '<a href="register.php"> Back to register </a>';

} else if($password === $password2){

	if (!$stmt) {
		echo "false";
	} else {
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}
	$result = $stmt->get_result();

	if($result->num_rows > 0){
		echo '<h3>Username already occupied</h3>';
		echo '<a href="register.php"> Back to register </a>';

	} else {

		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		$mysql_date_now = date("Y-m-d H:i:s");
		
		if (!$stmt2) {
			echo "false";
		} else {

			$stmt2->bind_param("ssssi", $username, $address, $hashed_password, $lastLoginAttempt, $loginAttemptCount);
			if($stmt2->execute()===TRUE){
				echo '<h3>User registered</h3>';
				echo '<a href="index.php"> Back to login </a>';
				$stmt->close();
				$stmt2->close();
				$conn->close();
			} else {
				echo '<h3>Unknown error</h3>';
				echo '<a href="register.php"> Back to register </a>';
			}
		}
	} 
} else {

	echo '<h3>Passwords do not match!</h3>';
	echo '<a href="register.php"> Back to register </a>';

}

?>

			</div>
		</main>
		<footer>
			<div class="f1">
			</div>
			<div class="f2">
			</div>
		</footer>
	</div>
</body>
</html>