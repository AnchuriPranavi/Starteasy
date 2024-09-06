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
    $fullname = $_POST['fullname'] ;
    $email = $_POST['email'] ;
    $password = $_POST['password'];
    $phone = $_POST['phone_no'];

    // Insert data into the database
    $sql = "INSERT INTO investor (name, email, password, phoneno) VALUES ('$fullname', '$email', '$password', '$phone')";

    if (mysqli_query($con, $sql)) {
        echo "Successfully inserted.";
        header("Location: investorlogin.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
