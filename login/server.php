
<?php
$servername = "localhost";
$usernamee = "root";
$passwordd = "";
$dbname = "repair_db";

// Create connection
$conn = new mysqli($servername, $usernamee, $passwordd ,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>