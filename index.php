<html>
<head>
<title>Min sida</title>
<link rel="stylesheet" type="text/css" href="mall.css" />
</head>
<body>
<?php 
	echo 'Hello world! <br />';
?>
This is my site!

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
echo "Connected successfully";
?>

<form action="login.php" method="post">
<input type="text" value="username" name="username" />
<input type="text" value="password" name="password" />
<input type="submit" value="Log in" />
</form> 
<form action="register.php" method="post">
<input type="submit" value="Register new user" />
</form>
</body>
</html> 