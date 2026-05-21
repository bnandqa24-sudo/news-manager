<?php


class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "newspaperdp";
    private $conn;

    public function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    
}