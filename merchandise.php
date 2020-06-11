<?php 
include "main_header.php";
include "user_session.php"; 

if(isset($_REQUEST["item_reference"])){
    $item = $_REQUEST["item_reference"];

    $con = Dbcon(); 
    $mq = "SELECT * FROM `merchandise_received`  WHERE `id`='$item'";
    if($mr = mysqli_query($con, $mq)){
        $merch = mysqli_fetch_array($mr);
        $mt = $merch["merch_type"];
    }

    $tid = $merch["title_id"];
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
                                        <i class="zmdi zmdi-plus"></i>New Delivery Order</button>
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
                            <h5 class="modal-title" id="largeModalLabel">Disparch New Delivery</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="main_action.php" method="post" class="">
                            <div class="modal-body">
                                <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                <input type="hidden" name="client" value="<?= $tit['client_id'] ?>" class="form-control">
                                <input type="hidden" name="title" value="<?= $tid ?>" class="form-control">
                                <input type="hidden" name="merch" value="<?= $merch["id"] ?>" class="form-control">
                                <input type="hidden" name="merch_type" value="<?= $merch["merch_type"] ?>" class="form-control">

                                <div class="controls" style="display: none;">
                                    <fieldset class="input-group">
                                        <input type="file" id="upload" accept="image/*;capture=camera" />
                                        <button type="button" class="btn">Rerun</button>
                                    </fieldset>
                                    <fieldset class="reader-config-group">
                                        <label>
                                            <span>Barcode-Type</span>
                                            <select name="decoder_readers">
                                                <option value="code_128" selected="selected">Code 128</option>
                                                <option value="code_39">Code 39</option>
                                                <option value="code_39_vin">Code 39 VIN</option>
                                                <option value="ean">EAN</option>
                                                <option value="ean_extended">EAN-extended</option>
                                                <option value="ean_8">EAN-8</option>
                                                <option value="upc">UPC</option>
                                                <option value="upc_e">UPC-E</option>
                                                <option value="codabar">Codabar</option>
                                                <option value="i2of5">Interleaved 2 of 5</option>
                                                <option value="2of5">Standard 2 of 5</option>
                                                <option value="code_93">Code 93</option>
                                            </select>
                                        </label>
                                        <label>
                                            <span>Resolution (long side)</span>
                                            <select name="input-stream_size">
                                                <option value="320">320px</option>
                                                <option value="640">640px</option>
                                                <option selected="selected" value="800">800px</option>
                                                <option value="1280">1280px</option>
                                                <option value="1600">1600px</option>
                                                <option value="1920">1920px</option>
                                            </select>
                                        </label>
                                        <label>
                                            <span>Patch-Size</span>
                                            <select name="locator_patch-size">
                                                <option value="x-small">x-small</option>
                                                <option value="small">small</option>
                                                <option value="medium">medium</option>
                                                <option selected="selected" value="large">large</option>
                                                <option value="x-large">x-large</option>
                                            </select>
                                        </label>
                                        <label>
                                            <span>Half-Sample</span>
                                            <input type="checkbox" name="locator_half-sample" />
                                        </label>
                                        <label>
                                            <span>Single Channel</span>
                                            <input type="checkbox" name="input-stream_single-channel" />
                                        </label>
                                        <label>
                                            <span>Workers</span>
                                            <select name="numOfWorkers">
                                                <option value="0">0</option>
                                                <option selected="selected" value="1">1</option>
                                            </select>
                                        </label>
                                    </fieldset>
                                </div>
                                <div id="result_strip" style="display: none;">
                                    <ul class="thumbnails"></ul>
                                </div>
                                <div id="interactive" class="viewport" style="display: none;"></div>
                                <div id="debug" class="detection" style="display: none;"></div>
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Quantity.</label>
                                    <input type="number" min="1" max="20" id="nf-email" name="quantity" value="1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Cinema</label>
                                    <select name="destination" required class="form-control">
                                        <option value="">Please Select One</option>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $cinr = mysqli_query($con, "SELECT * FROM `cinema_info`");
                                            while($cin = mysqli_fetch_array($cinr)){
                                        ?>
                                                <option value="<?= $cin["id"] ?>"><?= $cin["cinema"] ?></option>
                                        <?php 
                                            } 
                                            mysqli_close($con);
                                        ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Ship Via</label>
                                    <select name="courier" required class="form-control">
                                        <option value="">Please Select One</option>
                                        <?php 
                                            $con = Dbcon();                                                 
                                            $cinr = mysqli_query($con, "SELECT * FROM `courier_services`");
                                            while($cin = mysqli_fetch_array($cinr)){
                                        ?>
                                                <option value="<?= $cin["name"] ?>"><?= $cin["name"] ?></option>
                                        <?php 
                                            } 
                                            mysqli_close($con);
                                        ?>
                                    </select> 
                                </div>
                                <?php if($mt == "Returnable"){ ?>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="nf-password" class=" form-control-label">Expected Return Date</label>
                                        <input type="date" id="retdate" name="retdate" placeholder="dd/mm/yyyy" class="form-control">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="nf-password" class=" form-control-label">Scan AWB Barcode</label>
                                        <div class="input-group">
                                            <input type="text" id="awbno" name="awbno" placeholder="AWB No." class="form-control">
                                            <div class="input-group-btn">
                                                <button id="upload_link" type="button" class="btn btn-primary"><i class="fa fa-barcode"></i></button>
                                            </div>
                                        </div>
                                        <span class="help" id="help"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="delivery_order" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- end modal large -->
            <?php 

                $con = Dbcon();                                                 
                $dr = mysqli_query($con, "SELECT * FROM `merchandise_docs` WHERE `req_for`='receive'");
                while($doc = mysqli_fetch_array($dr)){
                    $dref = $doc["id"];
                    $doc_tit = $doc["id"]."_".$doc["document_title"]."_".$merch["id"]."_".$tit["id"];
                    $ur = mysqli_query($con, "SELECT * FROM `merchandise_uploads` WHERE `document`=$dref AND `merch_id`=$item AND `status`='valid'");
                    $up_count = mysqli_num_rows($ur);
                    if($up_count > 0){
                        $upload = mysqli_fetch_array($ur);
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
                                <?php if($up_count > 0){ ?>
                                    <div class="modal-body">
                                        <img src="<?= $upload["document_src"] ?>" class="img-responsive" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                <?php }else{ ?>
                                    <form action="main_action.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                            <input type="hidden" name="docid" value="<?= $dref ?>" class="form-control">
                                            <input type="hidden" name="merchid" value="<?= $merch["id"] ?>" class="form-control">
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
                                            <button type="submit" name="upload_merch_document" class="btn btn-primary">Confirm</button>
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
            
            <div class="section__content section__content--p30" style="min-height: 75vh !important;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35"><?= $merch["descript"] ?> (<?= $merch["merch_type"] ?>)</h3>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <tbody>
                                        <tr class="tr-shadow">
                                            <td class="desc"><?= $merch["descript"] ?></td>
                                            <td>Received On: <?= $merch["received_on"] ?></td>
                                            <td>
                                                <span class="status--process">Status: <?= $merch["status"] ?></span>
                                            </td>
                                            <td>Total Quantity: <?= $merch["quantity"] ?></td>
                                            <?php if($mt == "Returnable"){ ?>
                                            <td>Type: <?= $merch["merch_type"] ?></td>
                                            <?php } ?>
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
                                        $dr = mysqli_query($con, "SELECT * FROM `merchandise_docs` WHERE `req_for`='receive'");
                                        while($doc = mysqli_fetch_array($dr)){
                                            $dref = $doc["id"];
                                            $ur = mysqli_query($con, "SELECT * FROM `merchandise_uploads` WHERE `document`=$dref  AND `merch_id`=$item AND `status`='valid'");
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

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">Delivery Orders</strong>
                              </div>
                              <div class="card-body p-0">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-hover table-striped table-align-middle mb-0">
                                      <thead>
                                        <th>Cinema</th>
                                        <th>Shipped Via</th>
                                        <th>AWB No.</th>
                                        <th>Shipped On</th>
                                        <th>Shipped By</th>
                                        <?php if($mt == "Returnable"){ ?>
                                        <th>Expected Return</th>
                                        <th>Return</th>
                                        <?php } ?>
                                        <th></th>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tid = $tit["id"];
                                            $mid = $merch["id"];

                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, "SELECT * FROM `delivery_orders` WHERE `merch_id`=$mid")or die(mysqli_error($con));
                                            while($cl = mysqli_fetch_array($cr)){
                                                $ref = $cl["id"];
                                                $ru = $cl["shipped_by"];
                                                $cid = $cl["destination"];

                                                $uc = mysqli_query($con, "SELECT * FROM `cinema_info` WHERE `id`=$cid");
                                                $dest = mysqli_fetch_array($uc);

                                                $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$ru");
                                                $recvr = mysqli_fetch_array($ur);

                                        ?>
                                        <tr>
                                            <td><?= $dest["cinema"] ?></td>
                                            <td><?= $cl["courier"] ?></td>
                                            <td><?= $cl["awb_no"] ?></td>
                                            <td><?= $cl["shipped_on"] ?></td>
                                            <td><?= $recvr["fullname"] ?></td>
                                            <?php if($mt == "Returnable"){ ?>
                                            <td><?= $cl["return_on"] ?></td>
                                            <td><?= $cl["return_date"] ?></td>
                                            <?php } ?>
                                            <td>
                                                <a href="delivery_order_details.php?item_reference=<?= $ref ?>" class="btn btn-primary pull-right"><i class="fa fa-info-circle"></i></a>
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
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- QUAGGA -->
    <script type="text/javascript">
        $(function(){
            $("#upload_link").on('click', function(e){
                e.preventDefault();
                $("#upload:hidden").trigger('click');
            });
        });
    </script>
    <script src="quagga/quagga.js" type="text/javascript"></script>
    <script src="quagga/file_input.js" type="text/javascript"></script>
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
