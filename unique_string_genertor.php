<?php
include_once 'connection.php';
include_once 'random_string_generator.php';

function unique_string_generator($random_string_length){
    global $connection;
    $s_no='1';
    //////////////////////// Code to fetch random_string_prefix_number from unique_string_table below////////////////
    $query = 'SELECT
              *
              FROM
              unique_string_table
              WHERE
              s_no=?
              ';
    $mysqli_prepare = mysqli_prepare($connection, $query);  
    mysqli_stmt_bind_param($mysqli_prepare, 's',$s_no); 
    mysqli_stmt_execute($mysqli_prepare);
    $mysqli_stmt_get_result = mysqli_stmt_get_result($mysqli_prepare);
    $mysqli_fetch_assoc=mysqli_fetch_assoc($mysqli_stmt_get_result);
    $random_string_prefix_number=$mysqli_fetch_assoc['random_string_prefix_number']; 
    //////////////////////// Code to fetch random_string_prefix_number from unique_string_table above////////////////
    
    $random_string_prefix_number=$random_string_prefix_number+1;
    
    //////////////////////// Code to update random_string_prefix_number in unique_string_table below ///////////////////
    $query = 'UPDATE
              unique_string_table
              SET
              random_string_prefix_number = ?
              WHERE
              s_no=?
              ';
    $mysqli_prepare = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($mysqli_prepare, 'ss',$random_string_prefix_number,
                                                 $s_no);
    mysqli_stmt_execute($mysqli_prepare);
    //////////////////////// Code to update random_string_prefix_number in unique_string_table above ///////////////////
    
    //////////////////////// code to generate random string below //////////////////////////////////////////////////////
    $random_string=random_string_generator($random_string_length);
    //////////////////////// code to generate random string above //////////////////////////////////////////////////////
    
    //////////////////////// code to generate unique string below //////////////////////////////////////////////////////
    $unique_string=$random_string_prefix_number.$random_string;
    //////////////////////// code to generate unique string above //////////////////////////////////////////////////////
    
    return $unique_string;
}
?>
