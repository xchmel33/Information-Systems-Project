<div id="home">
    <section id="current-auctions">
            <h1>CURRENT AUCTIONS</h1>
        <?php

        foreach ($data['auction_array'] as $auction){
            if ($auction['status'] != 'started' && $auction['status'] != 'paused') continue;
            $owner = (isset($_SESSION['valid']) && $_SESSION['valid'] && $auction['owner_id'] == $_SESSION['user_id'])?"you":$this->db->selectByColumnName('user','user_id',$auction['owner_id'])[0]['username'];
            $organizator = (isset($_SESSION['valid']) && $_SESSION['valid'] && $auction['organizator_id'] == $_SESSION['user_id'])?"you":$this->db->selectByColumnName('user','user_id',$auction['organizator_id'])[0]['username'];
            $res = false;
            foreach ($data['auction_user'] as $au){
                if (isset($_SESSION['valid']) && $_SESSION['valid'] && $au['user_id'] == $_SESSION['user_id'] && $auction['auction_id'] == $au['auction_id']) {
                    $res = true;
                }
            }
            $formAction = (isset($_SESSION['valid']) && $_SESSION['valid']) ? "home/join":"login";
            $formSubmit = 'JOIN AUCTION';
            echo $res;
            if ($res || $owner == "you") {
                $formAction = "my_auctions";
                $formSubmit = "VIEW AUCTION";
            }
            if ($organizator == "you") {
                $formAction = "licidator";
                $formSubmit = "VIEW AUCTION";
            }
            $form = '<form method="post" action="'.$formAction.'">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <button type="submit">'.$formSubmit.'</button>
                    </form>';
            echo '
            <div class="info">
                <img class ="pic" alt="'.$auction['image'].'" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li><p>'.$auction["auction_description"].'</p></li>
                    <li><h4>START PRICE: '.$auction["start_price"].' KČ</h4></li>
                    <li><h4>HIGHEST BID: '.$auction["highest_bid"].' KČ</h4></li>
                    <li><h4>OWNER: '.$owner.' </h4></li>
                    <li><h4>STATUS: <span style="color: '.getColor($auction["status"]).'">'.$auction["status"].'</span></h4></li>
                    <li><h4>TIMELEFT: <span id="timer'.$auction["auction_id"].'"></span></h4></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    '.$form.'
                </ul>
            </div>';
        }
        ?>

    </section>
</div>
