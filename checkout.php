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
			<div class=header-titel>
				<img src = "https://challenge.burnerapp.com/img/logo.png" alt="Logo" height="50px">
				<h1> ExpressPhone Store </h1>
			</div>
			<div class=header-info>
				<div class=active-user>
					<?php
          if(isset($_SESSION['username'])){
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
      <div class=receipt>
      <center>
      <h3>The purchase has been confirmed</h3>'
      <p>The following products has been purchased</p>
      <?php
      $address = strip_tags($_POST['address']);

      echo '<table id="checkout_table">';
      $totalPrice = 0;
      $n = $_SESSION['num_products'];
      $i = 0;
      while($i<$n){
        $sql = "SELECT * FROM products WHERE id = " . $_SESSION['cart'][$i];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo '<tr><td>'.$row['name'].'</td><td>$'.$row['price'] . '</tr>';
        $i++;
        $totalPrice = $totalPrice + $row['price'];
      }
      echo '<tr><td>Total price </td><td>$'.$totalPrice . '</tr>';
      echo '</table>';
      echo 'The order will be delivered to : '.$address.'';

      //remove all items from cart
        $_SESSION['num_products'] = 0;
			?>
      <h4> Thanks for ordering from ExpressPhone store </h4>
    </center>
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
