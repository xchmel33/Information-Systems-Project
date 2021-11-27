<?php

class create_auction extends controller
{
    function index(){
        $data['title'] = 'create_auction';
        $this->view(HEADER,$data);
        $this->view("create_auction.php");
        $this->view(FOOTER);
    }

    function create_a(){
        $limit = DateTime::createFromFormat('Y-m-d H:i',$_POST["date_limit"] . ' ' . $_POST["time_limit"]);
        if($this->db->insert("auction",
            ["item_name","auction_type", "auction_rule","auction_description","start_price","end_time","image"],
            [$_POST["name"], $_POST["typ_aukcie"], $_POST["pravidla_aukcie"], $_POST["description"], $_POST["starting_price"], $limit->format("Y-m-d H:i:s"),$_POST['image_location']]) === false) {
            echo "kokot";
        }
        header('Location:../my_auctions');
    }
    public function upload_image(){
        $filename = $_FILES['file']['name'];
        $location = PATH_IMAGE.$filename;
        $imageFileType = strtolower(pathinfo($location,PATHINFO_EXTENSION));
        $valid_extensions = array("jpg","jpeg","png");
        $response = 0;
        /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                $response = $location;
            }
        }
        echo $response;
    }
}