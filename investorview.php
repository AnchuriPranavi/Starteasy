<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>
    <?php
    // Get the query parameters from the URL
    $name = $_GET['name'] ?? '';
    $description = $_GET['description'] ?? '';

    // Display the details on the page
    echo "<p>Name: $name</p>";
    echo "<p>Description: $description</p>";
    ?>
</body>
</html>
