<html>
<head>
<title>Min sida</title>
<link rel="stylesheet" type="text/css" href="mall.css" />
</head>
<body>
<?php
$servername = "localhost";

$username = $_POST['username'];
$password = $_POST['password'];

// Create connection
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br />";

$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";

$result = $conn->query($sql);

if($result->num_rows == 0){
	echo 'User not found<br />';
} else {
	echo 'User found<br />';
	$row = $result->fetch_assoc();

	$salt = $row['salt'];

	if(md5($password.$salt) === $row['password']){
		echo '<br />Password correct';
	} else {
		echo '<br />Password incorrect';
	}
}

?>
</body>
</html> 