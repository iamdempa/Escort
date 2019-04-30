<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && empty($editAdId) && empty($_GET['postNewAd'])) {
    header("Location: sign-in.php");
    exit();
} else {
    if (!isset($_SESSION['username'])) {
        header("Location: sign-in.php?PostAnAd=SignInRequired");
        exit();
    }
}
?>

<?php
if (isset($_GET['declined']) || !empty($_GET['declined']) || isset($_GET['declined']) == "yes") { //this will update adstatsus=declined with the submit
    $_SESSION['decline'] = "decline";
}
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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Post an Ad - Escort Personal Adz</title>

        <link href="css/user-profile/user-profile-custom.css" rel="stylesheet">
        <link href="css/ad/ad-custom.css" rel="stylesheet">
        <link href="css/ad/ad-service-custom.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="js/main/jquery.js"></script>


    </style>

</head>

<body>

    <?php
    include_once './includes/header.php';
    include_once './includes/dbConnection.php';

    if (!empty($_GET['postNewAd'])) {//if new ad
        unset($_SESSION['editAdId']);

        if (!empty($_GET['title'])) { //if title is empty
        }
//            echo 'new ad';
    } else { //if clicked on edit button
        if (isset($_SESSION['admin']) || !empty($_SESSION['admin'])) {
            $editAdId = $_GET['editAdId'];
            $userId = $_GET['userId'];
        } else {
            $editAdId = $_GET['editAdId'];
            $userId = $_GET['userId'];
        }
    }







