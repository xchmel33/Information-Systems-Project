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
        case 'approved': return 'green';
        case 'disapproved': return 'red';
        case 'finished': return 'yellow';
        case 'canceled': return 'orange';
    }
}
