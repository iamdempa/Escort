<?php

if (isset($_POST['submit'])) {
    include_once './dbConnection.php';

    $name = mysqli_real_escape_string($conn, $_POST['userName']);
    $email = mysqli_real_escape_string($conn, $_POST['userEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['userPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['userConfirmPassword']);

    //error handlers
    //check for empty fields
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../sign-up.php?signup=empty");
        exit();
    } else {

        //checking if name is a valid name
        if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            header("Location: ../sign-up.php?invalidUsername=invalidUsername");
            exit();
        } else {
            //check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../sign-up.php?invalidEmail=invalidEmail");
                exit();
            } else {
                $sql = "SELECT * FROM login WHERE useremail='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    header("Location: ../sign-up.php?userexists=true");
                    exit();
                } else {
                    //hashing the password
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                    if ($password != $confirmPassword) {
                        header("Location: ../sign-up.php?password=doesn't match");
                        exit();
                    } else {
                        //insert data into login
                        $sqlInsert = "INSERT INTO login(username,useremail,userpassword) VALUES('$name','$email','$hashPassword');";
                        mysqli_query($conn, $sqlInsert);
                        //insert data into user
                        $sqlInsertUser = "INSERT INTO user(userEmail,userUsername,userPassword) VALUES('$email','$name','$hashPassword');";


                        mysqli_query($conn, $sqlInsertUser);
                            
                        //select from user table
                        $sqlSelectFromUser = "SELECT * FROM user WHERE userEmail='$email' AND userUsername='$name'";
                        $result = mysqli_query($conn, $sqlSelectFromUser);

                        if (mysqli_num_rows($result) > 0) {
                            echo 'ok';
                            while ($row = mysqli_fetch_assoc($result)) {
                                $userId = $row['userid'];

                                $sqlInsertProfileImg = "INSERT INTO profileimage(userid,profileImageStatus) VALUES('$userId',1);";
                                mysqli_query($conn, $sqlInsertProfileImg);
                                echo 'success';
                            }
                        } else {
                            header("Location: ../sign-in.php?error=error");
                            exit();
                        }

                        header("Location: ../sign-in.php?success=success");
                        exit();
                    }
                }
            }
        }
    }
} else {
    header("Location: ../sign-up.php");
    exit();
}
