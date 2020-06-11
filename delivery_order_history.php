<?php 
include "main_header.php"; 
include "user_session.php"; 

$SQL_QUERY = "SELECT * FROM `delivery_orders`";
$SQL_LINK = "WHERE";

if(isset($_REQUEST["cinema_reference"])){
    $cref = $_REQUEST["cinema_reference"];

    $SQL_QUERY = $SQL_QUERY." ".$SQL_LINK." `destination`='$cref'";
    $SQL_LINK = "AND";
}

if(isset($_REQUEST["merch_reference"])){
    $mref = $_REQUEST["merch_reference"];

    $SQL_QUERY = $SQL_QUERY." ".$SQL_LINK." `merch_id`='$mref'";

    if($SQL_LINK == "WHERE"){ $SQL_LINK = "AND"; }
}

if(isset($_REQUEST["client_reference"])){
    $clref = $_REQUEST["client_reference"];

    $SQL_QUERY = $SQL_QUERY." ".$SQL_LINK." `client_id`='$clref'";

    if($SQL_LINK == "WHERE"){ $SQL_LINK = "AND"; }
}

if(isset($_REQUEST["title_reference"])){
    $tref = $_REQUEST["merch_reference"];

    $SQL_QUERY = $SQL_QUERY." ".$SQL_LINK." `title_id`='$tref'";

    if($SQL_LINK == "WHERE"){ $SQL_LINK = "AND"; }
}

if($LOGGED_CLIENT["ctype"] == "customer"){
    $clref = $LOGGED_CLIENT["id"];

    $SQL_QUERY = $SQL_QUERY." ".$SQL_LINK." `client_id`='$clref'";
}
?>
<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php include "sidebar_menu.php"; ?>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <?php include "topbar.php"; ?>
            <?php include "sidebar_account.php"; ?>

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <div class="section__content section__content--p30" style="min-height: 75vh;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">Delivery Orders</h3>
                            
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr style="border-top: 1px #c8c6a8 solid; border-right: 1px #c8c6a8 solid; border-left: 1px #c8c6a8 solid;">
                                            <th>Merchandise</th>
                                            <th>Cinema</th>
                                            <th>Shipped Via</th>
                                            <th>AWB No.</th>
                                            <th>Shipped On</th>
                                            <th>Shipped By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, $SQL_QUERY)or die(mysqli_error($con));
                                            while($cl = mysqli_fetch_array($cr)){
                                                $ref = $cl["id"];
                                                $ru = $cl["shipped_by"];
                                                $cid = $cl["destination"];
                                                $mid = $cl["merch_id"];

                                                $mc = mysqli_query($con, "SELECT * FROM `merchandise_received` WHERE `id`=$mid");
                                                $merch = mysqli_fetch_array($mc);

                                                $uc = mysqli_query($con, "SELECT * FROM `cinema_info` WHERE `id`=$cid");
                                                $dest = mysqli_fetch_array($uc);

                                                $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$ru");
                                                $recvr = mysqli_fetch_array($ur);

                                        ?>
                                        <tr class="tr-shadow">
                                            <td class="desc"><?= $merch["descript"] ?></td>
                                            <td><?= $dest["cinema"] ?></td>
                                            <td><?= $cl["courier"] ?></td>
                                            <td><?= $cl["awb_no"] ?></td>
                                            <td><?= $cl["shipped_on"] ?></td>
                                            <td><?= $recvr["fullname"] ?></td>
                                            
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="delivery_order_details.php?item_reference=<?= $ref ?>" class="item" data-toggle="tooltip" data-placement="top" title="More Details">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        <?php 
                                            }
                                            mysqli_close($con);
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>


            <?php include "footer.php"; ?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
