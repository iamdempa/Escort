<?php

if (isset($_POST['submit'])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $iurlll = "https://escortpersonaladz123.000webhostapp.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $url2 = "http://localhost:8000/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 1800;

    include './dbConnection.php';

    $userEmail = $_POST["inputEmail"];

    //delete
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'error 1';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    //insert
    $sql = "INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'error 1';
        exit();
    } else {
        //hashing the token
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    require '../PHPMailer-master/PHPMailerAutoload.php';



    $to = $userEmail;
    $subject = 'Reset your password for Escort';
    $message = '<p>Password Reset link is below</p>';
    $message .= '<p>Here is your password reset link</br>';
    $message .= '<a href="' . $url2 . '">' . $url2 . '</a></p>';

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
    $mail->Password = "Escort@1995";
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
    }else{
        echo 'sent';
    }

    //header("Location: ../reset-password.php?reset=success");
} else {
    header("Location: ../sign-in.php");
}
