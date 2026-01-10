<?php
class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "plantdb";
    public $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);


        if ($this->conn->connect_error) {
            die("can not to connect to database" . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8");
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function close()
    {
        $this->conn->close();
    }
}
?>