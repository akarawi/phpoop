<?php

class Login
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function attempt(string $email, string $password): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE email=? AND status='active'"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}
