<?php


class licidator extends controller
{
    public function index(){
        if (isset($_POST['approve'])){

        }
        if (isset($_POST['disapprove'])){

        }
        if (isset($_POST['setT'])){

        }
        if (isset($_POST['endA'])){

        }
        if (isset($_POST['confirm'])){

        }
        if (isset($_POST['reject'])){

        }

        $data['title'] = 'licidator';
        $data['auctions'] = $this->db->selectAll('auction');
        $this->view(HEADER,$data);
        $this->view('licidator.php',$data);
        $this->view(FOOTER);
    }
}