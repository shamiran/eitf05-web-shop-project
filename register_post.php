<html>
<head>
<title>Min sida</title>
<link rel="stylesheet" type="text/css" href="mall.css" />
</head>
<body>
<?php
$servername = "localhost";

// Create connection
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br />";


$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$blacklistTest = false;

$sql = "SELECT * FROM blacklist";
$result = $conn->query($sql);
$n = $result->num_rows;
$i = 0;
while($i < $n){
	if($password === $result->fetch_assoc()['password']){
		$blacklistTest = true;
		$i = $n;
	}
}


if($blacklistTest){
	echo 'Too common password!';
} else if($username == "" || $username == null || $password == "" || $password == null){
	echo 'Username and/or password not filled in.';
} else if($password === $password2){
	$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";
	
	$result = $conn->query($sql);
	print($result);
	if($result->num_rows > 0){
		echo 'Username already occupied';
	} else {

		$saltlength = 6;
		$strong = true;
		//$salt = openssl_random_pseudo_bytes($saltlength,$strong);
		//$salt = random_bytes($saltlength);
		$salt = makeMeASalt(6);
		
		$sql = "INSERT INTO users (username, password, salt) VALUES ('" . $username . "', '" . md5($password.$salt) . "', '" . $salt . "')";
		echo $sql . '<br />';
		if($conn->query($sql)===TRUE){
			echo 'User registered';
		} else {
			echo 'Unknown error';
		}
	}
} else {
	echo 'Passwords do not match!';
}

function makeMeASalt($max=40){
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
<br /><a href="index.php">Back to start site</a>
</body>
</html> 