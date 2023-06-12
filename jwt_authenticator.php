<?php
    function jwt_authenticator(){
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
        
        ///////////////////////////////////////// code to authenticate jwt below /////////////////////////////////////////////////
        $secret='SECRET_STRING_USED_TO_GENERATE_JWT';
	
	    $header_json_string_base64url=explode('.',$jwt)[0];
	
	    $payload_json_string_base64url=explode('.',$jwt)[1];
	
	    $signature_received_base64url=explode('.',$jwt)[2];
	
	    $signature = hash_hmac('sha256', $header_json_string_base64url.'.'.$payload_json_string_base64url, $secret,true);
	    $signature_base64=base64_encode($signature);
	    $signature_base64url=str_replace('+','-',$signature_base64);
	    $signature_base64url=str_replace('/','_',$signature_base64url);
	    $signature_base64url=rtrim($signature_base64url, '=');
	
    	if($signature_base64url==$signature_received_base64url){
    	    return true;
    	}
    	else{
    	    return false;
    	}
    	///////////////////////////////////////// code to authenticate jwt above /////////////////////////////////////////////////
    }	
?>
