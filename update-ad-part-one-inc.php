<?php
echo 'hi';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit']) && empty($_SESSION['editAdId'])) {

    include_once './dbConnection.php';


    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['textarea']);



    //error checking
    if (empty($title)) {
//        echo 'title is empty';
        header("Location: ../post-ad.php?title=empty");
        exit();
    } else {
        if (empty($description)) {
            echo 'description is empty';
            header("Location: ../post-ad.php?description=empty");
            exit();
        } else {
            if (!isset($_REQUEST['radios'])) {
                echo 'No service selected';
                header("Location: ../post-ad.php?service=empty");
                exit();
            }
        }
    }



    $userId = $_SESSION['userid'];
    $serviceId = mysqli_real_escape_string($conn, $_POST['radios']);


    $sql = "INSERT INTO ad(userid,serviceid,adtitle,addescription,adcompletion,adstatus) VALUES ('$userId','$serviceId','$title','$description',0,'pending');";

    if (mysqli_query($conn, $sql)) {
        echo 'updated';

        $sql = "SELECT MAX(adid) FROM ad;";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $adId = $row[0];

                $_SESSION['adid'] = $adId;

                $ImageNoNames = array("blah1", "blah2", "blah3", "blah4");

                for ($index = 0; $index < 4; $index++) {
//                    $imageNo = $index + 1;
                    $imageName = $ImageNoNames[$index];
                    $sql = "INSERT INTO adimage(adid,adimageno,userid,adimagestatus) VALUES('$adId','$imageName','$userId',1);";
//                    mysqli_query($conn, $sql); //put is in an if-else for error checking
                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../post-ad-2.php");
                    } else {
                        echo 'Error! adimage table didnt upload';
                    }
                }
            }
        } else {
            echo 'naha';
        }
    } else {
        echo 'not';
        echo mysqli_error($conn);
    }
} else {
//    header("Location: ../user-profile.php");

    include_once './dbConnection.php';


    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['textarea']);

    $userId = $_SESSION['userid'];
    $serviceId = mysqli_real_escape_string($conn, $_POST['radios']);


    //error checking
    if (empty($title)) {
//        echo 'title is empty';
        echo 'hi';
        header("Location: ../post-ad.php?title=empty");
        exit();
    } else {
        if (empty($description)) {
            echo 'description is empty';
            header("Location: ../post-ad.php?description=empty");
            exit();
        } else {
            if (!isset($_REQUEST['radios'])) {
                echo 'No service selected';
                header("Location: ../post-ad.php?service=empty");
                exit();
            }
        }
    }

    $adID = $_SESSION['editAdId'];

    $sql = "UPDATE ad SET serviceid='$serviceId',adtitle='$title',addescription='$description' WHERE adid=? AND userid=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'update failed';
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $adID, $userId);
        mysqli_stmt_execute($stmt);

        header("Location: ../post-ad-2.php?updatePartOne=success");
    }
}

    