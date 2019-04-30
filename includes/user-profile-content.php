
<div class="container">
    <div class="row my-2">       


        <?php
        //check if use has a profile pic
        include_once './includes/dbConnection.php';



        $userIdd = $_SESSION['userid'];

        $sqlImg = "SELECT * FROM profileimage WHERE userid='$userIdd'";

        $resultImg = mysqli_query($conn, $sqlImg);

        while ($rowImg = mysqli_fetch_assoc($resultImg)) {
//                    echo 'ookkkkay';
            ?>
            <!--Upload profile picture-->

            <div class="col-lg-4 order-lg-1 text-center">

                <?php
                if ($rowImg['profileImageStatus'] == 0) { //already uploaded
                    $fileName = "uploads/profile" . $userIdd . "*";
                    $fileInfo = glob($fileName);

                    $fileExt = explode(".", $fileInfo[0]);
                    $fileActualExt = $fileExt[1];

                    echo "<label for='file'>
                                <img id='blah' src='uploads/profile" . $userIdd . "." . $fileActualExt . "?" . mt_rand() . "' style='cursor: pointer;width:150px;height:150px;'
                            class='mx-auto img-fluid img-circle d-block img-thumbnail rounded-circle' alt='avatar'>                            
                            </label>";
//                        echo 'image uploaded';
                } else { //not uploaded yetF
                    //show default image
//                            echo "<img src='uploads/profiledefault.jpg'>";
                    echo "<label for='file'>
                                <img id='blah' src='http://placehold.it/100' style='cursor: pointer;width:150px;height:150px;'
                            class='mx-auto img-fluid img-circle d-block img-thumbnail rounded-circle' alt='avatar'>
                            
                            </label>";
//                        echo 'not uploaded';
                }
                ?>                      
                <!--<h6 class="mt-2">Click on the photo to upload a different photo</h6>-->

                <p>Click on the photo to select a different photo</p>

                <form action="includes/upload-profile-pic-inc.php" method="POST" enctype="multipart/form-data">
                    <label class="custom-file">
                        <input style="display: none;" type="file" accept="image/*" onchange="readURL(this);" id="file" name="file" class=" btn btn-primary">
                        <button type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>
                    </label>
                </form>
            </div>

            <?php
        }
        ?>

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);

                }
            }
        </script>

        <?php

        function pagination($numOfResults, $resultPerPage) {
            $numberOfPages = ceil($numOfResults / $resultPerPage);
//            echo "Number of Results: " . $numOfResults . "</br>";
//            echo "Results  per page: " . $resultPerPage . "</br>";
            echo "<nav aria-label='Page navigation example text-center'>"
            . "<ul class='pagination'>";
            if ($numberOfPages != 1) {
                for ($page = 1; $page <= $numberOfPages; $page++) {
//                echo "<a href='user-profile.php?page=" . $page . "'>" . $page . "</a>";

                    echo "<li class='page-item'>
                      <li class='page-item'><a class='page-link' href='user-profile.php?page=" . $page . "'>" . $page . "</a></li>";
                }
                echo "</ul></nav>";
            }
        }

        //to show ads by the user
        function showAdImages($userIdd, $conn) {

            $resultPerPage = 5;

            $sql2 = "SELECT * FROM ad WHERE userid=?";

            $success = "pending";

            $stmt2 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt2, $sql2);
            mysqli_stmt_bind_param($stmt2, "i", $userIdd);
            mysqli_stmt_execute($stmt2);

            $result2 = mysqli_stmt_get_result($stmt2);
            $numOfResults2 = mysqli_num_rows($result2);


            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $thisPageFirstResult = ($page - 1) * $resultPerPage;

            $sql = "SELECT * FROM ad WHERE userid=?  LIMIT  " . $thisPageFirstResult . "," . $resultPerPage . ";";


            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'error';
            } else {
                $success = "pending";
                mysqli_stmt_bind_param($stmt, "i", $userIdd);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                $numOfResults = mysqli_num_rows($result);
//                echo "Number of results Main: " . $numOfResults . "</br>";

                echo "<div class='container table-responsive'>
                <table class='table table-striped text-center'>                    
                    <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $adId = $row['adid'];
                    $sql2 = "SELECT * FROM adimage WHERE adid='$adId' AND userid='$userIdd' LIMIT 1;";
//                    echo $adId;
                                        
                    $resultImage = mysqli_query($conn, $sql2);                    
                    while ($rowImage = mysqli_fetch_assoc($resultImage)) { //runs only one time
                        if ($rowImage['adimagestatus'] == 0) { //profile pic set
                            
                            $fileName = "uploads/ad/adImage-" . $rowImage['adimageid'] . "-" . $rowImage['adid'] . "-" . $rowImage['userid'] . "*";
                            $fileInfo = glob($fileName);

                            $fileExt = explode(".", $fileInfo[0]);
                            $fileActualExt = $fileExt[1];

                            echo "<td>";
                            echo "<img src='uploads/ad/adImage-" . $rowImage['adimageid'] . "-" . $rowImage['adid'] . "-" . $rowImage['userid'] . "." . $fileActualExt . "?" . mt_rand() . "' style='width:50px;height:50px;' class='rounded float-left'>";
                            echo"</td>";

                            echo "<td class='text-left'>";
                            echo "<a class='card-link' href='post-ad.php?editAdId=" . $rowImage['adid'] . "&userId=" . $userIdd . "'>";
                            echo $row['adtitle'];
                            echo "</a>";
                            echo"</td>";

                            echo "<td>";
                            echo "<a style='margin-right:5px;' class='btn btn-warning btn-sm' href='post-ad.php?editAdId=" . $rowImage['adid'] . "&userId=" . $userIdd . "' role='button'>Edit</a>";
                            echo "<a class='btn btn-danger btn-sm delete' href='#' id='" . $adId . "' onclick='showDeleteConfirm(this)' role='button'>Delete</a>";
                            echo"</td>";

                            echo "<td>";
                            if ($row['adstatus'] == "pending") {
                                echo 'pending';
                            } else {
                                echo 'Approved';
                            }
                            echo"</td>";

                            echo "</tr>";
                        } else { //profile pic not set
                            echo "<td>";
                            echo "<img src='http://placehold.it/500' style='width:50px;height:50px;' class='rounded float-left'>";
                            echo"</td>";

                            echo "<td class='text-left'>";
                            echo "<a class='card-link' href='post-ad.php?editAdId=" . $rowImage['adid'] . "&userId=" . $userIdd . "'>";
                            echo $row['adtitle'];
                            echo "</a>";
                            echo"</td>";

                            echo "<td>";
                            echo "<a style='margin-right:5px;' class='btn btn-warning btn-sm' href='post-ad.php?editAdId=" . $rowImage['adid'] . "&userId=" . $userIdd . "' role='button'>Edit</a>";
                            echo "<a class='btn btn-danger btn-sm delete' href='#' id='" . $adId . "' onclick='showDeleteConfirm(this)' role='button'>Delete</a>";
                            echo"</td>";

                            echo "<td>";
                            if ($row['adstatus'] == "pending") {
                                echo 'pending';
                            } else {
                                echo 'Approved';
                            }
                            echo"</td>";

                            echo "</tr>";
                        }
                    }
                }


                echo "</tbody>
                </table>";
                pagination($numOfResults2, $resultPerPage);
                echo "</div>";
            }
        }
        ?>


        <script type="text/javascript">
            function showDeleteConfirm(id) {
                $.confirm({
                    title: 'Delete Ad!',
                    content: 'Are you sure?',
                    theme: 'bootstrap', // 'material', 'bootstrap'
                    buttons: {
                        Delete: function () {
//                            $.alert('Deleted!');    

                            deleteAd(id);

                            window.location.reload(false);
                        },
                        cancel: function () {

                        }
                    }
                });
            }

            function deleteAd(id) {
                var adId = $(id).attr('id');

                $.ajax({
                    url: 'includes/remove-ad-inc.php',
                    dataType: 'text', // what to expect back from the PHP script, if anything                        
                    data: {
                        adId: adId,
                        userId: <?php echo $userIdd ?>
                    },
                    type: 'post',
                    success: function (php_script_response) {
                        //alert(php_script_response); // display response from the PHP script, if any
                    }
                });
            }

        </script>


        <?php
        if (isset($_SESSION['submitClicked'])) {
            unset($_SESSION['submitClicked']);
            if (isset($_SESSION['myAds'])) {
                echo "<div class='col-lg-8 order-lg-2'>
            <ul   class='nav nav-tabs'>

                <li class='nav-item'>
                    <a href='' data-target='#myAds' data-toggle='tab' class='nav-link active'><i class='fa fa-wpforms'></i> My Ads</a>
                </li>
                <li class='nav-item'>
                    <a href='' data-target='#edit' data-toggle='tab' class='nav-link '><i class='fa fa-pencil-square-o'></i> Edit Profile</a>
                </li>

                <li class='nav-item'>
                    <a href='' data-target='#messages' data-toggle='tab' class='nav-link'>Other</a>
                </li>

            </ul>
            <div class='tab-content py-4'>

                <div class='tab-pane active' id='myAds'>
                    <h5 class='mb-3'>Your Advertisements</h5>
                    <div class='row'>";

                showAdImages($userIdd, $conn);


                echo "</div>
                    <!--/row-->
                </div>";

                $sql = "SELECT * FROM user WHERE userid='$userIdd'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>First name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userFName'] . "' name='firstName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Last name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userLName'] . "' name='lastName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Email</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='email' value='" . $row['userEmail'] . "' name='email'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userCompany'] . "' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userWebsite'] . "' name='website'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Address</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userStreet'] . "' name='address' placeholder='Street'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-6'>
                                <input class='form-control' type='text' value='" . $row['userCity'] . "' name='city' placeholder='City'>
                            </div>
                            <div class='col-lg-3'>
                                <input class='form-control' type='text' value='" . $row['userState'] . "' name='state' placeholder='State'>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Username</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userUsername'] . "' name='username'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
                    }
                } else {
                    echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
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
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='website'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
                }


                echo "<div class='tab-pane' id='messages'>

                    <!--other things-->

                </div>

            </div>
        </div>";
            } else if (isset($_SESSION['edit']) || isset($_GET['invalid']) == "emailExists") {


                echo "<div class='col-lg-8 order-lg-2'>
            <ul   class='nav nav-tabs'>

                <li class='nav-item'>
                    <a href='' data-target='#myAds' data-toggle='tab' class='nav-link active'><i class='fa fa-wpforms'></i> My Ads</a>
                </li>
                <li class='nav-item'>
                    <a href='' data-target='#edit' data-toggle='tab' class='nav-link '><i class='fa fa-pencil-square-o'></i> Edit Profile</a>
                </li>

                <li class='nav-item'>
                    <a href='' data-target='#messages' data-toggle='tab' class='nav-link'>Other</a>
                </li>

            </ul>
            <div class='tab-content py-4'>

                <div class='tab-pane active' id='myAds'>
                    <h5 class='mb-3'>Your Advertisements</h5>
                    <div class='row'>";

                showAdImages($userIdd, $conn);


                echo "</div>
                    <!--/row-->
                </div>";

                $sql = "SELECT * FROM user WHERE userid='$userIdd'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>First name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userFName'] . "' name='firstName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Last name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userLName'] . "' name='lastName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Email</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='email' value='" . $row['userEmail'] . "' name='email'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userCompany'] . "' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userWebsite'] . "' name='website'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Address</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userStreet'] . "' name='address' placeholder='Street'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-6'>
                                <input class='form-control' type='text' value='" . $row['userCity'] . "' name='city' placeholder='City'>
                            </div>
                            <div class='col-lg-3'>
                                <input class='form-control' type='text' value='" . $row['userState'] . "' name='state' placeholder='State'>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Username</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userUsername'] . "' name='username'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
                    }
                } else {
                    echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
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
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='website'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
                }


                echo "<div class='tab-pane' id='messages'>

                    <!--other things-->

                </div>

            </div>
        </div>";
            }
        } else {

            echo "<div class='col-lg-8 order-lg-2'>
            <ul   class='nav nav-tabs'>

                <li class='nav-item'>
                    <a href='' data-target='#myAds' data-toggle='tab' class='nav-link active'><i class='fa fa-wpforms'></i> My Ads</a>
                </li>
                <li class='nav-item'>
                    <a href='' data-target='#edit' data-toggle='tab' class='nav-link '><i class='fa fa-pencil-square-o'></i> Edit Profile</a>
                </li>

                <li class='nav-item'>
                    <a href='' data-target='#messages' data-toggle='tab' class='nav-link'>Other</a>
                </li>

            </ul>
            <div class='tab-content py-4'>

                <div class='tab-pane active' id='myAds'>
                    <h5 class='mb-3'>Your Advertisements</h5>
                    <div class='row'>";
            ?>

            <?php
            showAdImages($userIdd, $conn);
            ?>



            <?php
            echo "</div>
                    <!--/row-->
                </div>";

            $sql = "SELECT * FROM user WHERE userid='$userIdd'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>First name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userFName'] . "' name='firstName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Last name</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userLName'] . "' name='lastName'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Email</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='email' value='" . $row['userEmail'] . "' name='email'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userCompany'] . "' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userWebsite'] . "' name='website'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Address</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userStreet'] . "' name='address' placeholder='Street'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-6'>
                                <input class='form-control' type='text' value='" . $row['userCity'] . "' name='city' placeholder='City'>
                            </div>
                            <div class='col-lg-3'>
                                <input class='form-control' type='text' value='" . $row['userState'] . "' name='state' placeholder='State'>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Username</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' value='" . $row['userUsername'] . "' name='username'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
                }
            } else {
                echo "<div class='tab-pane ' id='edit'>
                    <h5 class='mb-3'>Update User Profile</h5>
                    <form role='form' action='includes/update-profile-inc.php' method='POST' enctype='multipart/form-data'>
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
                            <label class='col-lg-3 col-form-label form-control-label'>Company</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='company'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'>Website</label>
                            <div class='col-lg-9'>
                                <input class='form-control' type='text' name='website'>
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
                        <div class='form-group row'>
                            <label class='col-lg-3 col-form-label form-control-label'></label>
                            <div class='col-lg-9'>
                                <button type='reset' class='btn btn-warning' value='Cancel'><i class = 'fa fa-times-circle'></i> Reset</button>
                                <button type='submit' name='submit' class='btn btn-success' value='Save Changes'><i class = 'fa fa-save'></i> Update</button>
                                <button type='button' class='btn btn-danger' value='Delete Account'><i class = 'fa fa-trash'></i> Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>";
            }




            echo "<div class='tab-pane' id='messages'>

                    <!--other things-->

                </div>

            </div>
        </div>";
        }
        ?>
    </div>
</div>