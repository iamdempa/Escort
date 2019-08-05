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
        <link rel="stylesheet" href="cssadmin/popup-modal.css">  

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

        <div class="container" style="margin-top: 10px;"> 
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong" style="border-radius: 50px;"><i class="fa fa-key"></i> Add admin</button>

                </div>
            </div>
        </div>
        <hr>   

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add a new Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>First name</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' name='firstName'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Last name</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' name='lastName'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Email</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='email' name='email'>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Address</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' name='address' placeholder='Street'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'></label>
                                <div class='col-lg-6'>
                                    <input class='form-control' type='text' name='city' placeholder='City'>
                                </div>
                                <div class='col-lg-3'>
                                    <input class='form-control' type='text' name='state' placeholder='State'>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Username</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='text' name='username'>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Password</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='password' name='password'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-lg-3 col-form-label form-control-label'>Confirm password</label>
                                <div class='col-lg-9'>
                                    <input class='form-control' type='password' name='confirmPassword'>
                                </div>
                            </div>
                            <div class='form-group row modal-footer'>
                                <label class='col-lg-3 col-form-label form-control-label'></label>
                                <div class='col-lg-9'>
                                    <button type='reset' id="reset" class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                    <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Save</button>
                                    <button type='button' class='btn btn-secondary' data-dismiss="modal" value='Cancel'><i class = 'fa fa-trash'></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#reset").click(function () {

                });
            });
        </script>

        <?php
        $sql = "SELECT * FROM user WHERE userType='admin';";
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
        ?>

        <?php
        include './includesadmin/header-admin2.php';
        ?>



        <?php
        include './includesadmin/javascript-sheets.php';
        ?>
    </body>
</html>
