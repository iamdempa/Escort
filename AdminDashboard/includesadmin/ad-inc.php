<?php
include 'includesadmin/dbConnection.php';
$userId = filter_input(INPUT_GET, 'userid');
$adId = filter_input(INPUT_GET, 'adid');
?>

<?php
$sqlPartOne = "SELECT * FROM ad WHERE adid=? AND userid=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sqlPartOne)) {
    
} else {
    mysqli_stmt_bind_param($stmt, "ii", $adId, $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        echo 'not found';
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <!-- Sign up card -->
            <div class="card person-card">
                <div class="card-body">                
                    <h2 id='who_message' class='card-title'>Review Advertisement</h2>
                    <!-- First row (on medium screen) -->
                    <div class="row">
                        <div class="form-group col-md-3 text-right"></div>

                        <div class="form-group col-md-6">                                
                            <input id="title" name="title" disabled value="<?php echo $row['adtitle']; ?>" type="text" class="form-control" placeholder="Title of your Ad">
                            <div id="first_name_feedback" class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-3"></div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="shadow-effect col-md-12">
                        <div class="card"> 
                            <div class="card-body">
                                <h2 class="card-title text-center"><i class='fa fa-briefcase'></i> Service details</h2>                                                          
                                <div class="form-group">

                                    <!--service type radio buttons-->
                                    <label class="service-type-text"><i class='fa fa-list'></i> Selected service type</label>

                                    <div class="row text-center">

                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio1" value="1" class="input-hidden" />
                                            <label for="radio1">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio2" value="2" class="input-hidden" />
                                            <label for="radio2">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio3" value="3" class="input-hidden" />
                                            <label for="radio3">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio4" value="4" class="input-hidden" />
                                            <label for="radio4">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>                                       

                                    </div>

                                    <div class="row text-center ">

                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input 
                                                type="radio" disabled name="radios" id="radio5" value="5" class="input-hidden" />
                                            <label for="radio5">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio6" value="6" class="input-hidden" />
                                            <label for="radio6">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios" id="radio7" value="7" class="input-hidden" />
                                            <label for="radio7">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6 ad-image">
                                            <input type="radio" disabled name="radios"  id="radio8" value="8" class="input-hidden" />
                                            <label for="radio8">
                                                <img src="http://placehold.it/70" alt="I'm radio" />
                                            </label>
                                        </div>                                        
                                    </div>
                                </div>


                                <script type="text/javascript">

                                    function checkRadio(serviceid) {
                                        //                                                            $('#radio' + serviceid).prop('checked', true);
                                        var radiobtn = document.getElementById("radio" + serviceid);
                                        radiobtn.checked = true;
                                    }
                                </script>

                                <?php echo "<script type='text/javascript'>checkRadio({$row['serviceid']});</script>"; ?>


                                <div class="form-group">
                                    <label for="textarea"  class="col-form-label"><i class='fa fa-pencil'></i> Description of the service</label>
                                    <textarea disabled class="form-control" onkeyup="textCounter(this, 'textCount', 1000);" placeholder="We are providing..." id="textarea" name="textarea" rows="5"><?php echo $row['addescription']; ?></textarea>
                                    <small id="textCount" class="form-text text-right">1000</small>
                                </div>

                            </div>

                        </div>                        
                    </div>

                </div>

                <?php
            }
        }
    }
    ?>




    <!--ADD PART TWO-->
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="shadow-effect col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center"><i class='fa fa-phone'></i> Your contact details</h2>
                        <?php
                        $sql = "SELECT * FROM user WHERE userid='$userId'";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='form-group'>
                                    <label for='email' class='col-form-label'><i class='fa fa-envelope'></i> Email</label>
                                    <input type='email' name='email' class='form-control' value='" . $row['userEmail'] . "' id='email' placeholder='example@gmail.com' >
                                    <div class='email-feedback'></div>
                                </div>";
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

                                if (!empty($row['userStreet'])) {
                                    echo "<div class='form-group'>
                                    <label for='street' class='col-form-label'> Street</label>
                                    <input type='text' name='street' class='form-control' id='street' value='" . $row['userStreet'] . "'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                } else {
                                    echo "<div class='form-group'>
                                    <label for='street' class='col-form-label'> Street</label>
                                    <input type='text' name='street' class='form-control' id='street'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                }

                                if (!empty($row['userCity'])) {
                                    echo "<div class='form-group'>
                                    <label for='city' class='col-form-label'> City</label>
                                    <input type='text' name='city' class='form-control' id='city' value='" . $row['userCity'] . "'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                } else {
                                    echo "<div class='form-group'>
                                    <label for='city' class='col-form-label'> City</label>
                                    <input type='text' name='city' class='form-control' id='city'>
                                    <div class='phone-feedback'></div>
                                </div>";
                                }

                                if (!empty($row['userState'])) {
                                    echo "<div class='form-group'>
                                    <label for='state' class='col-form-label'> State</label>
                                    <input type='text' name='state' class='form-control' id='state' value='" . $row['userState'] . "'>
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
    <!--END OF ADD PART TWO-->


    <script type="text/javascript">
        document.getElementById("email").disabled = true;
        document.getElementById("tel").disabled = true;
        document.getElementById("teloffice").disabled = true;
        document.getElementById("street").disabled = true;
        document.getElementById("city").disabled = true;
        document.getElementById("state").disabled = true;
        document.getElementById("country").disabled = true;
    </script>



    <!--SUBMIT BUTTON-->
    <div class="row">
        <div class="col-md-3 col-sm-3 col-3"></div>

        <div class="col-md-6 col-sm-6 col-6 text-center">            
            <div class="btn-group">
                <button type="button" class="btn btn-success" onclick="approveAd(this)" id="<?php echo $adId; ?>"><i class="fa fa-check"></i> Accept</button>

            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-bullhorn"></i> Inform User</button>

            </div>
            <div class="btn-group">
                <button type="button" id="<?php echo $adId; ?>" class="btn btn-danger" onclick="showDeleteConfirm(this)"><i class="fa fa-trash"></i> Delete</button>

            </div>
            
            <div class="btn-group">
                <button type="button" id="<?php echo $adId; ?>" class="btn btn-warning" onclick="declineConfirm(this)"><i class="fa fa-close"></i> Decline</button>

            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-3"></div>
    </div>
    <!--END OF SUBMIT BUTTON-->

    <br>

    <div class="row text-left">
        <div class="col-12">

            <span class="badge badge-pill badge-danger">Decline</span>   
            <small>- Advertisement will not be deleted but will be<strong>  declined</strong> until it is approved</small>
        </div>        
    </div>

    <div class="row text-left">
        <div class="col-12">

            <span class="badge badge-pill badge-success">Accept</span> 
            <small>- Advertisement will be <strong>published</strong></small>
        </div>        
    </div>

    <div class="row text-left">
        <div class="col-12">

            <span class="badge badge-pill badge-warning">Inform User</span>        
            <small>- Inform the user <strong>(via an Email)</strong> to adjust the advertisement so it is not against <strong>policy standards</strong></small>
        </div>        
    </div>
    
    <div class="row text-left">
        <div class="col-12">

            <span class="badge badge-pill badge-danger">Delete Ad</span>        
            <small>- Advertisement will be <strong>deleted permanently</strong></small>
        </div>        
    </div>

    <?php
    $sql = "SELECT * FROM user WHERE userid=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'error';
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            echo 'no data';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h3 class="modal-title" id="exampleModalLongTitle">Tell user about what should change</h3>                    
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="city" class="col-form-label"> Email</label>
                                    <input type="text" disabled name="city" class="form-control" id="city" value="<?php echo $row['userEmail']; ?>">
                                    <div class="phone-feedback"></div>
                                </div>

                                <div class="form-group">
                                    <label for="textarea"  class="col-form-label"><i class='fa fa-pencil'></i> Message...</label>
                                    <textarea class="form-control" value="Dear" id="textareacontent" name="textarea" rows="5">Dear <?php echo $row['userFName'] . " " . $row['userLName']; ?>,&#13;&#10;&#13;&#10;Your ad is under "pending" status because it doesn't meet the site's policies and requirements. Please read our privacy policies and re-edit your Ad.&#13;&#10;&#13;&#10;Thanks in Advance,&#13;&#10;Admin
                                    </textarea>                        
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" onclick="sendEmail(this)" class="btn btn-primary" id="<?php echo $row['userEmail']; ?>">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Modal -->                
                <?php
            }
        }
    }
    ?>

    <script type="text/javascript">
        function sendEmail(email) {
            var userEmail = $(email).attr('id');
            var message = $('#textareacontent').val();
            $.ajax({
                url: 'includesadmin/send-user-email.php',
                dataType: 'text', // what to expect back from the PHP script, if anything                        
                data: {
                    userEmail: userEmail,
                    msg: message
                },
                type: 'post',
                success: function (php_script_response) {
//                    alert(php_script_response); // display response from the PHP script, if any
                    location.reload();
                }
            });

        }

    </script>

    <script type="text/javascript">
        function approveAd(id) {
            $.confirm({
                title: 'Approve Ad!',
                content: 'Confirm approve ad?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    Approve: function () {
                        $.alert('Approved!');
                        approve(id);
                        setTimeout(function () {
                            window.location.href = "new-ads.php";
                        }, 2500);
                    },
                    cancel: function () {

                    }
                }
            });
        }

        function approve(id) {
            var adId = $(id).attr('id');

            $.ajax({
                url: 'includesadmin/approve-ad-inc.php',
                dataType: 'text', // what to expect back from the PHP script, if anything                        
                data: {
                    adId: adId,
                    userId: <?php echo $userId ?>
                },
                type: 'post',
                success: function (php_script_response) {
//                    alert(php_script_response); // display response from the PHP script, if any                                        
                }
            });
        }
    </script>

    <script type="text/javascript">
        function showDeleteConfirm(id) {
            $.confirm({
                title: 'Delete Ad!',
                content: 'Are you sure?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    Delete: function () {
                        $.alert('Deleted!');
                        deleteAd(id);
                    },
                    cancel: function () {

                    }
                }
            });
        }

        function deleteAd(id) {
            var adId = $(id).attr('id');

            $.ajax({
                url: 'includesadmin/remove-ad-inc.php',
                dataType: 'text', // what to expect back from the PHP script, if anything                        
                data: {
                    adId: adId,
                    userId: <?php echo $userId ?>
                },
                type: 'post',
                success: function (php_script_response) {
                    alert(php_script_response); // display response from the PHP script, if any
                }
            });
        }
    </script>
    
    
    <script type="text/javascript">
        function declineConfirm(id) {
            $.confirm({
                title: 'Decline Ad!',
                content: 'Confirm decline ad?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    Approve: function () {
                        $.alert('Declined!');
                        approve(id);
                        setTimeout(function () {
                            window.location.href = "new-ads.php";
                        }, 2500);
                    },
                    cancel: function () {

                    }
                }
            });
        }

        function approve(id) {
            var adId = $(id).attr('id');

            $.ajax({
                url: 'includesadmin/decline-ad-inc.php',
                dataType: 'text', // what to expect back from the PHP script, if anything                        
                data: {
                    adId: adId,
                    userId: <?php echo $userId ?>
                },
                type: 'post',
                success: function (php_script_response) {
                    alert(php_script_response); // display response from the PHP script, if any                                        
                }
            });
        }
    </script>

</div>






