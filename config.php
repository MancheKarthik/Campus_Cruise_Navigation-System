<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stream = $_POST['stream'];
    $phone = $_POST['phone'];
    $suggestions = $_POST['suggestions'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO messages (name, email, stream, phone, suggestions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $stream, $phone, $suggestions);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>
                alert('Your message has been submitted!');
                window.location.href = 'contactusMAIN.html';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
