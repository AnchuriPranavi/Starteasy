<!DOCTYPE html>
<html>
<head>
    <title>Titles</title>
    <link rel="icon" href="icon2.png">
    <style>
        /* Add CSS styles here */
        body {
            background-image: url('title.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        button {
            padding: 15px 30px;
            margin-bottom: 10px;
            background-color: purple;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 18px;
        }
        
        button:hover {
            background-color:  #45a049;
        }
        
        
        h1 {
            color: black;
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <div class="button-container">
        <h1>Edit Or View Your Ideas</h1>
        <?php
        session_start(); // Start the session

        // Database connection configuration
        $host = "localhost";
        $dbname = "user";
        $username = "root";
        $password = "";
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Retrieve the logged-in user's username from the session
        $logged_in_username = $_SESSION['username'];

        // Query the database to retrieve all "title" column details associated with the logged-in user's username
        $query = "SELECT title FROM ideas WHERE email = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $logged_in_username);
        $stmt->execute();
        $titles = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Display the titles as buttons
        foreach ($titles as $title) {
            echo '<button type="button" onclick="showDetails(\'' . $title . '\')">' . $title . '</button><br>';
        }
        ?>

        <script>
        function showDetails(title) {
            // Redirect to details.php with the title as a query parameter
            window.location.href = 'details.php?title=' + encodeURIComponent(title);
        }
        </script>
    </div>
</body>
</html>
