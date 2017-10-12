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
				<h2> Register new user</h2>
				<form action="register_post.php" method="post">
					<p>Enter your e-mail address as user name, "example@gmail.com" :</p>
					Username: <input type="text" value="" name="username" /><br /><br />
					<p>Enter your home address for leverance :</p>
					Home address: <input type="text" value="" name="address" size="35" /><br /><br />
					<p>Enter your desired password, need to be at least 8 characters,<br />
					contain at least one lower case letter, one upper case letter and one digit :
					</p>
					Password: <input type="password" value="" name="password" /><br />
					Password again: <input type="password" value="" name="password2" /> <br /><br />
					<input type="submit" value="Register" />
				</form>
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
