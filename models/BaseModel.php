<?php
namespace Models;

use Config\Database;

class BaseModel
{
    protected $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }
}