//        echo $editAdId . "-" . $userId;


    if (!empty($editAdId) && !empty($userId) && empty($_GET['declined'])) { //if a user clicked edit button
        echo "<nav aria-label = 'breadcrumb'>
            <ol class = 'breadcrumb'>
            <li class = 'breadcrumb-item'><a href = 'user-profile.php'>Profile</a></li>
            <li class = 'breadcrumb-item active' aria-current = 'page'>Edit ad</li>
            </ol>
            </nav>";
    } else {
        if (isset($_GET['updateByAdmin']) || !empty($_GET['updateByAdmin'])) { //if admin clicked update button
            echo "<nav aria-label = 'breadcrumb'>
            <ol class = 'breadcrumb'> 
            <li class = 'breadcrumb-item'><a href = 'AdminDashboard/index-admin.php'>Profile</a></li>
            <li class = 'breadcrumb-item active' aria-current = 'page'>Post an Add</li>
            </ol>
            </nav>";
        } else { 
            echo "<nav aria-label = 'breadcrumb'>
            <ol class = 'breadcrumb'>
            <li class = 'breadcrumb-item'><a href = 'user-profile.php'>Profile</a></li>
            <li class = 'breadcrumb-item active' aria-current = 'page'>Post an Add</li>
            </ol>
            </nav>";
//            echo 'ok';
        }
    }
    ?>




    <form action="includes/update-ad-part-one-inc.php" method="POST"> <!--start of Form-->       

        <?php
        if (empty($editAdId) && !empty($_GET['postNewAd'])) { //creates a new ad/when edit button NOT clicked                                                               
            echo "<!-- Sign up card -->
                        <div class='card person-card'>
                            <div class='card-body'>
                                <!-- Sex image -->
                                <!--<img id='img_sex' class='person-img' src='https://visualpharm.com/assets/217/Life%20Cycle-595b40b75ba036ed117d9ef0.svg'>-->
                                <img id='img_sex' class='person-img' src='includes/Advertisement.png'>
                                <h2 id='who_message' class='card-title'>Post your Advertisement</h2>
                                <br>
                                <!-- First row (on medium screen) -->
                                <div class='row'>
                                    <div class='form-group col-md-3 text-right'></div>

                                    <div class='form-group col-md-6'>                                
                                        <input id='title' name='title' type='text' class='form-control' placeholder='Title of your Ad'>
                                        <div id='first_name_feedback' class='invalid-feedback'></div>
                                    </div>

                                    <div class='form-group col-md-3'></div>

                                </div>
                            </div>
                        </div>



                        <div class='container'>
                            <div class='row'>
                                <div class='shadow-effect col-md-12'>
                                    <div class='card'> 
                                        <div class='card-body'>
                                            <h2 class='card-title text-center'><i class='fa fa-briefcase'></i> Your service details</h2>                                                          
                                            <div class='form-group'>

                                                <!--service type radio buttons-->
                                                <label class='service-type-text'><i class='fa fa-list'></i> Select a service type</label>

                                                <div class='row text-center'>

                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio1' value='1' class='input-hidden' />
                                                        <label for='radio1'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>

                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio2' value='2' class='input-hidden' />
                                                        <label for='radio2'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>
                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio3' value='3' class='input-hidden' />
                                                        <label for='radio3'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>
                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio4' value='4' class='input-hidden' />
                                                        <label for='radio4'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>                                       

                                                </div>

                                                <div class='row text-center '>

                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input 
                                                            type='radio' name='radios' id='radio5' value='5' class='input-hidden' />
                                                        <label for='radio5'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>
                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio6' value='6' class='input-hidden' />
                                                        <label for='radio6'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>
                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios' id='radio7' value='7' class='input-hidden' />
                                                        <label for='radio7'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>
                                                    <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                        <input type='radio' name='radios'  id='radio8' value='8' class='input-hidden' />
                                                        <label for='radio8'>
                                                            <img src='http://placehold.it/70' alt='I'm radio' />
                                                        </label>
                                                    </div>                                        
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label for='textarea'  class='col-form-label'><i class='fa fa-pencil'></i> Description of your service</label>
                                                <textarea class='form-control' onkeyup='textCounter(this, 'textCount', 1000);' placeholder='We are providing...' id='textarea' name='textarea' rows='5'></textarea>
                                                <small id='textCount' class='form-text text-right'>1000</small>
                                            </div>

                                            <!--ad images upload--> 
                                            <div class='form-group' style='display: none'>
                                                <label for='textarea'  class='col-form-label'><i class='fa fa-photo'></i> Upload Images</label>
                                                <div class='container-fluid text-center'>
                                                    <div class='row'>
                                                        <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                            <label for='file1'>
                                                                <img id='blah1' src='http://placehold.it/100' alt='...' class='img-thumbnail'>
                                                            </label>
                                                        </div>
                                                        <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                            <label for='file2'>
                                                                <img id='blah2' src='http://placehold.it/100' alt='...' class='img-thumbnail'>
                                                            </label>
                                                        </div>
                                                        <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                            <label for='file3'>
                                                                <img id='blah3' src='http://placehold.it/100' alt='...' class='img-thumbnail'>
                                                            </label>
                                                        </div>
                                                        <div class='col-md-3 col-sm-6 col-6 ad-image'>
                                                            <label for='file4'>
                                                                <img id='blah4' src='http://placehold.it/100' alt='...' class='img-thumbnail'>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <small id='textCount' class='form-text text-right'>Upload images less than 1MB</small>                                    
                                            </div>

                                        </div>

                                    </div>                        
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                                <div class='col-md-4 col-sm-4 col-4'>
                                    <div style='margin-top: 1em;'>
                                        <button type='submit' name='submit' class='btn btn-primary btn-lg btn-block'>Next</button>
                                    </div>
                                </div>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                            </div>
                        </div>";
        } else {






            $_SESSION['editAdId'] = $_GET['editAdId'];
            $_SESSION['userId'] = $_GET['userId'];
            ?>



            <?php
            $sql = "SELECT * FROM ad WHERE adid=? AND userid=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "error";
            } else {

//                    echo 'Ad Id' . $editAdId;
//                    echo '-';
//                    echo 'Ad Id' . $editAdId;

                mysqli_stmt_bind_param($stmt, "ii", $editAdId, $userId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>


                    <!-- Sign up card -->
                    <div class="card person-card">
                        <div class="card-body">
                            <!-- Sex image -->
                            <!--<img id="img_sex" class="person-img" src="https://visualpharm.com/assets/217/Life%20Cycle-595b40b75ba036ed117d9ef0.svg">-->
                            <img id='img_sex' class='person-img' src='includes/Advertisement.png'>
                            <h2 id="who_message" class="card-title">Edit your Advertisement</h2>
                            <br>
                            <!-- First row (on medium screen) -->
                            <div class="row">
                                <div class="form-group col-md-3 text-right"></div>

                                <div class="form-group col-md-6">                                
                                    <input id="title" name="title" value="<?php echo $row['adtitle']; ?>" type="text" class="form-control" placeholder="Title of your Ad">
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
                                        <h2 class="card-title text-center"><i class='fa fa-briefcase'></i> Your service details</h2>                                                          
                                        <div class="form-group">

                                            <!--service type radio buttons-->
                                            <label class="service-type-text"><i class='fa fa-list'></i> Select a service type</label>

                                            <div class="row text-center">

                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio1" value="1" class="input-hidden" />
                                                    <label for="radio1">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>

                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio2" value="2" class="input-hidden" />
                                                    <label for="radio2">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio3" value="3" class="input-hidden" />
                                                    <label for="radio3">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio4" value="4" class="input-hidden" />
                                                    <label for="radio4">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>                                       

                                            </div>

                                            <div class="row text-center ">

                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input 
                                                        type="radio" name="radios" id="radio5" value="5" class="input-hidden" />
                                                    <label for="radio5">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio6" value="6" class="input-hidden" />
                                                    <label for="radio6">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios" id="radio7" value="7" class="input-hidden" />
                                                    <label for="radio7">
                                                        <img src="http://placehold.it/70" alt="I'm radio" />
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                    <input type="radio" name="radios"  id="radio8" value="8" class="input-hidden" />
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
                                            <label for="textarea"  class="col-form-label"><i class='fa fa-pencil'></i> Description of your service</label>
                                            <textarea class="form-control" onkeyup="textCounter(this, 'textCount', 1000);" placeholder="We are providing..." id="textarea" name="textarea" rows="5"><?php echo $row['addescription']; ?></textarea>
                                            <small id="textCount" class="form-text text-right">1000</small>
                                        </div>

                                        <!--ad images upload--> 
                                        <div class="form-group" style="display: none">
                                            <label for="textarea"  class="col-form-label"><i class='fa fa-photo'></i> Upload Images</label>
                                            <div class="container-fluid text-center">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                        <label for="file1">
                                                            <img id="blah1" src="http://placehold.it/100" alt="..." class="img-thumbnail">
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                        <label for="file2">
                                                            <img id="blah2" src="http://placehold.it/100" alt="..." class="img-thumbnail">
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                        <label for="file3">
                                                            <img id="blah3" src="http://placehold.it/100" alt="..." class="img-thumbnail">
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-6 ad-image">
                                                        <label for="file4">
                                                            <img id="blah4" src="http://placehold.it/100" alt="..." class="img-thumbnail">
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <small id="textCount" class="form-text text-right">Upload images less than 1MB</small>                                    
                                        </div>

                                    </div>

                                </div>                        
                            </div>

                        </div>


                        <?php
                        if (empty($editAdId) && empty($userId)) {
                            echo "<div class='row'>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                                <div class='col-md-4 col-sm-4 col-4'>
                                    <div style='margin-top: 1em;'>
                                        <button type='submit' name='submit' class='btn btn-primary btn-lg btn-block'>Next</button>
                                    </div>
                                </div>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                            </div>
                        </div>";
                        } else {
                            echo "<div class='row'>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                                <div class='col-md-4 col-sm-4 col-4'>
                                    <div style='margin-top: 1em;'>
                                        <button type='submit' name='submit' class='btn btn-warning btn-lg btn-block'>Save and Contiue</button>
                                    </div>
                                </div>
                                <div class='col-md-4 col-sm-4 col-4'></div>
                            </div>
                        </div>";
                        }
                        ?>

                        <?php
                    }
                }
            }
            ?>


        </div>
    </form> <!--End of Form-->




    <form class="image-uplod" action="includes/upload-profile-pic-inc.php" method="POST" enctype="multipart/form-data">
        <label class="custom-file">
            <input style="display: none;" type="file" accept="image/*" onchange="readURL(this, 'blah1');" id="file1" name="file1" class=" btn btn-primary">
            <button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>
        </label>
    </form>
    <form class="image-uplod" action="includes/upload-profile-pic-inc.php" method="POST" enctype="multipart/form-data">
        <label class="custom-file">
            <input style="display: none;" type="file" accept="image/*" onchange="readURL(this, 'blah2');" id="file2" name="file1" class=" btn btn-primary">
            <button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>
        </label>
    </form>
    <form class="image-uplod" action="includes/upload-profile-pic-inc.php" method="POST" enctype="multipart/form-data">
        <label class="custom-file">
            <input style="display: none;" type="file" accept="image/*" onchange="readURL(this, 'blah3');" id="file3" name="file1" class=" btn btn-primary">
            <button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>
        </label>
    </form>
    <form class="image-uplod" action="includes/upload-profile-pic-inc.php" method="POST" enctype="multipart/form-data">
        <label class="custom-file">
            <input style="display: none;" type="file" accept="image/*" onchange="readURL(this, 'blah4');" id="file4" name="file4" class=" btn btn-primary">
            <button style="display: none;" type="submit" name="submitUpload" class="custom-file-control btn btn-primary"><i class = 'fa fa-save'></i> Save</button>
        </label>
    </form>








    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>



    <script type="text/javascript">
        function readURL(element, id) {
            if (element.files && element.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + id).attr('src', e.target.result);
                    upload(id);
                };
                reader.readAsDataURL(element.files[0]);

            }


        }


        function upload(id) {
            $(document).ready(function () {
                $.ajax({
                    url: 'includes/upload-ad-image-inc.php',
                    type: 'POST',
                    dataType: "json",
                    success: function (data) {
                        alert(data);
                    },
                    data: {
                        file: id
                    }
                }).done(function (data) {
                    alert(JSON.stringify(data));
                });

            });
        }
    </script>

    <script type="text/javascript">

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
















    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/main/jquery-slim.min.js"><\/script>')</script>
    <script src="js/main/popper.min.js"></script>
    <script src="js/main/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/main/holder.min.js"></script>
    <script src="js/main/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

</body>

</html>
