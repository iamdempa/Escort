<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

include_once './dbConnection.php';
//ID's

if (isset($_SESSION['editAdId'])) {
    $adId = $_SESSION['editAdId'];
} else {
    $adId = $_SESSION['adid'];
}
if (isset($_SESSION['admin']) || !empty($_SESSION['admin'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = $_SESSION['userid'];
}


//echo $adId;


if (isset($_FILES['file0']) && isset($_POST['imgno'])) {
    echo 'hari - 1 |';
    $imageNO = $_POST['imgno'];

//    echo 'mokada une';




    $file = $_FILES['file0'];
    $fileName = $_FILES['file0']['name'];
    $fileTempName = $_FILES['file0']['tmp_name'];
    $fileSize = $_FILES['file0']['size'];
    $fileError = $_FILES['file0']['error'];
    $fileType = $_FILES['file0']['type'];



    $sqlGetImageId = "SELECT * FROM adimage WHERE adid='$adId' AND userid='$userId';"; //gives 4 results
//$imageNO = filter_input(INPUT_POST, "imgno");

    

    $resultImage = mysqli_query($conn, $sqlGetImageId);
    $i = 0;
    $num = mysqli_num_rows($resultImage);
    $flag = True;
    if (mysqli_num_rows($resultImage) > 0) {
        echo 'hari - 2 |';
        while (($row = mysqli_fetch_assoc($resultImage)) && $flag) { //runs 4 times
            $adImageId = $row['adimageid'];
            echo 'hari - 3 |';


            if (($row['adimagestatus'] == 1) && ($row['adimageno'] == $imageNO)) { //if image is not set
                echo 'hari- 4 |';

                uploadPhotos($conn, $fileName, $fileError, $fileSize, $fileTempName, $adImageId, $adId, $userId);
                $flag = false;
                exit();
            } else { //image is already set
                echo 'Image Uploaded already |';
            }

//        echo $adImageId;
        }
    } else {
        echo 'no images';
    }
} else {
    echo 'hahaha';
}
?>

<?php

function uploadPhotos($conn, $fileName, $fileError, $fileSize, $fileTempName, $adImageId, $adId, $userId) {


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError == 0) {
            if ($fileSize < 1000000) { //1Mb
//                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileNameNew = "adImage-" . $adImageId . "-" . $adId . "-" . $userId . "." . $fileActualExt;

                $fileDestination = "../uploads/ad/" . $fileNameNew;
                move_uploaded_file($fileTempName, $fileDestination);

                $sql = "UPDATE adimage SET adimagestatus=0 WHERE adimageid='$adImageId' AND adid='$adId' AND userid='$userId';";
                $result = mysqli_query($conn, $sql);
                if ($result) {

//                    echo 'result' . '<br>';
//                    header("Location: ../post-ad-2.php?uploadsuccess");                    
                } else {
                    echo 'error result';
//                    header("Location: ../post-ad-2.php?uploaderror");
//                    exit();
                }
            } else {
                echo 'error size';
//                header("Location: ../post-ad-2.php?uploadsizeexceeded");
//                exit();
            }
        } else {
            echo 'error file';
//            header("Location: ../post-ad-2.php?uploaderror");
//            exit();
        }
    } else {

        echo 'error type';

        if (empty($fileName)) {
            echo 'error name';
//            header("Location: ../post-ad-2.php?uploadselectanimage");
//            exit();
        } else {
            echo 'nama thiyanawa';
//            header("Location: ../post-ad-2.php?uploadinvalidfiletype");
//            exit();
        }
    }
}
