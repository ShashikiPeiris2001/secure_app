<?php
$to = "inviktacodersclub@gmail.com";
$from = "noreply@inviktacodersclub.tech";
$fromName = "invikta Coders";
$subject = "TEST";
$message = "This is a testing message";
$header = "From: ".$fromName. " <".$from.">";
if(mail($to, $subject, $message, $header)){
    echo "Successful";
}
?>
