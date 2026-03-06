<?php
namespace Models;

use Interfaces\CrudInterface;

class Book extends BaseModel implements CrudInterface {

    private $table = "books";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, stock) VALUES (?, ?, ?)");
        return $stmt->execute([$data['title'], $data['author'], $data['stock']]);
    }

    public function read() {
        return $this->conn->query("SELECT * FROM books");
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE books SET title=?, author=?, stock=? WHERE id=?");
        return $stmt->execute([$data['title'], $data['author'], $data['stock'], $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function checkStock($qty = 1){
    if($qty <= 0){
        return "Jumlah tidak valid";
    }
    return "Cek stok untuk $qty buku";
    }
}