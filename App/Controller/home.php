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

    function join(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../login");
        }
        else if(!$this->db->insert("auction_user",["auction_id","user_id","user_approved"],[$_POST['auction_id'],$_SESSION['user_id'],0])) {
            echo "error joining auction";
        }
        else{
            header("Location: ../my_auctions");
        }

    }
}