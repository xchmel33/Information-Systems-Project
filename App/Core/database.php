<?php


class database
{
    protected $connection;
    protected $query;
    protected $show_errors = FALSE;
    protected $query_closed = TRUE;
    public $query_count = 0;

    public function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf-8');
    }

    public function query($query) {
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
                return false;
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
            return false;
        }
        return $this;
    }

    public function fetchAll() {
        $params = [];
        $row = [];
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = [];
        while ($this->query->fetch()) {
            $r = [];
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function fetchArray() {
        $params = [];
        $row = [];
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array([$this->query, 'bind_result'], $params);
        $result = [];
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function close() {
        return $this->connection->close();
    }

    public function numRows() {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function affectedRows() {
        return $this->query->affected_rows;
    }

    public function lastInsertID() {
        return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }

    private function _gettype($var) {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    public function update($table, $column_names, $column_values,$col_name, $col_value){
        if (count($column_names) != count($column_values)){
            return false;
        }
        //check if table exist
        if ($this->query("SHOW TABLES LIKE '%".$table."%'")->fetchArray() == []){
            return false;
        }

        $sql = "UPDATE ".$table." SET ";
        for ($i = 0; $i < count($column_names); $i++){
            $sql .= $column_names[$i]." = '".$column_values[$i]."', ";
        }
        $sql = substr($sql,0,-2);
        $sql .= " WHERE ".$col_name." = ".$col_value;
        return (bool)$this->query($sql);
    }

    public function insert($table, $column_names, $column_values){
        if (count($column_names) != count($column_values)){
            return false;
        }
        //check if table exist
        if ($this->query("SHOW TABLES LIKE '%".$table."%'")->fetchArray() == []){
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
        return (bool)$this->query($sql);
    }

    public function deleteRecord($table,$col_name,$col_value){
        return (bool)$this->query("DELETE FROM ".$table." WHERE ".$col_name." = '".$col_value."'");
    }

    public function selectByColumnName($table,$col_name,$col_value, $rows = '*'){
        $result = $this->query('SELECT '.$rows.' FROM '.$table.' WHERE '.$col_name.'=\''.$col_value.'\'');
        return $result->fetchAll();
    }
    public function selectAll($table, $rows = '*'){
        $result = $this->query('SELECT '.$rows.' FROM '.$table);
        return $result->fetchAll();
    }
}