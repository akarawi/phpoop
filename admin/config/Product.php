<?php

class Product
{
    private $conn;
    private $table = "products";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        return $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
    }

    public function getById($id)
    {
        $id = (int) $id;
        return $this->conn->query("SELECT * FROM {$this->table} WHERE id=$id");
    }

    public function uploadImage($file)
{
    if (empty($file['name'])) {
        return null;
    }

    $targetDir = "image/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($file["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $fileName;   // ← ถ้าคุณต้องการเก็บเฉพาะชื่อไฟล์
    }

    return null;
}



    // --------------------------
    // 🔹 CREATE
    // --------------------------
    public function create($data)
    {
        // อัปโหลดรูป
        $imagePath = $this->uploadImage($_FILES['image'] ?? null);

        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table} 
            (name, description, price, stock, category_id, image, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->bind_param(
            "ssdiis",
            $data['name'],
            $data['description'],
            $data['price'],
            $data['stock'],
            $data['category_id'],
            $imagePath
        );

        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $id = (int) $id;

        // เช็ครูปใหม่
        $newImage = $this->uploadImage($_FILES['image'] ?? null);

        if ($newImage) {
            // เปลี่ยนรูปใหม่
            $imageField = ", image = '$newImage'";
        } else {
            $imageField = "";
        }

        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET name=?, description=?, price=?, stock=?, category_id=? $imageField,
                updated_at = NOW()
            WHERE id=?
        ");

        $stmt->bind_param(
            "ssdiis",
            $data['name'],
            $data['description'],
            $data['price'],
            $data['stock'],
            $data['category_id'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id)
    {
        $id = (int) $id;
        return $this->conn->query("DELETE FROM {$this->table} WHERE id=$id");
    }
}
