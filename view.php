<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: user.html"); // Redirect to login page if the user is not logged in
    exit;
}

$host = "localhost";
$dbname = "user";
$username = "root";
$password = "";
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$username = $_SESSION['username'];

$query = "SELECT * FROM ideas WHERE email = :username";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$details = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are any details
if (count($details) > 0) {
    // Display the details
    foreach ($details as $detail) {
        echo "Name: " . $detail['name'] . "<br>";
        echo "Email: " . $detail['email'] . "<br>";
        echo "Title: " . $detail['title'] . "<br>";
        echo "Field: " . $detail['field'] . "<br>";
        echo "Description: " . $detail['description'] . "<br>";
        echo "Investment Required: " . $detail['investmentreq'] . "<br>";
        echo "Status: " . $detail['status'] . "<br>";
        echo "<br>";
    }
} else {
    echo "No details found.";
}
?>
