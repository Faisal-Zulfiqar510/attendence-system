<?php

class Dph
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect()
    {
        $this->servername="localhost";
        $this->dbname = "cshr";
        $this->username = "root";
        $this->password = "coeus123";
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        return $conn;
    }
}
