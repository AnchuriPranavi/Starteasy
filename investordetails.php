<!DOCTYPE html>
<html>
<head>
    <title>Idea Details</title>
    <link rel="icon" href="icon2.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image:url("d1.png.webp");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .details-box {
           width: 70%;
            padding: 50px;
            background-color:aliceblue;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            animation: fade-in 1s ease-out;
            word-wrap: break-word;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
            color: #333;
            
        }

        p {
            margin-bottom: 10px;
            font-size: 20px;
            color: #666;
        }

        .bold {
            font-weight: bold;
            color: brown;
        }

        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="details-box">
            <?php
            $host = "localhost";
            $dbname = "user";
            $username = "root";
            $password = "";

            // Get the selected idea title from the query parameter
            $title = $_GET['title'];

            try {
                // Connect to the database
                $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

                // Prepare and execute the query to fetch the details based on the idea title
                $query = "SELECT * FROM ideas WHERE title = :title";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':title', $title);
                $stmt->execute();

                // Fetch the details as an associative array
                $details = $stmt->fetch(PDO::FETCH_ASSOC);

                // Display the details
                if ($details) {
                    echo "<h1>" . $details['title'] . "</h1>";
                    echo"<br>";
                    echo "<p><span class=\"bold\">Name: </span>" . $details['name'] . "</p>";
                    
                    echo "<p><span class=\"bold\">Email: </span>" . $details['email'] . "</p>";
                    echo "<p><span class=\"bold\">Field: </span>" . $details['field'] . "</p>";
                    echo "<p><span class=\"bold\">Description: </span>" . $details['description'] . "</p>";
                    echo "<p><span class=\"bold\">Investment Required: </span>" . $details['investmentreq'] . "</p>";
                    echo "<p><span class=\"bold\">Status: </span>" . $details['status'] . "</p>";
                    
                } else {
                    echo "<p>No details found for the selected idea.</p>";
                }
            } catch (PDOException $e) {
                // Handle any database errors
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</body>
</html>
