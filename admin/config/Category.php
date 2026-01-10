<?php

class Category
{
    private $conn;
    private $table = "category";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        return $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($name)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table}(name, created_at, updated_at)
            VALUES(?, NOW(), NOW())
        ");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    public function update($id, $name)
    {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET name=?, updated_at=NOW()
            WHERE id=?
        ");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
