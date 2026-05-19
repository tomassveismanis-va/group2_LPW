<?php
// Load the Database class from the same folder
require_once __DIR__ . "/Database.php"; 
class Service {
    // Stores the database connection
    private $conn; 

    public function __construct() {
        // Create a new Database object
        $database = new Database();       
        // Connect to the DB and save the connection
        $this->conn = $database->connect(); 
    }

    // Create a new service record in the database
    public function create($title, $desc, $img) {
        $sql = "INSERT INTO services (title, description, image) VALUES (:title, :description, :image)";
        // Prepare the query (safe from SQL injection)
        $stmt = $this->conn->prepare($sql); 
        // Run the query with the actual values
        return $stmt->execute([             
            ':title' => $title,
            ':description' => $desc,
            ':image' => $img
        ]);
    }

    // Get all services, newest first
    public function readAll() {
        $sql = "SELECT * FROM services ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Return all rows as an array
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Get one service by its ID
    public function readById($id) {
        $sql = "SELECT * FROM services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        // Return a single row as an array
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // Search services by keyword in title or description
    public function search($keyword) {
        $sql = "SELECT * FROM services 
                WHERE title LIKE :keyword OR description LIKE :keyword
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            // % means "anything before/after the keyword"
            ':keyword' => '%' . $keyword . '%' 
        ]);
        // Return all matching rows
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Update the title and description of an existing service
    public function update($id, $title, $desc) {
        $sql = "UPDATE services SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $desc
        ]);
    }

    // Delete a service by its ID
    public function delete($id) {
        $sql = "DELETE FROM services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}