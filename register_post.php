
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
			<?php
				echo 'Hello world! <br />';
			?>
			<div class="login-form">
				<?php

	$servername = "localhost";

// Create connection
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br />";

				$username = $_POST['username'];
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
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
	echo 'Username and/or password not filled in.';
} else if($password === $password2){
	$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		echo 'Username already occupied';
	} else {

		$saltlength = 6;
		$strong = true;
		//$salt = openssl_random_pseudo_bytes($saltlength,$strong);
		//$salt = random_bytes($saltlength);
		$salt = makeMeASalt(6);
		
		$sql = "INSERT INTO users (username, password, salt) VALUES ('" . $username . "', '" . md5($password.$salt) . "', '" . $salt . "')";
	
		if($conn->query($sql)===TRUE){
			echo 'User registered';
		} else {
			echo 'Unknown error';
		}
	}
} else {
	echo 'Passwords do not match!';
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