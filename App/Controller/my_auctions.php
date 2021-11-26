<?php


class my_auctions extends controller
{
    public function index(){
        $data['title'] = 'my_auctions';
        $data['stylesheet'] = PATH_STYLESHEET.'master.css';
        /*$data['auctions_array'] = $this->db->selectAll('user_to_auction');*/
        $this->view(HEADER,$data);
        $this->view('my_auctions.php');
        $this->view(FOOTER);
    }
}