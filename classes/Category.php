<?php

class Category {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // إضافة فئة
    public function add($name) {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    // عرض جميع الفئات
    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }
}