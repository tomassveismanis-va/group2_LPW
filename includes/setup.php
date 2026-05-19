<?php

// Load the database connection
require_once "includes/db.php";

try {

    $sql1 = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) NOT NULL
    )";

    $sql2 = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') DEFAULT 'user',
        last_visit DATETIME NULL
    )";

    $sql3 = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Create services table if it doesn't already exist
    $pdo->exec($sql1);
    // Create users table if it doesn't already exist
    $pdo->exec($sql2);
    // Create messages table if it doesn't already exist
    $pdo->exec($sql3);

    // Confirm success
    echo "Tables created successfully!";

} catch (PDOException $e) {

    // If something goes wrong, show the error message
    echo "Error: " . $e->getMessage();
}