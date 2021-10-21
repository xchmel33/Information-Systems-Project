<?php


class database
{
    protected $connect;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "IIS_bids";

        $this->connect = new mysqli($servername, $username, $password, $db_name);
        if ($this->connect->connect_error) {
            die('Database connection error: ' . $this->connect->connect_errno);
        }
    }

    protected function selectById($table,$id, $rows = '*'){
        $sql = $this->connect->query('SELECT '.$rows.' FROM '.$table.' WHERE '.$table.'.id='.$id);
        return $sql->num_rows;
    }
}