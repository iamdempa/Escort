<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users - Escort Admin Panel</title>

        <?php
        include './includesadmin/stylesheets.php';
        include '../dbConnection.php';
        ?>
        
    </head>
    <body>
        <?php
        include './includesadmin/header-admin.php';
        ?>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="users.php"><i class="fa fa-chevron-left"> Users</i></a></li>
                <li class="breadcrumb-item active" aria-current="page">View Users</li>
            </ol>
        </nav>
        
        
        <?php 
            $sql = "SELECT * FROM user WHERE userid=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "error";
            }else{
                $userid = $_GET['userid'];                
                mysqli_stmt_bind_param($stmt, "i", $userid);
                mysqli_stmt_execute($stmt);
                
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                
            }
        ?>

        <?php
        include './includesadmin/header-admin2.php';
        ?>

        <?php
        include './includesadmin/javascript-sheets.php';
        ?>
    </body>
</html>
