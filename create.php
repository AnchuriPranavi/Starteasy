<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "user";

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection to the database failed: " . mysqli_connect_error());
}

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

    // Prepare the statement
    $stmt = mysqli_prepare($con, "INSERT INTO ideas (name, email, title, field, description, investmentreq, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssssss", $fullname, $email, $title, $field, $message, $investment, $status);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Successfully inserted.";
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
