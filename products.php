<?php
	if(isset($_GET['logout'])&&$_SESSION['token']==$_GET['token']){
		session_start();
		session_unset();
		session_destroy();
	} else {
		session_start();
	}
	if(!isset($_SESSION['csrftoken'])){
		$_SESSION['csrftoken'] = makeMeAToken(40);
	}
function makeMeAToken($max=40){
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
					if(isset($_GET['id'])){
						if($_SESSION['csrftoken']===$_GET['csrftoken']){
						if(isset($_SESSION['num_products'] )){
							$_SESSION['cart'][$_SESSION['num_products']] = $_GET['id'];
							$_SESSION['num_products']++;
						} else {
							$_SESSION['cart'][0] = $_GET['id'];
							$_SESSION['num_products'] = 1;
						}
						}
					}
					?>
				</div>
				<div class=shopping-cart>
				<a href="cart.php"><img src="https://image.flaticon.com/icons/svg/2/2772.svg" alt="Shopping Cart" height="30px">Shopping Cart <?php if(isset($_SESSION['num_products'])&&$_SESSION['num_products']>0) echo '<strong>(' . $_SESSION['num_products'] . ')</strong>'; ?></a>
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
			//$conn = new mysqli(ini_get("mysql.default.host"),ini_get("mysql.default.user"),ini_get("mysql.default.password"),'webshop');
			
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			?>
			<div class="login-form">
			<div class="product-list">
				<h2> Products </h2>
				<?php
					$sql = "SELECT * FROM products";
					$result = $conn->query($sql);
					if($result){
						$n = $result->num_rows;
					} else {
						$n = 0;
					}
					$i = 0;
					$nrCols = 3;

				echo '<table>';
				echo '<tr>';
				while($i < $n){
					echo '<td align="center" valign="center">';
					$row = $result->fetch_assoc();
					echo '<div class="product">
								<h4>' . $row['name'] . '</h4>
								<img src = '. $row['image'] .' alt=' . $row['name'] . ' height="200px">
								<p>'. $row['price'] .'$<p>';
					if(isset($_SESSION['csrftoken'])){
						echo '<a href="products.php?id='.$row['id'].'&csrftoken='.$_SESSION['csrftoken'].'"> Add to cart</a>
								</div>';
					} else {
						echo '<a href="products.php?id='.$row['id'].'"> Add to cart</a>
								</div>';
					}
					$i++;
					echo '</td>';
					if($i % $nrCols == 0){
						echo '</tr>';
						echo '<tr>';
					}
				}
				echo '</tr>';
				echo '</table>';



				?>
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
