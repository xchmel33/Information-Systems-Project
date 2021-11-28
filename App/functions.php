<?php

/**
 * Extra php functions
 */

function printArray($array){
    sort($array);
    echo '<prev>';
    print_r($array);
    echo '</prev>';
}
function getColor($status){
    switch ($status){
        case 'created': return 'aqua';
        case 'started': return 'green';
        case 'paused': return 'orange';
        case 'disapproved': return 'red';
        case 'finished': return 'lime';
        case 'canceled': return 'yellow';
    }
}

function getUserStatus($status){
    switch ($status){
        case -1: return '<span style="color: red">You have been rejected to join this auction</span>';
        case 0: return '<span style="color: aqua">Please wait while licidator allows you to join this auction</span>';
        case 1: return '<span style="color: lime">Registered to this auction</span>';
    }
}

function getUserTable($auction_user,$auction){
    $count = 0;
    if ($_SESSION['user_role'] == 'licidator' || $_SESSION['user_role'] == 'admin') {
        $result = '<div class="user_join_wrapper">
                   <h4>USERS IN THIS AUCTION:</h4>
                   <form method="post" action="licidator" class="users_join">';
        foreach ($auction_user as $au_user) {
            $count++;
            if ($au_user['auction_id'] != $auction['auction_id']) continue;
            if ($au_user['user_approved'] == 0) {
                $result .= '<label>' . $au_user['username'] . '</label>
                                <input hidden name="auction_id" value="' . $auction["auction_id"] . '">
                                <input type="submit" name="confirm" value="confirm join">
                                <input type="submit" name="reject" value="reject join">';
            } else if ($au_user['user_approved'] == 1) {
                if ($au_user['user_bid'] != ''){
                    $result .= '<label>' . $au_user['username'] . '</label>
                                    <input hidden name="auction_id" value="' . $auction["auction_id"] . '">
                                    <label>'.$au_user['user_bid'].'</label>
                                    <input type="submit" name="confirm" value="confirm bid">
                                    <input type="submit" name="reject" value="reject bid">';
                }
                $result .= '<label>' . $au_user['username'] . ' - not active yet</label>
                            <input type="submit" name="kick" value="kick">';
            }
        }
        $result .= '</form></div>';
    } else{
        $result = '<div class="user_join_wrapper">
                   <h4>USERS IN THIS AUCTION:</h4>';
        foreach ($auction_user as $au_user) {
            $count++;
            if ($au_user['auction_id'] != $auction['auction_id']) continue;
            if ($au_user['user_approved'] == 0) {
                $result .= '<label>' . $au_user['username'] . ' wants to join</label>';
            } else if ($au_user['user_approved'] == 1) {
                if ($au_user['user_bid'] != ''){
                    $hBidder = ($au_user['username'] == $auction['highest_bidder'])? " - highest bidder":" - last bid";
                    $result .= '<label>' . $au_user['username'] . $hBidder . $au_user['user_bid'] . '</label>';
                }
                $result .= '<label>' . $au_user['username'] . ' - not active yet</label>';
            }
        }
        $result .= '</div>';
    }

    return ($count)?$result:"";
}