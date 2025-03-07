<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poultry_system";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);

    // Create tables if not exists
    $sql = "CREATE TABLE IF NOT EXISTS schedule (
        id INT AUTO_INCREMENT PRIMARY KEY,
        employee VARCHAR(255) NOT NULL,
        time_in TIME NOT NULL,
        time_out TIME NOT NULL
    )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS feeds (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        time TIME NOT NULL,
        sack INT NOT NULL
    )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS mortality (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        time TIME NOT NULL,
        deaths INT NOT NULL,
        maturity ENUM('Chick', 'Grower', 'Adult') NOT NULL
    )";
    $conn->query($sql);
} else {
    die("Error creating database: " . $conn->error);
}
?>
