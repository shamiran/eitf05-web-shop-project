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
				//strip tags to remove if trying to insert html tags
				//trim to remove whitespace
				$name = strip_tags($_POST['name']);
				$name = htmlspecialchars($name)
				$name = mysqli_real_escape_string($conn,$name);
				$comment = strip_tags($_POST['comment']);
				$comment = htmlspecialchars($comment);
				$comment = mysqli_real_escape_string($conn, $comment);
				$score = mysqli_real_escape_string($_POST['score']);


				$query = "INSERT INTO `comments` (`name`, `comment`, `score`, `timestamp`) VALUES ('$name', '$comment', '$score', CURRENT_TIMESTAMP);";

				$conn->query($query);

				echo "<h2>Thanks for the comment!</h2>";
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
