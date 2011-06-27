<?php

/**
 * For testing and development
 */
function pre($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Alias of function 'pre'
 */
function dump($obj){
    pre($obj);
}
function println($var){
    echo $var.'<br />';
}