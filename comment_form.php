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
			<div class="login-form">
				<?php

	$servername = "localhost";

// Create connection
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
				$stmt = $conn->prepare("INSERT INTO comments (name, comment, score) VALUES (?, ?, ?)");
				$stmt->bind_param("ssi", $name, $comment, $score);

				$name = htmlspecialchars($_POST['name']);
				$comment = htmlspecialchars($_POST['comment']);
				$score = htmlspecialchars($_POST['score']);
				$stmt->execute();

				echo "<h2>Thanks for the comment!</h2>";
				$stmt->close();
				$conn->close();
				echo '<a href="contact.php"> Back to Contact page </a>';

?>

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
