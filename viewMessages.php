<?php
// Include database connection
require('db.php');

// Fetch messages from the database
$query = "SELECT * FROM messages";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all messages
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages</title>
    <link rel="stylesheet" href="messages.css">
</head>

<body>
    <h1 style="color:white; margin-left:50px;margin-top:20px;">Messages</h1>
    <table border="1" style="color:white;margin-left:50px;margin-top:20px;">
        <tr >
            <th>Name</th>
            <th>Email</th>
            <th>Stream</th>
            <th>Phone</th>
            <th>Suggestions</th>
        </tr>

        <?php
        // Display all messages
        foreach ($messages as $message) {
            echo "<tr >
                    <td>" . htmlspecialchars($message['name']) . "</td>
                    <td>" . htmlspecialchars($message['email']) . "</td>
                    <td>" . htmlspecialchars($message['stream']) . "</td>
                    <td>" . htmlspecialchars($message['phone']) . "</td>
                    <td>" . htmlspecialchars($message['suggestions']) . "</td>
                </tr>";
        }
        ?>
    </table>
</body>

</html>
