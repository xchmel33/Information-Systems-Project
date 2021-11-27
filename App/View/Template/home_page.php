<div id="home">
    <section id="current-auctions">
            <h1>CURRENT AUCTIONS</h1>
        <script type="text/javascript">f()</script>
        <?php
        foreach ($data['auction_array'] as $auction){
            echo '
            <div class="info">
                <img class ="pic" src="img/1.jpg">
                <ul>
                    <li><h3>'.$auction["item_name"].'</h3></li>
                    <li>'.$auction["start_price"].' kc</li>
                    <li class="timer"><h4>ENDS: </h4></li>
                    <div class="timer"></div>
                    <form method="post" action="home/place_bid">
                        <input type="number" name="bit" step="0.01">
                        <button type="submit">SUBMIT BID</button>
                    </form>
                </ul>
            </div>';
        }
        ?>

    </section>
</div>
