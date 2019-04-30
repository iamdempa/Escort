
<?php
include 'includesadmin/stylesheets.php';
?>

<?php
include 'includesadmin/dbConnection.php';
$sql = "SELECT * FROM ad WHERE adstatus = 'pending';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$count = 0;
if ($resultCheck < 1) {
//    echo 'No new Ads';
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $count++;
    }
}
?>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="../../index.php"><img src="images/logo.png" alt="Escort"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="./index-admin.php"> <i class="menu-icon fa">&#xf0e4;</i> Dashboard </a>
                </li>
                <h3 class="menu-title">Menu</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="./users.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>USERS</a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>ADVERTISEMENTS</a>
                    <ul class="sub-menu children dropdown-menu">

                        <li><i class="menu-icon fa fa-bell"></i><a href="./new-ads.php"><span class="badge badge-danger"><?php echo $count; ?></span> New Ads</a></li>

                        <li><i class="menu-icon fa fa-check"></i><a href="./ads.php">Posted Ads</a></li>
                        
                        <li><i class="menu-icon fa fa-trash"></i><a href="./declined-ads.php">Declined Ads</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>FORMS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                    </ul>
                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->


<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7"></div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="../index-admin.php"><i class="fa fa-user"></i> My Profile</a>

                        <a class="nav-link" href="includesadmin/admin-signout-inc.php"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->


    <?php
    include 'includesadmin/javascript-sheets.php';
    ?>