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
			<?php
			$servername = "localhost";
			$username = "webadmin";
			$password = "adminadmin";

			// Create connection
			$conn = new mysqli($servername, $username, $password,'webshop');

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			echo "Connected successfully";

			?>
			<div class="login-form">
				<?php 	
					if(isset($_SESSION['username'])){
						echo 'Welcome back, ' . $_SESSION['username'] . '!<br />';
						echo '<a href="index.php?logout=true">Log out</a>';
					} else { echo '
				<form action="login.php" method="post">
					<h3> Log in </h3>
					<input type="text" value="" placeholder = "User Name" name="username" />
					<br>
					<input type="text" value="" placeholder = "Password" name="password" />
					<br>
					<input type="submit" value="Log in" />
				</form>

				<form action="register.php" method="post">
					<input type="submit" value="Register new user" />
				</form> ';
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
