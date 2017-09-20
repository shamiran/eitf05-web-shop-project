
<html>
<head>
<title>Min sida</title>
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
			<h1> Webshop </h1>
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
				//strip tags to remove if trying to insert html tags
				//trim to remove whitespace
				$username = strip_tags(trim($_POST['username']));
				$password = strip_tags($_POST['password']);
				$password2 = strip_tags($_POST['password2']);
				$address = strip_tags($_POST['address']);
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
}
	//the password must be at least 8 characters,
	//contain at least one lower case letter, one upper case letter and one digit
	else if(!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {
		echo '<h3>Password is not strong enough, not containing password conditions </h3>';
		echo '<a href="register.php"> Back to register </a>';
}
//The username should be an email-adress
else if(!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $username)){
echo 'The username is not an email-adress';
echo '<a href="register.php"> Back to register </a>';
}
else if($password === $password2){
	$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		echo '<h3>Username already occupied</h3>';
		echo '<a href="register.php"> Back to register </a>';

	} else {

		$saltlength = 6;
		$strong = true;
		//$salt = openssl_random_pseudo_bytes($saltlength,$strong);
		//$salt = random_bytes($saltlength);
		$salt = makeMeASalt(6);

		$sql = "INSERT INTO users (username, address, password ,salt) VALUES ('" . $username . "','" . $address . "', '" . md5($password.$salt) . "', '" . $salt . "')";

		if($conn->query($sql)===TRUE){
			echo '<h3>User registered</h3>';
			echo '<a href="index.php"> Back to login </a>';
		} else {
			echo '<h3>Unknown error</h3>';
			echo '<a href="register.php"> Back to register </a>';

		}
	}
} else {
	echo '<h3>Passwords do not match!</h3>';
	echo '<a href="register.php"> Back to register </a>';
}

function makeMeASalt($max=40){
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

			</div>
		</main>
		<footer>
			<div class="f1">
				teeeeesting
			</div>
			<div class="f2">
				testing2
			</div>
		</footer>
	</div>
</body>
</html>
