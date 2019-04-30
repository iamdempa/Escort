
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Ad - Escort Admin Panel</title>


        <?php
        include './includesadmin/stylesheets.php';
        ?>


    </head>
    <body>

        <?php
        include './includesadmin/header-admin.php';
        ?>



        <?php
        if (isset($_GET['review']) == "yes" || isset($_GET['review'])) { //new ad, not reviewed yet, status = pending
            echo "<nav aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='new-ads.php'><i class='fa fa-chevron-left'> New Ads</i></a></li>
                <li class='breadcrumb-item active' aria-current='page'>Review Ads</li>
            </ol>
        </nav>";


            include './includesadmin/ad-inc.php';
        } else if (isset($_GET['view']) == "yes" || isset($_GET['view'])) { //reviewed ad status = success
            echo "<nav aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='ads.php'><i class='fa fa-chevron-left'> Approved Ads</i></a></li>
                <li class='breadcrumb-item active' aria-current='page'>Review Ads</li>
            </ol>
        </nav>";

            include './includesadmin/ad-inc2.php';
        } else if (isset($_GET['decline']) == "yes" || isset($_GET['decline'])) { //declined ads = declined
            echo "<nav aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='ads.php'><i class='fa fa-chevron-left'> Declined Ads</i></a></li>
                <li class='breadcrumb-item active' aria-current='page'>Review Ads</li>
            </ol>
        </nav>";
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
