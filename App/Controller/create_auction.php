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
        if(!isset($_SESSION['valid']) || !$_SESSION['valid']){
            header('Location:../login');
            exit;
        }
        if($this->db->insert("auction",
            ["item_name","auction_type", "auction_rule","auction_description","start_price","highest_bid","min_bid","highest_bidder","organizator_id","instant_price","end_time","image","status","owner_id"],
            [$_POST["name"], $_POST["typ_aukcie"], $_POST["pravidla_aukcie"], $_POST["description"], $_POST["starting_price"],0,0,0,0,0, $limit->format("Y-m-d H:i:s"),$_POST['image_location'],'created',$_SESSION['user_id']]) === false) {
            echo "<script>alert('Error creating auction')</script>";
        }
        header('Location:../my_auctions');
    }

    function resize_image($pathToImg, $w, $h, $crop=FALSE) {
        $file =
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }


        return $dst;
    }

//    public function upload_image(){
//        $filename = $_FILES['file']['name'];
//        list($w, $h) = getimagesize($_FILES['file']['name']);
//        $location = PATH_IMAGE.$filename;
//        $imageFileType = strtolower(pathinfo($location,PATHINFO_EXTENSION));
//        $valid_extensions = array("jpg","jpeg","png");
//        $response = 0;
//        $newheight = 200;
//        $newwidth = 200;
//
//        /* Check file extension */
//        if(in_array(strtolower($imageFileType), $valid_extensions)) {
//
//            /* Resize image */
//            if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
//                $src = imagecreatefromjpeg($location);
//            } else if ($imageFileType == "png") {
//                $src = imagecreatefrompng($location);
//            } else {
//                $src = imagecreatefromgif($location);
//            }
//
//            $dst = imagecreatetruecolor($newwidth, $newheight);
//            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
//
//            /* Upload file */
//            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
//                $response = $location;
//
//            }
//        }
//        echo $response;
//    }
    public function upload_image(){
        $filename = $_FILES['file']['name'];
        $location = PATH_IMAGE.$filename;
        chmod(PATH_IMAGE,777);
        $imageFileType = strtolower(pathinfo($location,PATHINFO_EXTENSION));
        $valid_extensions = array("jpg","jpeg","png");
        $response = 0;

        /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                //chmod($location,755);
                $response = $location;
            }
        }
        echo $response;
    }
}
