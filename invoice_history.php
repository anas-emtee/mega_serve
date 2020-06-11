<?php 
include "main_header.php"; 
include "user_session.php"; 

$SQL_QUERY = "SELECT * FROM `service_invoice`";
$SQL_LINK = "WHERE";

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
                                            <th>Title</th>
                                            <th>Invoice No</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date Due</th>
                                            <th>Date Generated</th>
                                            <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, $SQL_QUERY)or die(mysqli_error($con));
                                            while($inv = mysqli_fetch_array($cr)){
                                                $ref = $inv["id"];
                                                
                                                $tid = $inv["title_id"];
                                                $tr = mysqli_query($con, "SELECT * FROM `movie_titles` WHERE `id`=$tid");
                                                $tit = mysqli_fetch_array($tr);

                                        ?>
                                        <tr class="tr-shadow">
                                            <td><?= $tit["title"] ?></td>
                                            <td><?= $inv["invoice_no"] ?></td>
                                            <td><?= $inv["amount"] ?></td>
                                            <td><?= $inv["status"] ?></td>
                                            <td><?= $inv["due_date"] ?></td>
                                            <td><?= $inv["added"] ?></td>
                                            
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="service_invoice.php?item_reference=<?= $ref ?>" class="item" data-toggle="tooltip" data-placement="top" title="More Details">
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
