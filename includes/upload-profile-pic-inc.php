<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$userId = $_SESSION['userid'];
include_once './dbConnection.php';

if (isset($_POST['submitUpload'])) {

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];



    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError == 0) {
            if ($fileSize < 1000000) { //1Mb
//                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileNameNew = "profile" . $userId . "." . $fileActualExt;

                $fileDestination = "../uploads/" . $fileNameNew;
                move_uploaded_file($fileTempName, $fileDestination);

                $sql = "UPDATE profileimage SET profileImageStatus=0 WHERE userid='$userId';";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '1';
                    header("Location: ../user-profile.php?uploadsuccess");
                    exit();
                } else {
                    echo '2';
                    header("Location: ../user-profile.php?uploaderror");
                    exit();
                }
            } else {
                echo '3';
                header("Location: ../user-profile.php?uploadsizeexceeded");
                exit();
            }
        } else {
            echo '4';
            header("Location: ../user-profile.php?uploaderror");
            exit();
        }
    } else {
        if (empty($fileName)) {
            echo '5';
            header("Location: ../user-profile.php?uploadselectanimage");
            exit();
        } else {
            echo '6';
            header("Location: ../user-profile.php?uploadinvalidfiletype");
            exit();
        }
    }
} else {
    header("Location: ../user-profile.php");
    exit();
}

