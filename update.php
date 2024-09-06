<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize form inputs
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $field = $_POST['field'];
    $message = $_POST['message'];
    $investment = $_POST['investment'];
    $status = $_POST['status'];

    // Update data in the database
    $query = "UPDATE ideas SET name = :name, email = :email, field = :field, description = :description, investmentreq = :investmentreq, status = :status WHERE title = :title";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':field', $field);
    $stmt->bindParam(':description', $message);
    $stmt->bindParam(':investmentreq', $investment);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':title', $title);

    if ($stmt->execute()) {
        echo "Successfully updated.";
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$conn = null;
?>
