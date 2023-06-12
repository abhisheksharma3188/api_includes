<?php
function hash_generator($string){
    $salt_string='SECRET_STRING_TO_CREATE_HASH';
    $hash_string=md5($string.$salt_string);
    return $hash_string;
}
