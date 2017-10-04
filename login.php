
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

	//strip tags to remove if trying to insert html tags
	//trim to remove whitespace
	//htmlspecialchars????
	$username = strip_tags(trim($_REQUEST['username']));
	$password = strip_tags($_REQUEST['password']);

$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";

$result = $conn->query($sql);

if($result->num_rows == 0){
	$login = false;
	$reason = 2;
} else {
	$row = $result->fetch_assoc();
	
	$sql = "UPDATE users SET lastLoginAttempt = '" . date("Y-m-d H:i:s") . "' WHERE username LIKE '" . $username . "'";
	$conn->query($sql);

	$mysql_date_now = new DateTime("now");
	$date_lastLogin = new DateTime($row['lastLoginAttempt']);

	if($mysql_date_now->getTimestamp() - $date_lastLogin->getTimestamp() >= 60 || $row['loginAttemptCount']<5-1){
		$salt = $row['salt'];
		if(md5($password.$salt) === $row['password']){
			$token = makeMeAToken(40);
			$login = true;
			session_start();
			$_SESSION["csrftoken"] = $token;
			$_SESSION["username"] = $username;
			//$_SESSION["num_products"] = 0;
			$sql = "UPDATE users SET loginAttemptCount = 1 WHERE username LIKE '".$username . "'";
			$conn->query($sql);
		} else {
			$login = false;
			$reason = 1;			

			if($mysql_date_now->getTimestamp() - $date_lastLogin->getTimestamp() < 60){
				$sql = "UPDATE users SET loginAttemptCount = loginAttemptCount + 1 WHERE username LIKE '".$username . "'";
				$conn->query($sql);
			} else {
				$sql = "UPDATE users SET loginAttemptCount = 1 WHERE username LIKE '".$username . "'";
				$conn->query($sql);
			}
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
