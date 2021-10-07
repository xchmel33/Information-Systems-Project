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
