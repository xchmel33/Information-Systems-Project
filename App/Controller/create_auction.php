<?php

class create_auction extends controller
{
    function index(){
        $data['title'] = 'create_auction';
        $this->view(HEADER,$data);
        $this->view("create_auction.php");
        $this->view(FOOTER);
    }

    function create_auction(){
        $limit = DateTime::createFromFormat('Y-m-d H:i',$_POST["date_limit"] . ' ' . $_POST["time_limit"]);
        if($this->db->insert("auction",
            ["item_name","auction_type", "auction_rule","auction_description","start_price","end_time"],
            [$_POST["name"], $_POST["typ_aukcie"], $_POST["pravidla_aukcie"], $_POST["description"], $_POST["starting_price"], $limit->format("Y-m-d H:i:s")]) === false) {
            echo "kokot";
        }
    }
}