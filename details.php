<?php
// Get the title from the query parameter
$title = $_GET['title'];

// Database connection configuration
$host = "localhost";
$dbname = "user";
$username = "root";
$password = "";
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Fetch the details for the given title from the database
$query = "SELECT * FROM ideas WHERE title = :title";
$stmt = $conn->prepare($query);
$stmt->bindParam(':title', $title);
$stmt->execute();
$idea = $stmt->fetch(PDO::FETCH_ASSOC);

// Update the idea in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $field = $_POST['field'];
    $description = $_POST['message'];
    $investment = $_POST['investment'];
    $status = $_POST['status'];

    $query = "UPDATE ideas SET name = :name, email = :email, field = :field, description = :description, investmentreq = :investment, status = :status WHERE title = :title";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':field', $field);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':investment', $investment);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    // Check for errors during the update
    $errorInfo = $stmt->errorInfo();
    if ($errorInfo[0] !== '00000') {
        echo "Error updating record: " . $errorInfo[2];
    } else {
        // Display the popup message after the changes are saved
        echo '<script>
            window.onload = function() {
                var popup = document.createElement("div");
                popup.className = "popup";

                var message = document.createElement("div");
                message.className = "popup-message";
                message.innerText = "Changes saved";
                popup.appendChild(message);

                var closeButton = document.createElement("button");
                closeButton.innerText = "OK";
                closeButton.onclick = function() {
                    document.body.removeChild(popup);
                };

                popup.appendChild(closeButton);
                document.body.appendChild(popup);
            };
        </script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Idea</title>
    <link rel="icon" href="icon2.png">
    <link rel="stylesheet" href="create.css">
    <style>
        body {
            background-image: url("keyboard.png");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px; /* Adjust width as desired */
            height: 100px; /* Adjust height as desired */
            padding: 20px;
            background-color: grey;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .popup-message {
            text-align: center;
            margin: auto;
            color: white;
        }

        .popup button {
            margin-top: 20px;
            color: green;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="creation"><br><br>
        <form action="" method="POST">
            <input type="hidden" name="csrfmiddlewaretoken" value="your-csrf-token-here">
           
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <h1 style="color:white;">Edit Idea</h1>
            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" id="FullName" required placeholder="Enter the Full name" value="<?php echo $idea['name']; ?>">
            <br>
            <br>
            <label for="email">E-Mail id:</label>
            <input type="email" name="email" id="email" placeholder="Enter the Email" required value="<?php echo $idea['email']; ?>">
            <br>
            <br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required placeholder="Enter the Title" value="<?php echo $idea['title']; ?>">
            <br>
            <br>
            <label for="field">Field:</label>
            <textarea name="field" id="field" rows="2" cols="25" required><?php echo $idea['field']; ?></textarea>
            <br>
            <br>
            <label for="message">Description:</label>
            <textarea name="message" id="message" rows="10" cols="25" required placeholder="Enter your idea description in 800 words"><?php echo $idea['description']; ?></textarea>
            <br>
            <br>
            <label for="investment">Investment Required:</label>
            <input type="text" name="investment" id="investment" required placeholder="Quote the Amount" value="<?php echo $idea['investmentreq']; ?>">
            <br>
            <br>
            <label>Status of Investment:</label>
            <input type="text" name="status" id="status" required placeholder="status" value="<?php echo $idea['status']; ?>">
            <br>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
