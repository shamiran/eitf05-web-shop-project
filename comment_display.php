<?php
$servername = "localhost";
$conn = new mysqli($servername, 'webadmin', 'adminadmin','webshop');

 // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM `comments` ORDER BY timestamp DESC";

if ($result = $conn->query($query)) {

	while($row = $result->fetch_assoc()) {
		$name = $row['name'];
		$comment = $row['comment'];
		$score = $row['score'];
		$timestamp = $row['timestamp'];

		echo " <div class = 'disp-comment'>
		<b>Name:</b> $name<br />
		<b>Comment:</b> $comment<br />
		<b>Score:</b> $score<br />
		<b>Date and time:</b> $timestamp<br />
		<hr>
		</div>
	";
	}

	$result->free();

}

$conn->close();
?>
