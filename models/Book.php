<?php
namespace Models;

use Interfaces\CrudInterface;

class Book extends BaseModel implements CrudInterface
{

    public function create($data)
    {
        if(empty($data['title']) || empty($data['author'])) {
            return false;
        }

        $sql = "INSERT INTO books(title,author,stock)
                VALUES(
                '{$data['title']}',
                '{$data['author']}',
                '{$data['stock']}'
                )";

        return $this->conn->query($sql);
    }

    public function read()
    {
        $sql = "SELECT * FROM books";
        $result = $this->conn->query($sql);

        $books = [];

        while($row = $result->fetch_assoc()){
            $books[] = $row;
        }

        return $books;
    }

    public function update($id,$data)
    {
        $sql = "UPDATE books SET
                title='{$data['title']}',
                author='{$data['author']}',
                stock='{$data['stock']}'
                WHERE id=$id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM books WHERE id=$id";
        return $this->conn->query($sql);
    }
}