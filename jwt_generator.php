<?php

    function jwt_generator($a_id){
        
        ///////////////// define secret string below/////////////////
    	$secret='SECRET_STRING_TO_GENERATE_JWT';
    	///////////////// define secret string above/////////////////
    	
    	///////////////// define header string below/////////////////
    	$header='{
    				"alg": "HS256",
    				"typ": "JWT"
    			}';
    	///////////////// define header string above/////////////////
    	
    	///////////////// define header string below/////////////////
    	$payload='{
    				"a_id":"'.$a_id.'"
    			}';
    	///////////////// define payload string above/////////////////		
    	
    	///////////////// code to generate base64url header below ///
    	$header_json=json_decode($header);
    	$header_json_string=json_encode($header_json);
    	$header_json_string_base64=base64_encode($header_json_string);
    	$header_json_string_base64url=str_replace('+','-',$header_json_string_base64);
    	$header_json_string_base64url=str_replace('/','_',$header_json_string_base64url);
    	$header_json_string_base64url=rtrim($header_json_string_base64url, '=');
    	///////////////// code to generate base64url header above ///
    	
    	///////////////// code to generate base64url payload below ///
    	$payload_json=json_decode($payload);
    	$payload_json_string=json_encode($payload_json);
    	$payload_json_string_base64=base64_encode($payload_json_string);
    	$payload_json_string_base64url=str_replace('+','-',$payload_json_string_base64);
    	$payload_json_string_base64url=str_replace('/','_',$payload_json_string_base64url);
    	$payload_json_string_base64url=rtrim($payload_json_string_base64url, '=');
    	///////////////// code to generate base64url payload above ///
    	
    	///////////////// code to generate base64url signature below ///
    	$signature = hash_hmac('sha256', $header_json_string_base64url.'.'.$payload_json_string_base64url, $secret,true);
    	$signature_base64=base64_encode($signature);
    	$signature_base64url=str_replace('+','-',$signature_base64);
    	$signature_base64url=str_replace('/','_',$signature_base64url);
    	$signature_base64url=rtrim($signature_base64url, '=');
    	///////////////// code to generate base64url signature above ///
    	
    	///////////////// code to generate jwt below ///////////////////
    	$jwt=$header_json_string_base64url.'.'.$payload_json_string_base64url.'.'.$signature_base64url;
    	///////////////// code to generate jwt above ///////////////////
    	
    	return $jwt;
    }
?>
