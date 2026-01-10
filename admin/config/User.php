<?php

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    // ดึงข้อมูลทั้งหมด
    public function getAllUser()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($data)
    {
        $sql = "UPDATE {$this->table}
            SET fname = ?, lname = ?, email = ?, phonenumber = ?, role = ?, status = ?, updated_at = NOW()
            WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssi",
            $data['fname'],
            $data['lname'],
            $data['email'],
            $data['phonenumber'],
            $data['role'],
            $data['status'],
            $data['id']
        );

        return $stmt->execute();
    }


    public function delete($id)
    {
        // กันลบ admin
        $query = "DELETE FROM {$this->table}
              WHERE id = ? AND role != 'admin'";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }


    public function changeStatus($id)
    {
        $query = "UPDATE {$this->table}
          SET status = CASE 
                WHEN status = 'Banned' THEN 'Active'
                WHEN status = 'Active' THEN 'Banned'
                ELSE status
              END,
              updated_at = NOW()
          WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }



}
?>