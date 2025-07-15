<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_db";

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
