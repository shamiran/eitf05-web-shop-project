<?php
	if(isset($_GET['logout'])){
		session_start();
		session_unset();
		session_destroy();
	} else {
		session_start();
	}
	if(isset($_GET['remove'])&&$_SESSION['num_products']>0){
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
				<a href="cart.php"><img src="https://image.flaticon.com/icons/svg/2/2772.svg" alt="Shopping Cart"height="30px">Shopping Cart <?php if($_SESSION['num_products']>0) echo '<strong>(' . $_SESSION['num_products'] . ')</strong>'; ?></a>
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

			<div class="product-list">
				<h2>Shopping cart</h3>
				<center>
				<?php
					$totalPrice = 0;
					$n = $_SESSION['num_products'];
					if(!isset($_SESSION['num_products'])||$n == 0){
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
							$totalPrice = $totalPrice + $row['price'];
						}
						echo '</table>';
						echo '<br /> The total price is <strong> $' . $totalPrice . ' </strong><br /><br />';

						if(isset($_SESSION['username'])){					
						$name = $_SESSION['username'];
						$sql = "SELECT address FROM users WHERE username LIKE  '".$name."' LIMIT 1";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$address = $row['address'];
						echo '
						<form action="checkout.php" method="post">
						<h3> Delivery Details </h3>';
						if(isset($address)){
							$address=htmlspecialchars($address);
							echo 'Address: <input type="text" value= "'.$address.'" size = "30" name="address" />';
						}	else {
							echo 'Address: <input type="text" value= "" size = "30" name="address" />';
						}
						echo '<br /><br />
						<input type="hidden" name="csrftoken" value="' . $_SESSION['csrftoken'] . '" /> 
						<input type="submit" value="Check out" />
						</form>';
						}

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
