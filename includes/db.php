<?php

// Load the Database class from the classes folder
require_once __DIR__ . "/../classes/Database.php";

// Create a new Database object
$database = new Database();

// Connect to the database and save the connection in $pdo
$pdo = $database->connect();