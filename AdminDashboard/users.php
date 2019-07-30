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

        <div class="container" style="margin-top: 1%;">
            <div class="row">
                <div class="col-6">
                    <form method="POST" action="includesadmin/filter-current-users-inc.php">
                        <div class="form-group row">
                            <label for="inputText" class="col-sm-2 col-form-label">Sort by</label>
                            <div class="col-sm-5">
                                <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="0" disabled="" selected="">-Select User Type-</option>
                                    <option value="all">All Current Users</option>
                                    <option value="no">Active Users</option>
                                    <option value="yes">Banned Users</option>                                
                                </select> 
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-6"></div>
            </div>
        </div>



        <?php
        
        if (isset($_GET['isUserBanned'])) { //check if set
            if ($_GET['isUserBanned'] == "yes") { //show only banned users
                showUsers($conn, "yes");
            } else if ($_GET['isUserBanned'] == "no") { //show only active users
                showUsers($conn, "no");
            }
        } else if (isset($_GET['allCurrentUsers'])) { //both ads
            showUsers($conn, "all");
        } else {
            showUsers($conn, "all");
        }

        function showUsers($conn, $status) {
            if ($status == "all") {
                $sql = "SELECT * FROM user WHERE usertype='normal';";
            }else{
                $sql = "SELECT * FROM user WHERE usertype='normal' AND isBanned='$status';";
            }
            
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
                                <th>Status</th>
                                <th>Option</th>                                    
                            </tr>
                        </thead>
                        <tbody>";

            if ($resultCheck < 1) {
//                echo 'no data';
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

                    if ($row['isBanned'] == "no") {
                        echo "<td style='color: #0ac426;font-weight:bold;'>";
                        echo "Active";
                        echo "</td>";
                    } else {
                        echo "<td style='color: #f54272;font-weight:bold;'>";
                        echo "Banned";
                        echo "</td>";
                    }

                    echo "<td>";
                    echo "<div class='dropdown'>
                                                
                        <i class='fa fa-cog dropdown-toggle' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>
                        
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                          <a class='dropdown-item' href='view-user.php?userid=" . $row['userid'] . "&isBanned=" . $row['isBanned'] . "'><i class='fa fa-eye'> View</i></a>                          
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
        }

//end of php function
        ?>

        <?php
        include './includesadmin/header-admin2.php';
        ?>



        <?php
        include './includesadmin/javascript-sheets.php';
        ?>
    </body>
</html>
