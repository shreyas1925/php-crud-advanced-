<?php

$to_email = "shreyasfreefire1925@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: shreyasshettigar34@gmail.com";

$bro=mail($to_email, $subject, $body, $headers);

if($bro){
    echo "ok";
}else{
     echo "no";
}

?>