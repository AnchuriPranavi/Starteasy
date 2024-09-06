<?php
// Database connection configuration
$host = "localhost"; // Replace with your database host
$dbname = "user"; // Replace with your database name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password

// Establish database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user's email address
    $email = $_POST["email"];

    // Generate and store OTP
    $otp = generateOTP();
    storeOTP($email, $otp);

    // Send OTP to the user (e.g., via email)
    sendOTP($email, $otp);

    // Redirect to the OTP verification page
    header("Location: otp-verification.html");
    exit;
}

// Function to generate a random OTP
function generateOTP() {
    // Generate a random 6-digit OTP
    return rand(100000, 999999);
}

// Function to store the OTP in the database
function storeOTP($email, $otp) {
    // Update the user table with the generated OTP
    $query = "UPDATE registration SET otp = :otp WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':otp', $otp);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

// Function to send the OTP to the user
function sendOTP($email, $otp) {
    // Send the OTP to the user via email or other method
    // Implement your email sending logic here using the PHP mail() function or a third-party library
    // Example
    $subject = "Password Reset OTP";
    $message = "Your OTP for password reset is: " . $otp;
    $headers = "From: your_email@example.com"; // Replace with your email address or a valid sender address

    // Send the email
    mail($email, $subject, $message, $headers);
}
?>
