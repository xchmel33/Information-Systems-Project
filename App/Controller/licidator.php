<?php


class licidator extends controller
{
    public function index(){
        $data['title'] = 'licidator';
        $data['auctions'] = $this->db->selectAll('auction');

        $this->view(HEADER,$data);
        $this->view('licidator.php',$data);
        $this->view(FOOTER);
    }
}