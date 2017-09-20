<?php
	if(isset($_GET['logout'])){
		session_start();
		session_unset();
		session_destroy();
	} else {
		session_start();
	}
	if(isset($_GET['remove'])){
		$i = $_GET['remove']+1;
		while($i<$_SESSION['num_products']){
			$_SESSION['cart'][$i-1] = $_SESSION['cart'][$i];
			$i++;
		}
	$_SESSION['cart'][$_SESSION['num_products']-1] = null;
			
	$_SESSION['num_products']--;
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
			<div class=header-titel>
				<img src = "https://challenge.burnerapp.com/img/logo.png" alt="Logo" height="50px">
				<h1> ExpressPhone Store </h1>
			</div>
			<div class=header-info>
				<div class=active-user>
					<?php if(isset($_SESSION['username'])){
						echo 'Logged in as ' . $_SESSION['username'] . '<br /><a href="index.php?logout=true">Log out</a>';
						if(isset($_GET['id'])){
							$_SESSION['cart'][$_SESSION['num_products']] = $_GET['id'];
							$_SESSION['num_products']++;
						}
						} else {
						echo 'Not logged in.<br /><a href="index.php">Log in</a> | <a href="register.php">Register new user</a>';
						}
					?>
				</div>
				<div class=shopping-cart>
				<a href=""><img src="https://image.flaticon.com/icons/svg/2/2772.svg" alt="Shopping Cart"height="30px">Shopping Cart <?php if(isset($_SESSION['username'])&&$_SESSION['num_products']>0) echo '<strong>(' . $_SESSION['num_products'] . ')</strong>'; ?></a>
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

			<div class="product-list"><center>
				<?php

					$n = $_SESSION['num_products'];
					if($n == 0){
						echo 'The shopping cart is empty.';
					} else {
						echo '<table id="cart_table"><tr><th>Product</th><th>Price</th><th></th></tr>';
						$i = 0;
						while($i<$n){
							$sql = "SELECT * FROM products WHERE id = " . $_SESSION['cart'][$i];
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							echo '<tr><td>'.$row['name'].'</td><td>$'.$row['price'] . '</td><td><a href="cart.php?remove='.$i.'">Remove</a></td></tr>';
							$i++;
						}
						echo '</table>';
					}
				?>
			</center></div>
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