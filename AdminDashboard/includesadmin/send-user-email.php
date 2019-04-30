<?php

$userEmail = filter_input(INPUT_POST, 'userEmail');
$msg = filter_input(INPUT_POST, 'msg');


require '../../PHPMailer-master/PHPMailerAutoload.php';



$to = $userEmail;
$subject = 'Review Your Ad';
$message = $msg;

$headers = "From: Escort <escort@gmail.com>\r\n";
$headers .= "Reply-To: escort@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

//    mail($to, $subject, $message, $headers);

$mail = new PHPMailer();
$mail->IsSmtp();
$mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //tls
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; //465; //or 587
$mail->IsHTML(true);
$mail->Username = "escortpersonaladz@gmail.com";
$mail->Password = "BANUKA123";
$mail->SetFrom("escortpersonaladz@gmail.com");
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AddAddress($to);

//    if (!$mail->Send() || !isset($to) || trim($to) == '' || !isset($subject) || trim($subject) == '' || !isset($message) || trim($message) == '') {
//        echo '<script language="javascript">';
//        echo 'alert("Mail not Sent!!!!")';
//        echo '</script>';
//    } else {
//        echo '<script language="javascript">';
//        echo 'alert("message successfully sent")';
//        echo '</script>';
//    }
if (!$mail->send()) {
    echo 'error';
} else {
    echo 'sent';
}
