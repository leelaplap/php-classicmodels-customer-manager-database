<?php


class DBConnect
{
    protected $dsn;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->dsn = "mysql:host=localhost;dbname=classicModels";
        $this->username = "dat";
        $this->password = "1";
    }

    public function connect()
    {
        $conn = null;
        try {
            $conn = new PDO($this->dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return $conn;
    }
}