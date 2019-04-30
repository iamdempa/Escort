<?php include './includesadmin/dbConnection.php'; ?>
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="cssadmin/style2.css">                  

        <?php include './includesadmin/stylesheets.php'; ?>
        
    </head>
    <body>
        <?php
        include './includesadmin/header-admin.php';
        ?>      

        <!--HTML Content Here-->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $sql = "SELECT * FROM user;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        echo "<div class='container-fluid'>
            <div class='row'>
                <div class='col-12 col-md-12 col-sm-12'>                                                                                  
                    <table class='table table-bordered text-center table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>                                                                       
                                <th>Email</th>
                                <th>Username</th>
                                <th>Option</th>                                    
                            </tr>
                        </thead>
                        <tbody>";

        if ($resultCheck < 1) {
            echo 'no data';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                echo $row['userid'];
                echo "</td>";

                echo "<td>";                
                echo $row['userFName'];                
                echo "</td>";

                echo "<td>";
                echo $row['userLName'];
                echo "</td>";

                echo "<td>";
                echo $row['userEmail'];
                echo "</td>";

                echo "<td>";
                echo $row['userUsername'];
                echo "</td>";


                echo "<td>";
                echo "<div class='dropdown'>
                                                
                        <i class='fa fa-cog dropdown-toggle' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>
                        
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                          <a class='dropdown-item' href='view-user.php?userid=".$row['userid']."'><i class='fa fa-eye'> View</i></a>
                          <a class='dropdown-item' href='#'><i class='fa fa-refresh'> Update</i></a>
                          <a class='dropdown-item' href='#'><i class='fa fa-remove'> Delete</i></a>
                        </div>
                      </div>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>

        <?php
        echo "</tbody>
        </table>                                    
        </div>
        </div>
        </div>";
        ?>

        <?php
        include './includesadmin/header-admin2.php';
        ?>



        <?php
        include './includesadmin/javascript-sheets.php';
        ?>
    </body>
</html>
