<?php


class licidator extends controller
{
    public function index(){
        if (isset($_POST['approve'])){
            $this->db->update('auction',['organizator_id','status'],[$_SESSION['user_id'],'started'],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['disapprove'])){
            $this->db->update('auction',['organizator_id','status'],[-1,'disapproved'],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['setT'])){

        }
        if (isset($_POST['endA'])){

        }
        if (isset($_POST['confirm'])){
            $this->db->update('auction_user',['user_approved'],[1],'auction_id',$_POST['auction_id']);
        }
        if (isset($_POST['reject'])){
            $this->db->update('auction_user',['user_approved'],[-1],'auction_id',$_POST['auction_id']);
        }

        $data['title'] = 'licidator';
        $data['auctions'] = $this->db->selectAll('auction');
        $this->view(HEADER,$data);
        $this->view('licidator.php',$data);
        $this->view(FOOTER);
    }
}