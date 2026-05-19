<?php

// Define a class called "Database"
class Database {             
    // DB server address (local)           
    private $host = "localhost";       
    // Name of the database to connect to 
    private $dbname = "webdev_project"; 
    // DB username
    private $username = "root";     
    // DB password (empty)
    private $password = "";    
    // Variable to store the connection (at the start - null)        
    private $connection;               

     // Public method to get a DB connection
    public function connect() {      
        // Only connect if not already connected
        if ($this->connection === null) { 
            // Try to connect, catch errors if it fails  
            try {                         
                // Create a new PDO connection  
                $this->connection = new PDO(          
                    // DSN string: driver, host, db name, encoding  
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8", 
                    // Pass the username
                    $this->username,        
                     // Pass the password          
                    $this->password                     
                );
                // Configure the connection:
                $this->connection->setAttribute(      
                    // setting: error mode 
                    PDO::ATTR_ERRMODE,       
                    // value: throw exceptions on errors          
                    PDO::ERRMODE_EXCEPTION              
                );
            // If connection fails, catch error
            } catch (PDOException $e) {     
                // Stop the script and show the error message            
                die("DB Error: " . $e->getMessage());   
            }
        }

        // Return the active connection
        return $this->connection;       
    }
}