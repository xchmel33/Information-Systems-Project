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
    return;
}

function getUserTable($auction_user,$auction,$licidator = false,$owner = '',$organizator = ''){
    $count = 0;
    $result = '<div class="user_join_wrapper">
                   <h4>USERS IN THIS AUCTION:</h4>';
    $result .= '<label>\''.$owner.'\' - owner</label><br>';
    $result .= '<label>\''.$organizator.'\' - organizator</label><br>';
    if ($licidator) {
        foreach ($auction_user as $au_user) {
            $result .= '<form method="post" action="licidator/auction_user_table" class="users_join">';
            $count++;
            if ($au_user['auction_id'] != $auction['auction_id']) continue;
            if ($au_user['user_approved'] == 0) {
                $result .= '<label>' . $au_user['username'] . '</label>
                                <input hidden name="auction_id" value="' . $auction["auction_id"] . '">
                                <input hidden name="user_id" value="' . $au_user["user_id"] . '">
                                <input type="submit" name="confirm'.'" value="confirm join">
                                <input type="submit" name="reject'.'" value="reject join"><br>';
            } else if ($au_user['user_approved'] == 1) {
                if ($au_user['user_bid'] != ''){
                    $hBidder = ($au_user['username'] == $auction['highest_bidder'])?'- highest bidder':'<input type="submit" name="confirm_bid" value="confirm bid">';
                    if ($au_user['user_bid'] == $auction['instant_price']) {
                        $hBidder = "<input type='submit' name='instant_request' value='CONFIRM INSTANT'>";
                    }
                    $result .= '<label>' . $au_user['username'] . '</label>
                                    <input hidden name="auction_id" value="' . $auction["auction_id"] . '">
                                    <input hidden name="user_id" value="' . $au_user["user_id"] . '">
                                    <input hidden name="user_bid" value="' .$au_user["user_bid"] . '">
                                    <input hidden name="username" value="' .$au_user["username"] . '">
                                    <label>'.$au_user['user_bid'].'</label>'
                                    .$hBidder;
                }
                else {
                    $result .= '<label>' . $au_user['username'] . ' - not active yet</label>
                            <input type="submit" name="kick" value="kick">
                            <input type="text" hidden name="kick_id" value="' . $au_user['user_id'] . '">';
                }
            }
            $result .= '</form>';
        }
        $result .= '</div>';
    } else{
        foreach ($auction_user as $au_user) {
            $count++;
            if ($au_user['auction_id'] != $auction['auction_id']) continue;
            if ($au_user['user_approved'] == 0) {
                $result .= '<label>' . $au_user['username'] . ' wants to join</label><br>';
            } else if ($au_user['user_approved'] == 1) {
                if ($au_user['user_bid'] != ''){
                    $hBidder = ($au_user['username'] == $auction['highest_bidder'])? " - highest bidder ":" - bids ";
                    $result .= '<label>' . $au_user['username'] . $hBidder . $au_user['user_bid'] . '</label><br>';
                }
                $result .= '<label>' . $au_user['username'] . ' - joined, not active</label><br>';
            }
        }
        $result .= '</div>';
    }

    return ($count)?$result:"";
}