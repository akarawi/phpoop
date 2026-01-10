<?php

class Register
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * สมัครสมาชิก
     */
    public function create(array $data): bool
    {
        $username = trim($data['username']);
        $fname = trim($data['fname']);
        $lname = trim($data['lname']);
        $phone = trim($data['phonenumber']);
        $email = trim($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $role = 'user';
        $status = 'active';
        $created_at = date('Y-m-d H:i:s');

        // เช็ก email ซ้ำ
        if ($this->emailExists($email)) {
            return false;
        }

        $sql = "INSERT INTO users
            (username, fname, lname, phonenumber, email, password, role, status, created_at)
            VALUES (?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssss",
            $username,
            $fname,
            $lname,
            $phone,
            $email,
            $password,
            $role,
            $status,
            $created_at
        );

        return $stmt->execute();
    }

    /**
     * ตรวจ email ซ้ำ
     */
    private function emailExists(string $email): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM users WHERE email=?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}
?>