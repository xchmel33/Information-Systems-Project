<?php


class model extends controller
{
    public function index()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "IIS_bids";
        new database($servername,$username,$password,$db_name);
    }
}