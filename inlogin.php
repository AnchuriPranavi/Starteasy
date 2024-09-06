<?php
// Database connection configuration
$host = "localhost";
$dbname = "user"; 
$username = "root";
$password = ""; 
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$errorMsg = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // Query the database to find a matching user
    $query = "SELECT * FROM investor WHERE email = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $entered_username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a user is found and the entered password matches the stored password
    if ($user && $entered_password == $user['password']) {
        session_start();
        $_SESSION['username'] = $entered_username;

        // Send success response
        $response = array('success' => true);
        echo json_encode($response);
        exit;
    } else {
        // Set the error message
        $errorMsg = "Wrong username or password.";

        // Send error response
        $response = array('success' => false, 'message' => $errorMsg);
        echo json_encode($response);
        exit;
    }
}
?>