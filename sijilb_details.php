<?php 
include "main_header.php";
include "user_session.php"; 

if(isset($_REQUEST["item_reference"])){
    $item = $_REQUEST["item_reference"];

    $con = Dbcon(); 
    $scq = "SELECT * FROM `sijila_cerfication_records`  WHERE `id`='$item'";
    if($scr = mysqli_query($con, $scq)){
        $sijil = mysqli_fetch_array($scr);
    }

    $tid = $sijil["title_id"];
    $tr = mysqli_query($con, "SELECT * FROM `movie_titles` WHERE `id`='$tid'");
    $tit = mysqli_fetch_array($tr);

    //print_r($tit);
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
                                            <li class="list-inline-item"><?= $tit["title"] ?></li>
                                        </ul>
                                    </div>
                                    <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#largeModal">
                                        <i class="zmdi zmdi-plus"></i>New Status
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- modal large -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Update New Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="main_action.php" method="post" class="">
                            <div class="modal-body">
                                <input type="hiddenx" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                <input type="hiddenx" name="stat_id" id="stat_id" value="" class="form-control">
                                <input type="hiddenx" name="stat_val" id="stat_val" value="" class="form-control">
                                <input type="hiddenx" name="lat" value="<?= $my_lat ?>" class="form-control">
                                <input type="hiddenx" name="lon" value="<?= $my_lon ?>" class="form-control">
                                <input type="hiddenx" name="adr" value="<?= $my_adr ?>" class="form-control">
                                <input type="hiddenx" name="sc_id" value="<?= $sijil["id"] ?>" class="form-control">
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">New Status</label>
                                    <select onchange="setStatusVal(this)" name="select" id="select" class="form-control">
                                        <option value="">Please Select New Status</option>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $str = mysqli_query($con, "SELECT * FROM `system_status` WHERE `status_for`='Sijil'");
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
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="update_sijil_status" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- end modal large -->
            
            <?php 

                $con = Dbcon();                                                 
                $dr = mysqli_query($con, "SELECT * FROM `merchandise_docs` WHERE `req_for`='sijil_b'");
                while($doc = mysqli_fetch_array($dr)){
                    $dref = $doc["id"];
                    $doc_tit = $doc["id"]."_".$doc["document_title"]."_".$sijil["id"]."_".$tit["id"];
                    $ur = mysqli_query($con, "SELECT * FROM `sijil_uploads` WHERE `document`=$dref AND `sc_id`=$item AND `sc_type`='Sijil B' AND `status`='valid'") or die(mysqli_error($con));
                    $up_count = mysqli_num_rows($ur);
                    if($up_count > 0){
                        $upload = mysqli_fetch_array($ur);
                        $doc_src = $upload["document_src"];
                    }
            ?>
                    <!-- modal medium -->
                    <div class="modal fade" id="mediumModal<?= $dref ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel"><?= $doc["document_title"] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php if($up_count > 0){
                                        if (strpos($doc_src, 'pdf') !== false) {
                                            $doc_src = "images/pdf.png";
                                        }
                                 ?>
                                    <div class="modal-body">
                                        <img src="<?= $doc_src ?>" class="img-responsive" alt="<?= $doc_src ?>" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                <?php }else{ ?>
                                    <form action="main_action.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                            <input type="hidden" name="docid" value="<?= $dref ?>" class="form-control">
                                            <input type="hiddenx" name="sc_id" value="<?= $sijil["id"] ?>" class="form-control">
                                            <input type="hiddenx" name="sc_type" value="Sijil B" class="form-control">
                                            <div class="form-group">
                                                <label for="nf-email" class=" form-control-label">Document Title</label>
                                                <input type="text" readonly id="nf-email" name="doctitle" value="<?= $doc_tit ?>" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="nf-password" class=" form-control-label">Upload Image / Take Picture</label>
                                                <input type="file" id="nf-password" name="file" accept="image/*;capture=camera" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="upload_sijilb_document" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end modal medium -->
            <?php 
                } 
                mysqli_close($con);
            ?>
            
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35"><?= $sijil["title"] ?></h3>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <tbody>
                                        <tr class="tr-shadow">
                                            <td class="desc"><?= $sijil["info"] ?></td>
                                            <td>Application No.: <?= $sijil["appno"] ?></td>
                                            <td>Applied On: <?= $sijil["applied_on"] ?></td>
                                            <td>Expecting Report On: <?= $sijil["expected_report"] ?></td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        <tr class="tr-shadow">
                                            <td>Status: <?= $sijil["status"] ?></td>
                                            <td>Decision: <?= $sijil["decision"] ?></td>
                                            <td>Classification: <?= $sijil["classification"] ?></td>
                                            <td>
                                                <span class="status--process">Action: <?= $sijil["action"] ?></span>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">Documents and Uploads</strong>
                              </div>
                              <div class="card-body p-0">
                                <table class="table table-hover table-striped table-align-middle mb-0">
                                  <!--<thead>
                                    <th width="80%">Document</th>
                                    <th></th>
                                  </thead>-->
                                  <tbody>
                                    <?php 
                                        $con = Dbcon();                                                 
                                        $dr = mysqli_query($con, "SELECT * FROM `merchandise_docs` WHERE `req_for`='sijil_b'");
                                        while($doc = mysqli_fetch_array($dr)){
                                            $dref = $doc["id"];
                                            $ur = mysqli_query($con, "SELECT * FROM `sijil_uploads` WHERE `document`=$dref  AND `sc_id`=$item AND `sc_type`='Sijil B' AND `status`='valid'");
                                            $up_count = mysqli_num_rows($ur);
                                            if($up_count > 0){
                                                $upload = mysqli_fetch_array($ur);
                                                $allow_act_class = "";
                                            }
                                    ?>
                                            <tr>
                                                <td width="80%"><?= $doc["document_title"] ?> [<?= $up_count ?>]</td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#mediumModal<?= $dref ?>" class="<?= $allow_act_class ?> btn btn-primary pull-right"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            
                                    <?php 
                                        } 
                                        mysqli_close($con);
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!--/.col-->        
                    </div>
                </div>
            </div>

            <!-- NOT ADDING FOOTER BECAUSE OF DOUBLE SCANNING -->
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        function setStatusVal(select_id){
            var iv = select_id.options[select_id.selectedIndex].value;
            var ii = select_id.options[select_id.selectedIndex].innerHTML;
            //alert(iv+" == "+ii);

            document.getElementById("stat_id").value = iv;
            document.getElementById("stat_val").value = ii;
        }
    </script>
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
