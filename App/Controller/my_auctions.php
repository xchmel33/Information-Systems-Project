<?php


class my_auctions extends controller
{
    public function index(){
        if (isset($_POST['submit'])){

        }


        $data['title'] = 'my_auctions';
        $data['stylesheet'] = PATH_STYLESHEET.'master.css';
        $data['created_auctions'] = $this->db->selectAll('auction');
        $data['joined_auctions'] = $this->db->selectAll(['auction_user','auction'],'auction_id');
        $this->view(HEADER,$data);
        $this->view('my_auctions.php',$data);
        $this->view(FOOTER);
    }
}