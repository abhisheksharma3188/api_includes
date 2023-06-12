<?php
function send_otp_mail($email, $otp)
{
    $to = $email;
    $subject = "One Time Password";
    $text = "This is your OTP - <b><u>" .$otp."</u></b>. This OTP is valid for 10 minutes only.";
    $headers = "From: info@nsinterio.com". "\r\n".
               "MIME-Version: 1.0" . "\r\n".
               "Content-type:text/html;charset=UTF-8";
    if (mail($to, $subject, $text, $headers)) {
        $response_array=['response'=>'success','message'=>'Mail is sent.'];
        $response_json=json_encode($response_array);
        return $response_json;
    }else{
        $response_array=['response'=>'failure','message'=>'Mail is not sent.'];
        $response_json=json_encode($response_array);
        return $response_json;
    }
}
?>
