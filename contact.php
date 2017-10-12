<?php
	if(isset($_GET['logout'])&&$_SESSION['token']==$_GET['token']){
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
						echo 'Logged in as ' . $_SESSION['username'] . '<br /><a href="index.php?logout=true&csrftoken='.$_SESSION['csrftoken'].'">Log out</a>';
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

			?>

		<main class="content">
			<div class ="login-form">
				<div class = "left">
				<h2> Contact</h2>
				<div class="email">
					<h3> By Email </h3>
					Customer support:
					<?php
					$to = "dat14sja@student.lu.se";
					$body = "";
					echo "<a href='mailto:" . $to . "?body=" . $body . "'>Jaf Shamiran</a>";
					?>
					<p>Quick replies 24/7!</p>
				</div>
				<div class="comment-field">
				<h3> Leave new comment</h3>
				<form action="comment_form.php" method="post">
					<p></p>
					Name: <br /><input type="text" name="name"style ="width: 150px;"/><br />
					<p></p>
					Comment:<br /> <textarea name='comment'style ="width: 200px; height: 60px;"></textarea><br /><br />
				  <input type="radio" name="score" value="1"> 1<br />
				  <input type="radio" name="score" value="2"> 2<br />
				  <input type="radio" name="score" value="3"> 3<br />
				  <input type="radio" name="score" value="4"> 4<br />
				  <input type="radio" name="score" value="5"> 5<br />
					<p>Leave a comment about our site!</p>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>
		<div class = "right">
			<h3> Comments </h3>
			<?php include 'comment_display.php';?>
		</div>
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
