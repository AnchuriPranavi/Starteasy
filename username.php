<?php
session_start(); 


$host = "localhost";
$dbname = "user";
$username = "root";
$password = "";

try {
  
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
  $logged_in_username = $_SESSION['username'];

  
  $query = "SELECT name FROM registration WHERE email = :username";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':username', $logged_in_username);
  $stmt->execute();

  // Fetch the user's name
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $userName = $row['name'];

  echo $userName; // Return the user's name as the response
} catch (PDOException $e) {
  echo "Error retrieving user's name: " . $e->getMessage();
}

// Close the database connection if necessary (not needed for PDO)
// $conn = null;
?>
