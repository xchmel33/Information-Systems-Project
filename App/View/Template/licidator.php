<div id="licidator_page">
    <h2>APPROVE CREATED AUCTIONS:</h2>
    <?php
        foreach ($data['auctions'] as $auction){
            $auction_owner = $this->db->selectByColumnName('user','user_id',$auction['owner_id'],'username')[0]['username'];
            if ($auction['status'] != 'created') continue;
            echo '
            <div class="info">
                <img class ="pic" src="'.$auction['image'].'">
                <ul style="list-style-type: none">
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <h4>START PRICE:</h4>
                    <li>'.$auction["start_price"].' KČ</li>
                    <h4>OWNER:</h4>
                    <li>'.$auction_owner.'</li>
                    <h4>ENDS:
                    <li>'.$auction["end_time"].'</li>
                    <li id="timer'.$auction["auction_id"].'"></li>
                    <script type="text/javascript">getTimer(\''.$auction["end_time"].'\',document.getElementById("timer'.$auction["auction_id"].'"))</script>
                    <form method="post" action="licidator/approve">
                        <input hidden name="auction_id" value="'.$auction["auction_id"].'">
                        <input type="submit" value="APPROVE">
                    </form>
                </ul>
            </div>';
        }
    ?>
</div>
<div id="licidator_page">
    <h2>ORGANIZE AUCTIONS:</h2>
    <?php
    ?>
</div>

