<?php

function printArray($array){
    sort($array);
    echo '<prev>';
    print_r($array);
    echo '</prev>';
}
