<?php


class database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->connect->connect_error) {
            die('Database connection error: ' . $this->connect->connect_errno);
        }
    }

    public function query($sql){
        $result = $this->connect->query($sql);
        return $result->fetch_all();
    }

    public function selectById($table,$id, $rows = '*'){
        $result = $this->connect->query('SELECT '.$rows.' FROM '.$table.' WHERE '.$table.'_id='.$id);
        return $result->fetch_all();
    }

    public function selectByX($table,$x_name,$x_value, $rows = '*'){
        $result = $this->connect->query('SELECT '.$rows.' FROM '.$table.' WHERE '.$x_name.'=\''.$x_value.'\'');
        return $result->fetch_all();
    }

    public function insert($table, $column_names, $column_values){
        if (count($column_names) != count($column_values)){
            return false;
        }
        $sql = "INSERT INTO ".$table."(";
        foreach ($column_names as $column_name){
            $sql .= $column_name.",";
        }
        $sql = substr($sql,0,-1).") VALUES (";
        foreach ($column_values as $column_value){
            $sql .= "'".$column_value."',";
        }
        $sql = substr($sql,0,-1).")";
        return $this->connect->query($sql);
    }



}