<?php
$to_email = $_POST['email'];

$subject = "Sending email through PHP";
$body = "hi thanks to registering;";
$headers = "From: yourgmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

?>