<?php include "main_header.php";
include "user_session.php"; 
$system_status = array();
if(isset($_REQUEST["item_reference"])){
    $item = $_REQUEST["item_reference"];

    $con = Dbcon(); 
    $doq = "SELECT * FROM `delivery_orders`  WHERE `id`='$item'";
    if($dor = mysqli_query($con, $doq)){
        $do = mysqli_fetch_array($dor);
    }

    $mid = $do["merch_id"];
    $mr = mysqli_query($con, "SELECT * FROM `merchandise_received` WHERE `id`='$mid'");
    $merch = mysqli_fetch_array($mr);

    $mt = $merch["merch_type"];

    $cid = $do["client_id"];
    $cr = mysqli_query($con, "SELECT * FROM `system_clients` WHERE `id`='$cid'");
    $cl = mysqli_fetch_array($cr);

    $tid = $do["title_id"];
    $tr = mysqli_query($con, "SELECT * FROM `movie_titles` WHERE `id`='$tid'");
    $title = mysqli_fetch_array($tr);

    $cinid = $do["destination"];
    $cinr = mysqli_query($con, "SELECT * FROM `cinema_info` WHERE `id`='$cinid'");
    $cinema = mysqli_fetch_array($cinr);

    $ru = $do["shipped_by"];
    $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$ru");
    $gen = mysqli_fetch_array($ur);
}
?>
<style type="text/css">
    nav > .nav.nav-tabs{

        border: none;
        color:#fff;
        background:#272e38;
        border-radius:0;

    }
    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
      border: none;
        padding: 18px 25px;
        color:#fff;
        background:#272e38;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link.active:after
     {
      content: "";
      position: relative;
      bottom: -60px;
      left: -10%;
      border: 15px solid transparent;
      border-top-color: #e74c3c ;
    }
    .tab-content{
      background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top:5px solid #e74c3c;
        border-bottom:5px solid #e74c3c;
        padding:30px 25px;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
      border: none;
        background: #e74c3c;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
    nav > .fa {  margin-bottom: 10px;margin-right: 10px;}

    small {
        display: block;
        line-height: 1.428571429;
        color: #999;
    }

    @media only screen and (max-width: 600px) {
      /* For tablets: */
      nav > div a.nav-item.nav-link{
        width: 100% !important;
      }
    }
</style>
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
                                    <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#ModalStatus">
                                        <i class="zmdi zmdi-plus"></i>New Status</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->
            
            <div class="section__content section__content--p30" style="min-height:75vh;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">Delivery <?= $do["awb_no"] ?> Via <?= $do["courier"] ?></h3>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <tbody>
                                        <tr class="tr-shadow">
                                            <td style="width:50%;" >Merchandise: <?= $merch["descript"] ?></td>
                                            <td>Shipped On: <?= $do["shipped_on"] ?></td>
                                            <td>
                                                <span class="status--process">Shipped By: <?= $gen["fullname"] ?></span>
                                            </td>
                                            <td>Total Quantity: <?= $do["quantity"] ?></td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        <tr class="tr-shadow">
                                            <td style="width:50%;">Shipping Address: <?= $cinema["address"] ?></td>
                                            <td >Cinema: <?= $cinema["cinema"] ?></td>
                                            <td>
                                                <span class="status--process">Shipped By: <?= $gen["fullname"] ?></span>
                                            </td>
                                            <td>Client: <?= $cl["cname"] ?></td>
                                        </tr>
                                        <?php if($mt == "Returnable"){ ?>
                                            <tr class="spacer"></tr>
                                            <tr class="tr-shadow">
                                                <td colspan="2">Expected Return Date: <?= $do["return_on"] ?></td>
                                                <td colspan="2">Actual Return Date: <?= $do["return_date"] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>

                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">
                                Status Timeline
                            </h3>
                        </div>
                        <div class="col-lg-12">
                          <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <?php 
                                    $doid = $do["id"];
                                    $con = Dbcon();                                                 
                                    $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='$mt'");
                                    $i = 0;
                                    while($stat = mysqli_fetch_array($str)){ 
                                        $sid = $stat["id"];
                                        
                                        $active = "";
                                        if($i == 0){  $active = "active"; }

                                        $dsr = mysqli_query($con, "SELECT * FROM `merch_do_status` WHERE `stat_id`=$sid AND `do_id`=$doid");
                                        $rec_sts = mysqli_fetch_array($dsr);
                                        $rec_cnt = mysqli_num_rows($dsr);

                                        $fa = "clock-o";
                                        if($rec_cnt > 0){   $fa = "check-square";   }
                                ?>
                                        <a class="nav-item nav-link <?= $active ?>" id="nav-<?= $sid ?>-tab" data-toggle="tab" href="#nav-<?= $sid ?>" role="tab" aria-controls="nav-<?= $sid ?>" aria-selected="true">
                                            <?= $stat["status_value"] ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-<?= $fa ?>"></i>
                                        </a>
                                <?php $i = $i + 1; } ?>
                              
                            </div>
                          </nav>
                          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <?php 
                                $con = Dbcon();                                                 
                                $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='$mt'");
                                $i = 0;
                                while($stat = mysqli_fetch_array($str)){ 
                                    $sid = $stat["id"];
                                    $active = "";
                                    if($i == 0){
                                        $active = "active";
                                    }

                                    $dsr = mysqli_query($con, "SELECT * FROM `merch_do_status` WHERE `stat_id`=$sid AND `do_id`=$doid");
                                    $rec_sts = mysqli_fetch_array($dsr);
                                    $rec_cnt = mysqli_num_rows($dsr);
                            ?>
                                    <div class="tab-pane fade show <?= $active ?>" id="nav-<?= $sid ?>" role="tabpanel" aria-labelledby="nav-<?= $sid ?>-tab">
                                      <div class="row ">
                                        <div class="col-lg-12 ">
                                            <?php 
                                            if($rec_cnt > 0){ 
                                                $uid = $rec_sts["updated_by"];
                                                $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$uid");
                                                $upby = mysqli_fetch_array($ur);
                                            ?>
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="well well-sm">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h4><?= $rec_sts["stat_val"] ?></h4>
                                                                        <small>
                                                                            <cite title="San Francisco, USA">
                                                                                Remark: <?= $rec_sts["remark"] ?>
                                                                            </cite>
                                                                        </small>
                                                                        <p class="m-t-10">
                                                                            <div class="d-flex bd-highlight">
                                                                                <div class="p-2 flex-fill bd-highlight">Updated By: <?= $upby["fullname"] ?></div>
                                                                                <div class="p-2 flex-fill bd-highlight">&nbsp;</div>
                                                                                <div class="p-2 flex-fill bd-highlight">Added On: <?= $rec_sts["added"] ?></div>
                                                                            </div>
                                                                            <div class="d-flex bd-highlight">
                                                                                <div class="p-2 flex-fill bd-highlight"><?= $rec_sts["loc"] ?></div>
                                                                            </div>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php 
                                            }else{ 
                                                array_push($system_status, array($sid => $stat["status_value"]));
                                            ?>
                                                    <div class="container-fluid m-t-20">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <button type="button" class="<?= $allow_act_class ?> btn btn-block btn-success" data-toggle="modal" data-target="#Modal<?= $sid ?>">
                                                                    Record New Status  - <?= $stat["status_value"] ?>
                                                                </button>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                            <?php $i = $i + 1; } ?>
                            
                          </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php 
                $con = Dbcon();                                                 
                $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='$mt'");
                while($stat = mysqli_fetch_array($str)){ 
                    $sid = $stat["id"];
            ?>
                    <!-- modal large -->
                    <div class="modal fade" id="Modal<?= $sid ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModalLabel">New Status - <?= $stat["status_value"] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="main_action.php">
                                    <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                    <input type="hidden" name="doid" value="<?= $do["id"] ?>" class="form-control">
                                    <input type="hidden" name="merch" value="<?= $mid ?>" class="form-control">
                                    <input type="hidden" name="stat_id" value="<?= $sid ?>" class="form-control">
                                    <input type="hidden" name="lat" value="<?= $my_lat ?>" class="form-control">
                                    <input type="hidden" name="lon" value="<?= $my_lon ?>" class="form-control">
                                    <input type="hidden" name="adr" value="<?= $my_adr ?>" class="form-control">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nf-email" class=" form-control-label">New Status</label>
                                            <input type="text" id="nf-stat" name="stat_val" readonly="" value="<?= $stat["status_value"] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Remark</label>
                                            <textarea name="remark"  placeholder="Add A Remark" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="new_od_status" value="new_od_status" class="btn btn-primary">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal large -->
            <?php } ?>

            <!-- modal large -->
            <div class="modal fade" id="ModalStatus" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">New Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="main_action.php">
                            <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                            <input type="hidden" name="doid" value="<?= $do["id"] ?>" class="form-control">
                            <input type="hidden" name="merch" value="<?= $mid ?>" class="form-control">
                            <input type="hidden" name="stat_id" id="stat_id" value="" class="form-control">
                            <input type="hidden" name="stat_val" id="stat_val" value="" class="form-control">
                            <input type="hidden" name="lat" value="<?= $my_lat ?>" class="form-control">
                            <input type="hidden" name="lon" value="<?= $my_lon ?>" class="form-control">
                            <input type="hidden" name="adr" value="<?= $my_adr ?>" class="form-control">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nf-client" class=" form-control-label">Select Client</label>
                                    <select name="client" onchange="setStatusVal(this)" id="select" required class="form-control">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach ($system_status as $ss) { 
                                                foreach ($ss as $key => $value) { 
                                        ?>
                                                    <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block">Please Select New Status</span>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Remark</label>
                                    <textarea name="remark"  placeholder="Add A Remark" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="new_od_status" value="new_od_status" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal large -->
            <script type="text/javascript">
                function setStatusVal(select_id){
                    var iv = select_id.options[select_id.selectedIndex].value;
                    var ii = select_id.options[select_id.selectedIndex].innerHTML;
                    //alert(iv+" == "+ii);

                    document.getElementById("stat_id").value = iv;
                    document.getElementById("stat_val").value = ii;
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
