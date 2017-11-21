<?php
$servername = "localhost";
$username = "Admin";
$password = "H9F6QfnHsKVLHX8O";
$database = "emailDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully </br>";


$createDatabase = "CREATE DATABASE IF NOT EXISTS " .$database;

if ($conn->query($createDatabase) === TRUE) {

	$conn = new mysqli($servername, $username, $password, $database);
    echo "Database created or (and) connected successfully </br>";
} else {
    echo "Error creating database: " . $conn->error;
}


$createTable = "CREATE TABLE IF NOT EXISTS Email(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
email VARCHAR(50) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($createTable) === TRUE) {
    echo "Table Email created if not exists successfully </br>";
} else {
    echo "Error creating table: " . $conn->error;
}


if(isset($_POST['submit']) && $_POST['submit'] !== FALSE ) {
	if ($_POST['email'] != null) {
		$email = $_POST['email'];
		$postEmail = "INSERT INTO Email(email)
        VALUES(?)";
    	$stmt = $conn->prepare($postEmail);

    	if (isset($stmt) && $stmt !== FALSE) {
			$stmt->bind_param("s", $email);
			echo "<h1> Email saved </h1>";
			$stmt->execute();   
            $stmt->close();
            $conn->close(); 	
		}
	} else {
	echo "<h1> Please fill out the email field";
	}
} 

header("refresh:5;url= index.html"); 
exit();
?>