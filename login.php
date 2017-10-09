<?php
	$login = false;

	$servername = "localhost";
	$username = "webadmin";
	$password = "adminadmin";

	// Create connection
	$conn = new mysqli($servername, $username, $password,'webshop');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
	$stmt = $conn->prepare("SELECT * FROM users WHERE (username) LIKE (?)");
	$stmt2 = $conn->prepare("UPDATE users SET lastLoginAttempt = '" . date("Y-m-d H:i:s") . "' WHERE (username) LIKE (?)");
	$stmt3 = $conn->prepare("UPDATE users SET loginAttemptCount = (?)  WHERE (username) LIKE (?) ");
	$username = $_REQUEST['username'];
	$password = mysqli_real_escape_string($conn,$_REQUEST['password']);

	if (!$stmt) {
		echo "false";
	}
	else {
	$stmt->bind_param("s",$username);
	$stmt->execute();
	}
	$result = $stmt->get_result();

if($result->num_rows == 0){
	$login = false;
	$reason = 2;
} else {
	$row = $result->fetch_assoc();
	if (!$stmt2) {
		echo "false";
	}
	else {
		$stmt2->bind_param("s",$username);
		$stmt2->execute();
	}

	$mysql_date_now = new DateTime("now");
	$date_lastLogin = new DateTime($row['lastLoginAttempt']);

	if($mysql_date_now->getTimestamp() - $date_lastLogin->getTimestamp() >= 60 || $row['loginAttemptCount']<5-1){
		$salt = $row['salt'];
		$lac = $row['loginAttemptCount'];
		if(md5($password.$salt) === $row['password']){
			$token = makeMeAToken(40);
			$login = true;
			session_start();
			$_SESSION["csrftoken"] = $token;
			$_SESSION["username"] = $username;
			//$_SESSION["num_products"] = 0;
			if (!$stmt3) {
				echo "false";
			}
			else {
				$stmt3->bind_param("is",$lac, $username);
				$lac = 1;
				$stmt3->execute();
			}
		} else {
			$login = false;
			$reason = 1;

			if($mysql_date_now->getTimestamp() - $date_lastLogin->getTimestamp() < 60){
				$lac++;
			} else {
				$lac = 1;
			}
				$stmt3->bind_param("is",$lac, $username);
				$stmt3->execute();
		}
	} else {
		$login = false;
		$reason = 0;
	}
}

function makeMeAToken($max=40){
         $i = 0;
         $salt = "";
         $characterList = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
         while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
         }
         return $salt;
}

?>
<html>
<head>
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
					if($login){
						echo 'User found. Password correct';
						$stmt->close();
						$stmt2->close();
						$stmt3->close();
						$conn->close();
					} else {
						if($reason==0){
							echo 'Too many recent login attempts, please wait 60 seconds';
						} else if($reason==1){
							echo 'Wrong username or password';
						} else {
							echo 'User not found';
						}
						echo '<a href="index.php"> Back to login </a>';
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
