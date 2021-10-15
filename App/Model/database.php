<?php


class database extends model
{
    protected $connect;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "bids";
        $db_name = "IIS_bids";

        $this->connect = new mysqli($servername, $username, $password, $db_name);
        if ($connect->connect_error) {
            die('Database connection error: ' . $connect->connect_errno);
        }
    }

    protected function select_id($table,$id, $rows = '*'){
        $sql = $this->connect->query('SELECT '.$rows.' FROM '.$table.' WHERE '.$table.'.id='.$id);
        return $sql->num_rows;
    }
}