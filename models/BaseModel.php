<?php
namespace Models;

class BaseModel {
    protected $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    protected function getConnection(){
        return $this->conn;
    }
}