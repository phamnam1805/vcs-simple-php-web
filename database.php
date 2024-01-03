<?php

class Database
{
    public $connection = NULL;
    private $server = 'localhost';
    private $database = 'vcs_web_programming';
    private $username = 'mysql';
    private $password = 'mysql';

    function connect()
    {
        $this->connection = new mysqli($this->server, $this->username, $this->password, $this->database);
        if ($this->connection->connect_errno) {
            return null;
        } else {
            return $this->connection;
        }
    }
}
