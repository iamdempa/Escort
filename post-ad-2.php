<?php
include_once './includes/dbConnection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//echo "User id is: " . $_SESSION['userid'];

if (!isset($_SESSION['username']) && !isset($_SESSION['adid'])) {
    header("Location: index.php");
}
if (isset($_SESSION['admin'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = $_SESSION['userid'];
}

/*if (isset($_GET['updatePartOne']) == "yes" && isset($_GET['newAd'])) {  //if someone clicked post ad button on the user page to create a new ad
//    $adId = $_SESSION['editAdId'];
    
    $adId = $_SESSION['adid'];
    echo 'ONE - ' . $adId;
} else if (isset($_GET['updatePartOneByAdmin']) || !empty($_GET['updatePartOneByAdmin'])) { //if admin is going to update the ad
    $adId = $_SESSION['editAdId'];
    echo 'TWO - ' . $adId;
} else if (isset($_GET['updatePartOne']) == "success" && isset($_GET['byUser']) == "yes") { //if user clicked on ad edit button
//ID's

    $adId = $_SESSION['editAdId'];
    echo 'THREE- ' . $adId;
} else if(isset($_GET['updatePartOne']) == "success" && isset($_GET['emoerror'])) {
    //$adId = $_SESSION['adid'];
     $adId = $_SESSION['editAdId'];
    echo 'Four - ' . $adId;
}*/

    if (isset($_SESSION['editAdId']) && isset($_SESSION['adid'])) { //if both set, assign anyone of both
        $adId = $_SESSION['editAdId'];
    } else if(isset($_SESSION['adid'])) { //only if adid is set
        $adId = $_SESSION['adid'];
    }else if(isset($_SESSION['editAdId'])){ //only if editAdId is set
	$adId = $_SESSION['editAdId'];
    }else{
	echo "error";
    }
    echo "adId is: " . $adId;
?>




<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Post an Ad - Escort Personal Adz</title>                    

        <link href="css/user-profile/user-profile-custom.css" rel="stylesheet">
        <link href="css/ad/ad-custom.css" rel="stylesheet">
        <link href="css/ad/ad-service-custom.css" rel="stylesheet">
                        
     	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    </head>

    <body>
        <?php
        if (isset($_COOKIE['cookieEmail'])) {
            $cookieEmail = $_COOKIE['cookieEmail'];
            $cookieTel = $_COOKIE['cookieTel'];
            $cookieTelOffice = $_COOKIE['cookieTelOffice'];
            $cookieStreet = $_COOKIE['cookieStreet'];
            $cookieCity = $_COOKIE['cookieCity'];
            $cookieState = $_COOKIE['cookieState'];


            echo "<script>console.log( '" . $cookieEmail . "' );</script>";
            echo "<script>console.log( '" . $cookieTel . "' );</script>";
            echo "<script>console.log( '" . $cookieTelOffice . "' );</script>";
            echo "<script>console.log( '" . $cookieStreet . "' );</script>";
            echo "<script>console.log( '" . $cookieCity . "' );</script>";
            echo "<script>console.log( '" . $cookieState . "' );</script>";
        }
        ?>
        <?php
        include_once './includes/header.php';
        ?>        

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="user-profile.php">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post an Add</li>
            </ol>
        </nav>

        <!--error message-->
        <?php
        if (isset($_GET['emoerror'])) {
            echo "<div class='alert mekata alert-danger alert-dismissible fade show text-center' id='success-alert' role='alert' style='margin-top:0px'>
                <strong>Fill contact details!</strong> Fill at least one method of contact.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        }
        ?>              

        <script type="text/javascript">
            window.setTimeout(function () {
                // $(".mekata").fadeTo(2500, 0).slideUp(1000, function () {
                //     $(this).hide();
                // });
                $(".mekata").show();
            }, 1000);
        </script>


        <!-- Sign up form -->
        <div></div>

        <form id="form1" action="includes/update-ad-part-two-inc.php" method="POST" enctype="multipart/form-data">

            <div class="container">
                <div class="row">
                    <div class="col-md-2 card-body text-center ad-tips">                        
                        <i class="fa fa-lightbulb-o"></i> <strong>Tips</strong> <br><br>                     
                        <small id="textCount" class="form-text text-left"><i class="fa fa-phone"></i> Fill in <strong>all contact details</strong> so customers can easily reach you.</small>
                        <br>
                        <small id="textCount" class="form-text text-left"><i class="fa fa-photo"></i> Upload <strong>maximum 4 </strong>of the photos <strong>(less than 1MB each)</strong> of your service to enhance the reach to your ad.</small>
                    </div>

                    <div class="shadow-effect col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title text-center"><i class='fa fa-phone'></i> Your contact details</h2>
                                <?php
                                $sql = "SELECT * FROM ad WHERE adid='$adId'";
                                
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        
                                        if(!empty($row['adcontactemail'])){
                                            echo "<div class='form-group'>
                                    <label for='email' class='col-form-label'><i class='fa fa-envelope'></i> Email</label>
                                    <input type='email' name='email' class='form-control' value='" . $row['adcontactemail'] . "' id='email' placeholder='example@gmail.com' >
                                    <div class='email-feedback'></div>
                                </div>";
                                        }else{
                                            echo "<div class='form-group'>
                                    <label for='email' class='col-form-label'><i class='fa fa-envelope'></i> Email</label>
                                    <input type='email' name='email' class='form-control' id='email' placeholder='example@gmail.com' >
                                    <div class='email-feedback'></div>
                                </div>";
                                        }
                                        
                                        if (!empty($row['adcontactmobile'])) {
                                            echo "<div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-mobile-phone'></i> Mobile</label>
                                    <input type='text' name='mobile' value='" . $row['adcontactmobile'] . "' class='form-control' id='tel' placeholder='+94 6 99 99 99 99'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        } else {
                                            echo "<div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-mobile-phone'></i> Mobile</label>
                                    <input type='text' name='mobile' class='form-control' id='tel' placeholder='+94 6 99 99 99 99'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        }

                                        if (!empty($row['adcontactoffice'])) {
                                            echo "<div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-building'></i> Company</label>
                                    <input type='text' name='office' value='" . $row['adcontactoffice'] . "' class='form-control' id='teloffice' placeholder='+94 1 23 45 67 89'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        } else {

                                            echo "<div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-building'></i> Company</label>
                                    <input type='text' name='office' class='form-control' id='teloffice' placeholder='+94 1 23 45 67 89'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        }

                                        if (!empty($row['adstreet'])) {
                                            echo "<div class='form-group'>
                                    <label for='street' class='col-form-label'> Street</label>
                                    <input type='text' name='street' class='form-control' id='street' value='" . $row['adstreet'] . "'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        } else {

                                            echo "<div class='form-group'>
                                    <label for='street' class='col-form-label'> Street</label>
                                    <input type='text' name='street' class='form-control' id='street'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        }

                                        if (!empty($row['adcity'])) {
                                            echo "<div class='form-group'>
                                    <label for='city' class='col-form-label'> City</label>
                                    <input type='text' name='city' class='form-control' id='city' value='" . $row['adcity'] . "'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        } else {
                                            echo "<div class='form-group'>
                                    <label for='city' class='col-form-label'> City</label>
                                    <input type='text' name='city' class='form-control' id='city'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        }

                                        if (!empty($row['adstate'])) {
                                            echo "<div class='form-group'>
                                    <label for='state' class='col-form-label'> State</label>
                                    <input type='text' name='state' class='form-control' id='state' value='" . $row['adstate'] . "'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        } else {
                                            echo "<div class='form-group'>
                                    <label for='state' class='col-form-label'> State</label>
                                    <input type='text' name='state' class='form-control' id='state'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                        }
                                    }
                                } else {
                                    echo "<div class='form-group'>
                                    <label for='email' class='col-form-label'><i class='fa fa-envelope'></i> Email</label>
                                    <input type='email' name='email' class='form-control' id='email' placeholder='example@gmail.com' >
                                    <div class='email-feedback'></div>
                                </div>
                                <div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-mobile-phone'></i> Mobile</label>
                                    <input type='text' name='mobile' class='form-control' id='tel' placeholder='+94 6 99 99 99 99'>
                                    <div class='phone-feedback'></div>
                                </div>
                                <div class='form-group'>
                                    <label for='tel' class='col-form-label'><i class='fa fa-building'></i> Company</label>
                                    <input type='text' name='office' class='form-control' id='teloffice' placeholder='+94 1 23 45 67 89'>
                                    <div class='phone-feedback'></div>
                                </div>
                                <div class='form-group'>
                                    <label for='street' class='col-form-label'> Street</label>
                                    <input type='text' name='street' class='form-control' id='street' placeholder=''>
                                    <div class='phone-feedback'></div>
                                </div>
                                <div class='form-group'>
                                    <label for='city' class='col-form-label'> City</label>
                                    <input type='text' name='city' class='form-control' id='city' placeholder=''>
                                    <div class='phone-feedback'></div>
                                </div>
                                <div class='form-group'>
                                    <label for='state' class='col-form-label'> State</label>
                                    <input type='text' name='state' class='form-control' id='state' placeholder=''>
                                    <div class='phone-feedback'></div>
                                </div>";
                                }
                                ?>



                                <div class="form-group">
                                    <label for="country" class="col-form-label"><i class='fa fa-flag'></i> Country</label>
                                    <select id="country" name="country" class="form-control">
                                        <option value="1">Sri Lanka</option>
                                        <option value="2">India</option>
                                        <option value="3">Thailand</option>
                                        <option value="4">Taiwan</option>
                                        <option value="5">Indonesia</option>
                                        <option value="6">Philippines</option>
                                        <option value="7">Malaysia</option>
                                        <option value="8">Japan</option>
                                        <option value="9">Australia</option>
                                        <option value="10">Vietnam</option>
                                    </select>                                                                
                                </div>

                                <script type="text/javascript">

                                    function checkSelectOption(countryid) {

                                        if (!countryid) {

                                        } else {
                                            $("div.form-group select").val(countryid);
                                        }

                                    }
                                </script>

                                <?php
                                $sql = "SELECT * FROM ad WHERE adid='$adId' AND userid='$userId'";

                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<script type='text/javascript'>checkSelectOption({$row['countryid']});</script>";
                                    }
                                }
                                ?>



                            </div>
                        </div>
                    </div>

                    <div class="col-md-2"></div>
                </div>  

            </div>    
            <input type="submit" name="submit" id="submit-details-form" hidden=""> 
        </form>


        <form id="image_form" action="#" method="POST" enctype="multipart/form-data">

            <script type="text/javascript">
                function showImages(imgName, src) {
//                    alert(imgName);
                    var elem = $('#' + imgName);
                    if (elem.src !== "https://placehold.it/500") {
                        $("#" + imgName).attr("src", src);
                    } else {

                    }


                }
            </script>


            <!--ad images upload--> 
            <div class="form-group" >

                <div class="container text-center">
                    <label for="textarea" style="margin-bottom: 10px;"  class="col-form-label text-left"><i class='fa fa-photo'></i> Upload Images</label>
                    <div class="row">


                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                            <label for="file1">
                                <img id="blah1" src="https://placehold.it/500" alt="..." class="img-thumbnail">
                                <button type="button" value="Remove Photo" style="margin-top: 5px;" class="btn btn-danger btn-sm" id="image-remove-btn-1"><i class="fa fa-trash"></i> Remove Photo</button>
                                <small id="textCount" class="form-text text-center bold">This will be the Thumbnail</small>

                                <!--===============================-->
                                <div class="form-group">
                                    <div class="progress" id="progress1">
                                        <div class="progress-bar progress-bar-success myprogress" id="myprogress1" role="progressbar" style="width:0%">0%</div>
                                    </div>
                                    <div class="msg1"></div>
                                </div>
                                <!--=================================-->

                            </label>
                        </div>


                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                            <label for="file2">
                                <img id="blah2" src="https://placehold.it/500" alt="..." class="img-thumbnail">
                                <button type="button" value="Remove Photo" style="margin-top: 5px;" class="btn btn-danger btn-sm" id="image-remove-btn-2"><i class="fa fa-trash"></i> Remove Photo</button>
                                <small id="textCount" class="form-text text-center bold"></small>

                                <!--===============================-->
                                <div class="form-group">
                                    <div class="progress" id="progress2">
                                        <div class="progress-bar progress-bar-success myprogress" id="myprogress2" role="progressbar" style="width:0%">0%</div>
                                    </div>
                                    <div class="msg2"></div>
                                </div>
                                <!--=================================-->

                            </label>
                        </div>

                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                            <label for="file3">
                                <img id="blah3" src="https://placehold.it/500" alt="..." class="img-thumbnail">
                                <button type="button" value="Remove Photo" style="margin-top: 5px;" class="btn btn-danger btn-sm" id="image-remove-btn-3"><i class="fa fa-trash"></i> Remove Photo</button>
                                <small id="textCount" class="form-text text-center bold"></small>

                                <!--===============================-->
                                <div class="form-group">
                                    <div class="progress" id="progress3">
                                        <div class="progress-bar progress-bar-success myprogress" id="myprogress3" role="progressbar" style="width:0%">0%</div>
                                    </div>
                                    <div class="msg3"></div>
                                </div>
                                <!--=================================-->

                            </label>
                        </div>

                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                            <label for="file4">
                                <img id="blah4" src="https://placehold.it/500" alt="..." class="img-thumbnail">
                                <button type="button" value="Remove Photo" style="margin-top: 5px;" class="btn btn-danger btn-sm" id="image-remove-btn-4"><i class="fa fa-trash"></i> Remove Photo</button>
                                <small id="textCount" class="form-text text-center bold"></small>

                                <!--===============================-->
                                <div class="form-group">
                                    <div class="progress" id="progress4">
                                        <div class="progress-bar progress-bar-success myprogress" id="myprogress4" role="progressbar" style="width:0%">0%</div>
                                    </div>
                                    <div class="msg4"></div>
                                </div>
                                <!--=================================-->

                            </label>
                        </div>

                        <?php
                        $sqlImages = "SELECT * FROM adimage WHERE adid=? AND userid=?;";

                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sqlImages)) {
                            echo 'no images found';
                        } else {
                            mysqli_stmt_bind_param($stmt, "ii", $adId, $userId);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $present = 0;
                            $presentImageIds = array();
                            $presentImageNo = array();

                            $absent = 0;
                            $absentImageIds = array();
                            $absentImageNo = array();

                            $adImageIds = array();

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['adimagestatus'] == 0) { //gives images which are uploaded already
                                    $present++;
                                    $presentImageIds[] = $row['adimageid'];
                                    $presentImageNo[] = $row['adimageno'];
                                    $adImageIds[] = $row['adimageid'];
                                } else {
                                    $absent++;
                                    $absentImageIds[] = $row['adimageid'];
                                    $absentImageNo[] = $row['adimageno'];
                                }
                            }

                            $count = count($presentImageIds);

                            for ($index = 0; $index < 4; $index++) {
                                if (!empty($presentImageIds[$index])) {
                                    $imgName = $presentImageNo[$index];
                                    $adImageId = $adImageIds[$index];



                                    $fileName = "uploads/ad/adImage-" . $presentImageIds[$index] . "-" . $adId . "-" . $userId . "*";
                                    $fileInfo = glob($fileName);

                                    $fileExt = explode(".", $fileInfo[0]);
                                    $fileActualExt = $fileExt[1];

                                    $src = "uploads/ad/adImage-" . $adImageId . "-" . $adId . "-" . $userId . "." . $fileActualExt . "?" . mt_rand();
//                                    echo $src . "<br>";

                                    echo "<script type='text/javascript'>showImages('{$imgName}','{$src}');</script>";
                                } else {
//                                    echo 'empty';
                                }
                            }
                        }
                        ?>


                    </div>
                </div>




                <small id="textCount" class="form-text text-center">Upload only <strong>JPG/JPEG/PNG</strong> images less than <strong>1MB</strong></small>                                    
            </div>      



            <div class="image-uplod">
                <label class="custom-file image-uplod">
                    <input style="display: none;" onclick="this.value = null;" type="file" accept="image/*" onchange="readURL(this, 'blah1', 'file1', 'image-remove-btn-1', 'blah1', 'myprogress1', 'progress1', 'msg1');" id="file1" name="file1" class="btn btn-primary">
                    <!--<button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>-->
                </label>


                <label class="custom-file image-uplod">
                    <input style="display: none;" onclick="this.value = null;" type="file" accept="image/*" onchange="readURL(this, 'blah2', 'file2', 'image-remove-btn-2', 'blah2', 'myprogress2', 'progress2', 'msg2');" id="file2" name="file2" class="btn btn-primary">
                    <!--<button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class ='fa fa-save'></i> Save</button>-->
                </label>


                <label class="custom-file image-uplod">
                    <input style="display: none;" onclick="this.value = null;" type="file" accept="image/*" onchange="readURL(this, 'blah3', 'file3', 'image-remove-btn-3', 'blah3', 'myprogress3', 'progress3', 'msg3');" id="file3" name="file3" class="btn btn-primary">
                    <!--<button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa  fa-save'></i> Save</button>-->
                </label>                                      

                <label class="custom-file image-uplod">
                    <input style="display: none;" onclick="this.value = null;" type="file" accept="image/*" onchange="readURL(this, 'blah4', 'file4', 'image-remove-btn-4', 'blah4', 'myprogress4', 'progress4', 'msg4');" id="file4" name="file4" class="btn btn-primary">
                    <!--<button style="display: none;" type="submit" name="submitUpload" class="custom-f ile-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>-->
                </label>

            </div> 
        </form>



        <?php
        if (!empty($_GET['updatePartOne'])) { //if a user update the ad
            echo "<div class = 'container'>
                <div class = 'row'>
                <div class = 'col-md-4 col-sm-4 col-4'></div>
                <div class = 'col-md-4 col-sm-4 col-4'>
                <div style = 'margin-top: 1em;'>
                <button type = 'submit' form = 'form1' name = 'submit' class = 'btn btn-success btn-lg btn-block'><i class = 'fa fa-rocket'></i> Update and Publish</button>
                </div>
                </div>
                <div class = 'col-md-4 col-sm-4 col-4'></div>
                </div>
            </div>";
        } else { //if admin update the part one
            echo "<div class = 'container'>
                <div class = 'row'>
                <div class = 'col-md-4 col-sm-4 col-4'></div>
                <div class = 'col-md-4 col-sm-4 col-4'>
                <div style = 'margin-top: 1em;'>
                <button type = 'submit' form = 'form1' name = 'submit' class = 'btn btn-success btn-lg btn-block'><i class = 'fa fa-rocket'></i> Publish Ad</button>
                </div>
                </div>
                <div class = 'col-md-4 col-sm-4 col-4'></div>
                </div>
            </div>";
        }
        ?>


        <script type="text/javascript">
            $(document).ready(function () {
                
                var images = ["blah1", "blah2", "blah3", "blah4"];
                var buttons = ["image-remove-btn-1", "image-remove-btn-2", "image-remove-btn-3", "image-remove-btn-4"];
                var i;
                for (i = 0; i < images.length; i++) {
                    var elem = $('#' + images[i]);
                    var btnElem = $('#' + buttons[i]);
                    if (elem.attr('src') !== "https://placehold.it/500") {
                        btnElem.show();
//                        alert("show remove buttons");
                    } else {
//                        alert("show remove buttons");
                    }
                }
            });
        </script>
        
        <script>
            
            $(document).ready(function () {
                
                // alert();
            });
            
        </script>

        <script>
            function setCookies() {

                var cookieEmail = document.getElementById("email").value;
                var cookieTel = document.getElementById("tel").value;
                var cookieTelOffice = document.getElementById("teloffice").value;
                var cookieStreet = document.getElementById("street").value;
                var cookieCity = document.getElementById("city").value;
                var cookieState = document.getElementById("state").value;

//                document.cookie = "cookieEmail = " + cookieEmiail;
//                document.cookie = "cookieTel = " + cookieTel;
//                document.cookie = "cookieTelOffice = " + cookieTelOffice;
//                document.cookie = "cookieStreet = " + cookieStreet;
//                document.cookie = "cookieCity = " + cookieCity;
//                document.cookie = "cookieState = " + cookieState;

                localStorage.setItem("cookieEmail", cookieEmail);
                localStorage.setItem("cookieTel", cookieTel);
                localStorage.setItem("cookieTelOffice", cookieTelOffice);
                localStorage.setItem("cookieStreet", cookieStreet);
                localStorage.setItem("cookieCity", cookieCity);
                localStorage.setItem("cookieState", cookieState);


            }
        </script>
        <script>
            $(document).ready(function () {
                var cookieEmail= localStorage.getItem("cookieEmail");
                var cookieTel = localStorage.getItem("cookieTel");
                var cookieTelOffice = localStorage.getItem("cookieTelOffice");
                var cookieStreet = localStorage.getItem("cookieStreet");
                var cookieCity = localStorage.getItem("cookieCity");
                var cookieState = localStorage.getItem("cookieState");
                 
                 
                if (cookieEmail && cookieEmail.length > 0) {
                    document.getElementById('email').value = cookieEmail;
                }
                if (cookieTel && cookieTel.length > 0) {
                    document.getElementById('tel').value = cookieTel;
                }
                if(cookieTelOffice && cookieTelOffice.length > 0){                    
                    document.getElementById('teloffice').value = cookieTelOffice;
                }
                if(cookieStreet && cookieStreet.length > 0){
                    document.getElementById('street').value = cookieStreet;
                }
                if(cookieCity && cookieCity.length > 0){
                    document.getElementById('city').value = cookieCity;
                }
                if(cookieState && cookieState.length > 0){
                    document.getElementById('state').value = cookieState;
                }                              
            });

        </script>



        <script type="text/javascript">

            $('#image-remove-btn-1').hide();
            $('#image-remove-btn-2').hide();
            $('#image-remove-btn-3').hide();
            $('#image-remove-btn-4').hide();

            $("#image-remove-btn-1").click(function (event) {
                $("#image-remove-btn-1").html("<i class='fa fa-trash'></i> Photo deleting...");
                $('#blah1').attr('src', 'https://placehold.it/500');
                var userId =<?php echo $userId ?>;
                var adId =<?php echo $adId ?>;
                deletePhoto('blah1', userId, adId);
                setTimeout(function () {
                    $("#image-remove-btn-1").hide();
                    $('#blah1').prop('disabled', false);
                    $('#file1').prop('disabled', false);
                }, 2500);
            });

            $("#image-remove-btn-2").click(function () {
                $("#image-remove-btn-2").html("<i class='fa fa-trash'></i> Photo deleting...");

                $('#blah2').attr('src', 'https://placehold.it/500');
                var userId =<?php echo $userId ?>;
                var adId =<?php echo $adId ?>;
                deletePhoto('blah2', userId, adId);
                setTimeout(function () {
                    $("#image-remove-btn-2").hide();
                    $('#blah2').prop('disabled', false);
                    $('#file2').prop('disabled', false);
                }, 2500);
            });

            $("#image-remove-btn-3").click(function () {
                $("#image-remove-btn-3").html("<i class='fa fa-trash'></i> Photo deleting...");
                $('#blah3').attr('src', 'https://placehold.it/500');
                var userId =<?php echo $userId ?>;
                var adId =<?php echo $adId ?>;
                deletePhoto('blah3', userId, adId);
                setTimeout(function () {
                    $("#image-remove-btn-3").hide();
                    $('#blah3').prop('disabled', false);
                    $('#file3').prop('disabled', false);
                }, 2500);
            });

            $("#image-remove-btn-4").click(function () {
                $("#image-remove-btn-4").html("<i class='fa fa-trash'></i> Photo deleting...");

                $('#blah4').attr('src', 'https://placehold.it/500');
                var userId =<?php echo $userId ?>;
                var adId =<?php echo $adId ?>;
                deletePhoto('blah4', userId, adId);
                setTimeout(function () {
                    $("#image-remove-btn-4").hide();
                    $('#blah4').prop('disabled', false);
                    $('#file4').prop('disabled', false);
                }, 2500);
            });

            function deletePhoto(imgeName, userid, adId) {
                $(document).ready(function () {

                    //set cookies
                    setCookies();

                    $.ajax({
                        url: 'includes/remove-ad-image-inc-2.php',
                        dataType: 'text', // what to expect back from the PHP script, if anything                        
                        data: {
                            userId: userid,
                            adId: adId,
                            imgeName: imgeName
                        },
                        type: 'post',
//                        success: function (php_script_response) {
////                            alert(php_script_response);
//                            $('#'+buttonId).hide();                            
//                        }

                    });
                });
            }
        </script>



        <script type="text/javascript">

            $('.progress').hide();



            function readURL(element, id, fileid, buttonid, imgno, progressBarId, progressDivId, msgId) {

//                $(document).ready(function () {

//            });

                if (element.files && element.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#' + id).attr('src', e.target.result);

                        $('#' + id).prop('disabled', true);
                        $('#' + fileid).prop('disabled', true);

                        $('#' + buttonid).show();
                        $('#' + buttonid).html("<i class='fa fa-trash'></i> Remove Photo");
                        $('#' + progressDivId).show();
                        upload(fileid, imgno, progressBarId, msgId, buttonid);
                    };
                    reader.readAsDataURL(element.files[0]);
                }
            }


            function upload(fileid, imgno, progressBarId, msgId, buttonid) {

                //set the cookies
                setCookies();


                $('#' + progressBarId).css('width', '0');
                $('#' + msgId).text('');
                var data = new FormData();
                jQuery.each(jQuery('#' + fileid)[0].files, function (i, file) {
                    data.append('file' + i, file);
                    data.append('imgno', imgno);
                });

                $.ajax({
                    url: 'includes/upload-ad-image-inc-2.php',
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: 'post',
                    // this part is progress bar
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('#' + progressBarId).text(percentComplete + '%');
                                $('#' + progressBarId).css('width', percentComplete + '%');

                                var childId = $('#' + progressBarId).attr('id'); //myprogress1
                                var parentId = childId.substring(2, 11);
                                $("#" + buttonid).prop('value', 'Remove Photo');

                                setTimeout(function () {
                                    $('#' + parentId).css("display", "none");
                                }, 2000);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (php_script_response) {
//                        alert(php_script_response); // display response from the PHP script, if any
                        setCookies();

                        if (php_script_response === "" || php_script_response.length === 0) {

                            $('.' + msgId).text("Image Uploaded Successfully!");
                            setTimeout(function () {
                                $('.' + msgId).css("display", "none");
                            }, 1500);

                        } else {
                            if (php_script_response === "error result") {
                                //alert("Unknown Error Occured! Try again later...");
                                $('.' + msgId).text("Unknown Error Occured! Try again later...");
                                $('.' + msgId).css("color", "red");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else if (php_script_response === "error size") {
                                //alert("Image size Exceeded, Upload an Image of size less than 1MB...");
                                $('.' + msgId).text("Image size Exceeded, Upload an Image of size less than 1MB...");
                                $('.' + msgId).css("color", "red");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else if (php_script_response === "error file") {
                                //alert("File error! Try again later...");
                                $('.' + msgId).text("File error! Try again later...");
                                $('.' + msgId).css("color", "red");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else if (php_script_response === "error type") {
//                                alert("Invalid file type. Upload only JPG/JPEG/PNG file types...");
                                $('.' + msgId).text("Invalid file type. Upload only JPG/JPEG/PNG file types...");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else if (php_script_response === "error name") {
                                //alert("Invalid file name. Reanme before uplaoding...");
                                $('.' + msgId).text("Invalid file name. Rename before uplaoding...");
                                $('.' + msgId).css("color", "red");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else if (php_script_response === "nama thiyanawa") {
                                $('.' + msgId).text("Something...");
                                $('.' + msgId).css("color", "red");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else {
                                $('.' + msgId).text("Image Uploaded Successfully!");
//                                window.location.reload(false);
                                setTimeout(function () {
                                    $('.' + msgId).css("display", "none");
                                }, 1500);
                            }

                        }

                    }

                });
            }
        </script>



        <script type="text/javascript">

            function textCounter(field, field2, maxlimit)
            {
                if (field.value.length === 0) {
                    field.style.border = '2px solid #ced4da';
                } else {

                    var countfield = document.getElementById(field2);
                    if (field.value.length > maxlimit) {
                        field.value = field.value.substring(0, maxlimit);
                        field.style.border = '2px solid red';
                        countfield.innerHTML = "Character limit exceeded!";
                        return false;
                    } else {
                        if ((maxlimit - field.value.length) < 10) {
                            field.style.border = '2px solid orange';
                            countfield.innerHTML = maxlimit - field.value.length;
                        } else {
                            countfield.innerHTML = maxlimit - field.value.length;
                            field.style.border = '2px solid #80bdff';
                        }

                    }
                }


            }


        </script>


                                                                                                                       
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        
        <script>window.jQuery || document.write('<script src="js/main/jquery-slim.min.js"><\/script>')</script>
        
        <script src="js/main/popper.min.js"></script>
        <script src="js/main/bootstrap.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="js/main/holder.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

        


    </body>

</html>
