
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


	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";

$result = $conn->query($sql);

if($result->num_rows == 0){
	$login = false;
} else {
	$row = $result->fetch_assoc();

	$salt = $row['salt'];

	if(md5($password.$salt) === $row['password']){
		$login = true;
		session_start();
		$_SESSION["username"] = $username;
	} else {
		$login = false;
	}
}

?>

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
					if($login){
						echo 'User found. Password correct';
					} else {
						echo 'Wrong username or password';
					}
				?>
			</div>
		</main>
		<footer>
			<div class="f1">
				<?php if(isset($_SESSION['username'])){
					echo 'Logged in as ' . $_SESSION['username'] . '<br /><a href="index.php?logout=true">Log out</a>';
					} else {
					echo 'Not logged in.<br /><a href="index.php">Log in</a> | <a href="register.php">Register new user</a>';
					}
				?>
			</div>
			<div class="f2">
				testing2
			</div>
		</footer>
	</div>
</body>
</html>