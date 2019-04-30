<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['username'])) {
        header("Location: index.php");
        echo 'hi';
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Reset Password - Escort Personal Adz</title>

        <!-- Bootstrap core CSS -->
        <link href="css/main/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/index/carousel.css" rel="stylesheet">
        <link href="css/index/index-custom.css" rel="stylesheet">
        <!--<link href="css/main/font-awesome.min.css" rel="stylesheet">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/main/imagehover.css" rel="stylesheet">
        <link href="css/sign-in/sign-in-custom.css" rel="stylesheet">



    </head>
    <body>
        <div class="thetop"></div>        

        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark navigation-bar">
                <a class="navbar-brand" href="index.php">Escort</a>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">                                               
                    </ul>                    
                </div>



            </nav>
        </header>

        <?php
        if (isset($_GET['reset'])) {
            if (isset($_GET['reset']) == "success") {
                echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                <strong>Email Sent!</strong> A reset link has been sent to your email.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
            }
        }
        ?>

        <main role = "main">

            <div class = "container">
                <div class = "row">
                    <div class = "col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class = "card card-signin my-5">
                            <div class = "card-body">
                                <h5 class = "card-title text-center">Reset your password</h5>



                                <form class = "form-signin" action = "includes/reset-password-inc.php" method = "POST">
                                    <p class = "text-center">An e-mail will be sent to you with instructions on how to reset your password</p>
                                    <div class = "form-label-group">
                                        <input type = "email" id = "inputEmail" name = "inputEmail" class = "form-control" placeholder = "Email address" required autofocus>
                                        <label for = "inputEmail">Email address</label>
                                    </div>

                                    <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "submit">Send Reset Link</button>

                                    <hr class = "my-4">
                                    <p class = "text-center">Or, <a href = "sign-in.php" class = "card-link"><strong>Sign In</strong></a></p>

                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class = "style3">


            <?php
            include_once './includes/footer.php';
            ?>
        </main>

        <div class="scrolltop">
            <div class="scroll icon"><i class="fa fa-4x fa-angle-up"></i></div>
        </div>




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

        <!--Back to top-->
        <script type="text/javascript">
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('.scrolltop:hidden').stop(true, true).fadeIn();
                } else {
                    $('.scrolltop').stop(true, true).fadeOut();
                }
            });
            $(function () {
                $(".scroll").click(function () {
                    $("html,body").animate({scrollTop: $(".thetop").offset().top}, "1000");
                    return false
                });
            });

            $(function () {
                $(".see-more-ads").click(function () {
                    $("html,body").animate({scrollTop: $(".see-more-ads-here").offset().top}, "1000");
                    return false
                });
            });

            $(function () {
                $(".post-an-add").click(function () {
                    $("html,body").animate({scrollTop: $(".thetop").offset().top}, "1000");
                    return false
                });
            });
        </script>

    </body>
</html>
