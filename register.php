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

<form action="register_post.php" method="post">
Username: <input type="text" value="" name="username" /><br />
Password: <input type="text" value="" name="password" /><br />
Password again: <input type="text" value="" name="password2" />
<input type="submit" value="Register" />
</form> 
</body>
</html> 