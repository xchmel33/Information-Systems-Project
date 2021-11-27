<?php


class home extends controller
{
    function index(){
        $data['title'] = 'home';
        $data['stylesheet'] = PATH_STYLESHEET.'master.css';
        //  $data['action_array'][0..n]['column names']
        $data['auction_array'] = $this->db->selectAll('auction');

        $this->view(HEADER,$data);
        $this->view('home_page.php',$data);
        $this->view(FOOTER,$data);
    }
}