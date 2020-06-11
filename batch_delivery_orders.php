<?php 
include "main_header.php"; 
include "user_session.php"; 

$SQL_QUERY = "SELECT * FROM `delivery_orders`";
$SQL_LINK = "WHERE";
$FILTER_BY = "NONE";
$FILTERVAL = "Filter Value";

if(isset($_REQUEST["generate_filter"])){
    print_r($_REQUEST);
    $FILTER_BY = $_REQUEST["filterby"];
    $FILTERVAL = $_REQUEST["filterval"];
}
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
                            <h3 class="title-5 m-b-35">Batch Delivery Orders <small>Status Update</small></h3>
                            <form action="batch_delivery_orders.php" method="post">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select value="" required class="js-select2" name="filterby">
                                                <option selected="selected">Filter By</option>
                                                <option value="status">status</option>
                                                <!--<option value="">Option 2</option>-->
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select required class="js-select2" name="filterval">
                                                <option value="" selected="selected"><?= $FILTERVAL ?></option>
                                                <?php 
                                                    $con = Dbcon();                                                 
                                                    $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='Delivery'");
                                                    while($stat = mysqli_fetch_array($str)){ 
                                                        $key = $stat["id"];
                                                        $value = $stat["status_value"];

                                                ?>
                                                        <option value="<?= $value ?>"><?= $value ?></option>
                                                <?php 
                                                    } 
                                                    mysqli_close($con);
                                                ?>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button type="submit" name="generate_filter" class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters
                                        </button>
                                    </div>
                                    <!--<div class="table-data__tool-right">
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>-->
                                </div>
                            </form>
                            <form action="main_action.php" method="post">
                            <input type="hidden" name="stat_id" id="stat_id" value="" class="form-control">
                            <input type="hidden" name="stat_val" id="stat_val" value="" class="form-control">
                            <input type="hidden" name="lat" value="<?= $my_lat ?>" class="form-control">
                            <input type="hidden" name="lon" value="<?= $my_lon ?>" class="form-control">
                            <input type="hidden" name="adr" value="<?= $my_adr ?>" class="form-control">
                            <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr style="border-top: 1px #c8c6a8 solid; border-right: 1px #c8c6a8 solid; border-left: 1px #c8c6a8 solid;">
                                            <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" onchange="toggleSelectAll(this);">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th>
                                            <th>Merchandise</th>
                                            <th>Cinema</th>
                                            <th>Shipped Via</th>
                                            <th>AWB No.</th>
                                            <th>Shipped On</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, $SQL_QUERY)or die(mysqli_error($con));
                                            while($cl = mysqli_fetch_array($cr)){
                                                $ref = $cl["id"];
                                                $dos = $stat["stat_val"];

                                                if(($FILTER_BY == "status" && $FILTERVAL == $dos) || $FILTERVAL == "Filter Value"){
                                                    $ru = $cl["shipped_by"];
                                                    $cid = $cl["destination"];
                                                    $mid = $cl["merch_id"];

                                                    $cv = $ref."_".$mid;

                                                    $mc = mysqli_query($con, "SELECT * FROM `merchandise_received` WHERE `id`=$mid");
                                                    $merch = mysqli_fetch_array($mc);

                                                    $uc = mysqli_query($con, "SELECT * FROM `cinema_info` WHERE `id`=$cid");
                                                    $dest = mysqli_fetch_array($uc);

                                                    $sr = mysqli_query($con, "SELECT * FROM `merch_do_status` WHERE `do_id`=$ref ORDER BY `added` DESC LIMIT 1");
                                                    $stat = mysqli_fetch_array($sr);
                                        ?>
                                        <tr class="tr-shadow">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input required name="dords[]" value="<?= $cv ?>" type="checkbox"> 
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="desc"><?= $merch["descript"] ?></td>
                                            <td><?= $dest["cinema"] ?></td>
                                            <td><?= $cl["courier"] ?></td>
                                            <td><?= $cl["awb_no"] ?></td>
                                            <td><?= $cl["shipped_on"] ?></td>
                                            <td><?= $stat["stat_val"] ?></td>
                                            
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
                                            }
                                            mysqli_close($con);
                                        ?>
                                        <tr class="tr-shadow">
                                            <td colspan="5">
                                                <select onchange="setStatusVal(this)" name="select" id="select" class="form-control">
                                                    <option value="">Please Select New Status</option>
                                                    <?php 
                                                        $con = Dbcon();                                                 
                                                        $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='Delivery'");
                                                        while($stat = mysqli_fetch_array($str)){ 
                                                            $key = $stat["id"];
                                                            $value = $stat["status_value"];

                                                    ?>
                                                            <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php 
                                                        } 
                                                        mysqli_close($con);
                                                    ?>
                                                    
                                                </select>
                                            </td>
                                            <td colspan="3">
                                                <button type="submit" name="batch_do_status" class="btn btn-primary btn-block">
                                                    <i class="fa fa-clone"></i> Submit
                                                </button>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            </form>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function setStatusVal(select_id){
                    var iv = select_id.options[select_id.selectedIndex].value;
                    var ii = select_id.options[select_id.selectedIndex].innerHTML;
                    //alert(iv+" == "+ii);

                    document.getElementById("stat_id").value = iv;
                    document.getElementById("stat_val").value = ii;
                }
                function toggleSelectAll(select){
                    isChecked = select.checked;
                    //alert(isChecked);
                    boxesEL = document.getElementsByName("dords[]");
                    //alert(boxesEL.length);
                    for(var x=0; x < boxesEL.length; x++){
                        boxesEL[x].checked = isChecked;
                    }
                }
            </script>

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
