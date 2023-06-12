<?php
function random_string_generator($length){
    $string='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $random_string='';
    for($i=1;$i<=$length;$i++){
        $random_number=rand(0,strlen($string)-1);
        $random_string=$random_string.substr($string,$random_number,1);
    }
    return $random_string;
}
?>
