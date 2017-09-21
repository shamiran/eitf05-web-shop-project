<html>
<head>
<title>Contacts</title>
<link rel="stylesheet" type="text/css" href="mall.css" />
</head>
<body>
</body>
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
<?php include 'comment_display.php';?>;
		<main class="content">
			<div class ="login-form">

				<h2> Leave new comment</h2>
				<form action="comment_form.php" method="post">
					<p></p>
					Name: <input type="text" name="name" /><br /><br />
					<p></p>
					Comment:<br /> <textarea name='comment'></textarea><br />
  <input type="radio" name="score" value="1"> 1<br />
  <input type="radio" name="score" value="2"> 2<br />
  <input type="radio" name="score" value="3"> 3<br />
  <input type="radio" name="score" value="4"> 4<br />
  <input type="radio" name="score" value="5"> 5<br />
					<p>Leave a comment about our site!</p>
					<input type="submit" value="Submit" />
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
</form>
</html>
