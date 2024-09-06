<!DOCTYPE html>
<html>
<head>
    <title>Idea Details</title>
    <link rel="icon" href="icon2.png">
    <style>
        body {
            background-image: url("p2.jpeg.jpg");
            background-size: cover;
          
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
        }

        .idea-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            align-items: center;
            
        }

        .idea {
            position: relative;
            margin-bottom: 40px;
            background-image: url("p1.png");
            background-size: cover;
            border-radius: 5px;
            padding: 20px;
            width: 70%; /* Adjust the width as needed */
            opacity: 0; /* Hide the box initially */
            animation-name: fade-in;
            animation-duration: 1s;
            animation-fill-mode: forwards;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateX(20px); /* Optional: Slide in effect */
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .idea-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
            text-transform: uppercase;
        }
        .idea-name{
            color:black;
        }

       .bold-label {
            font-weight: bold;
            color:black;
        }

        .idea-description {
            margin-top: 10px;
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
            color: black;
            word-wrap: break-word;
        }

        .details-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fff;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .details-button:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h1>Idea Details</h1>

    <div class="idea-container">
        <?php
        $host = "localhost";
        $dbname = "user";
        $username = "root";
        $password = "";
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $query = "SELECT * FROM ideas";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are any details
        if (count($details) > 0) {
            // Display the details with animation
            $delay = 0.2; // Initial delay for the first box
            foreach ($details as $detail) {
                echo '<div class="idea" style="animation-delay: ' . $delay . 's;">';
                echo '<div class="idea-title">' . $detail['title'] . '</div>';
                echo '<div class="idea-name"><span class="bold-label">NAME:</span> ' . $detail['name'] . '</div>';
                echo '<div class="idea-description"><span class="bold-label">DESCRIPTION:</span> <br><br>' . $detail['description'] . '</div>';
                echo '<div class="details-button" onclick="showDetails(this)">Show Details</div>';
                echo '</div>';
                $delay += 0.2; // Increment the delay for each subsequent box
            }
        } else {
            echo "No details found.";
        }
        ?>
        
    </div>

    <script>
        function showDetails(title) {
            // Get the idea title
            var ideaTitle = title.parentNode.querySelector('.idea-title').innerText;

            // Navigate to investordetails.php with the idea title as a query parameter
            var url = 'investordetails.php?title=' + encodeURIComponent(ideaTitle);
            window.location.href = url;
        }
    </script>


</body>
</html>
