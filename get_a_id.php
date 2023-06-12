<?php
function get_a_id(){
        ////////////////////////////////////// code to fetch jwt below ///////////////////////////////////////////////////////
        $headers = apache_request_headers();
        $authorization_header=@$headers['Authorization'];
        
    
        if($authorization_header==''){
            $response_array=['response'=>'no-auth-header-1'];
            $response=json_encode($response_array);
            echo $response;
            die;
        }
        
        if($authorization_header=='Bearer'){
            $response_array=['response'=>'no-auth-header-2'];
            $response=json_encode($response_array);
            echo $response;
            die;
        }
        
        $authorization_header_exploded_array=explode(' ',$authorization_header);
        $jwt=$authorization_header_exploded_array[1];
        ////////////////////////////////////// code to fetch jwt above ///////////////////////////////////////////////////////
        
        ///////////////////////////////////////// code to get a_id from jwt below /////////////////////////////////////////////////
	    $payload_json_string_base64url=explode('.',$jwt)[1];
	    $payload_json_string_base64 = strtr($payload_json_string_base64url, '-_', '+/');
        $payload_json=base64_decode($payload_json_string_base64);
        $payload_php_object=json_decode($payload_json);
        $a_id=$payload_php_object->a_id;
	    return $a_id;
    	///////////////////////////////////////// code to get a_id from jwt above /////////////////////////////////////////////////
    }	
?>
