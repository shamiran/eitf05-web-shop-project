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
			<img src = "https://challenge.burnerapp.com/img/logo.png" height="50px">
			<h1> BurnerPhone Store </h1>
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
				teeeeesting
			</div>
			<div class="f2">
				testing2
			</div>
		</footer>
	</div>
</body>
</html>
