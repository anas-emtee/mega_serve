<?php 
include "main_header.php";
include "user_session.php"; 

if(isset($_REQUEST["item_reference"])){
    $item = $_REQUEST["item_reference"];

    $con = Dbcon(); 
    $mq = "SELECT * FROM `movie_titles`  WHERE `id`='$item'";
    if($mr = mysqli_query($con, $mq)){
        $tit = mysqli_fetch_array($mr);
    }

    $cid = $tit["client_id"];
    $cr = mysqli_query($con, "SELECT * FROM `system_clients` WHERE `id`='$cid'");
    $cl = mysqli_fetch_array($cr);

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
                                        <i class="zmdi zmdi-plus"></i>Receive Incoming</button>
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
                            <h5 class="modal-title" id="largeModalLabel">Receive Incoming Merchandize</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="main_action.php" method="post" class="">
                            <div class="modal-body">
                                <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                <input type="hidden" name="client" value="<?= $tit['client_id'] ?>" class="form-control">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Title ID.</label>
                                    <input type="text" readonly id="nf-email" name="title" value="<?= $tit['id'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Merchandise Description</label>
                                    <input type="text" id="nf-password" name="descr" placeholder="Enter Description of Merchandise" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Merchandise Type</label>
                                    <select name="mtype" required="" class="form-control">
                                        <option value="">Please Select Merchandise Type</option>
                                        <option value="Non - Returnable">Non - Returnable</option>
                                        <option value="Returnable">Returnable</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Quantity Received</label>
                                    <input type="number" id="nf-password" name="qty" min="1" placeholder="Enter Quantity of Merchandise Received" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="receive_incoming" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal large -->

            <!-- modal large -->
            <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Generate Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="main_action.php" method="post" enctype="multipart/form-data" >
                            <div class="modal-body">
                                <input type="hidden" name="user" value="<?= $LOGGED_USER["id"] ?>" class="form-control">
                                <input type="hidden" name="client" value="<?= $tit['client_id'] ?>" class="form-control">
                                <input type="hidden" name="title" value="<?= $tit['id'] ?>" class="form-control">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Service Description.</label>
                                    <textarea row="2" id="nf-sdesc" required name="sdesc" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Invoice No.</label>
                                    <input type="text" id="nf-password" name="invoice_no" placeholder="Enter Invoice Number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Amount</label>
                                    <input type="number" id="nf-password" name="amount" min="0" step="0.05" placeholder="Enter Invoice Amount" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Payment Due Date</label>
                                    <input type="date" id="nf-due" name="due_date" placeholder="Payment Due Date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nf-password" class=" form-control-label">Upload Invoice</label>
                                    <input type="file" id="nf-password" name="file" accept="image/*;capture=camera" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="generate_invoice" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal large -->
            
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">
                                <?= $tit["title"] ?> 
                                <a href="title_label.php" title="Print Label" class="btn btn-primary pull-right">
                                    <i class="fa fa-sticky-note"></i>
                                </a>
                            </h3>

                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title" v-if="headerText">Merchandise Received</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2">
                                            <thead>
                                                <tr style="border-top: 1px #c8c6a8 solid; border-bottom: 1px #c8c6a8 solid;">
                                                    <th>Item description</th>
                                                    <th>Received By</th>
                                                    <th>date & Time</th>
                                                    <th>status</th>
                                                    <th>Quantity</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $tid = $tit["id"];

                                                    $con = Dbcon();                                                 
                                                    $cr = mysqli_query($con, "SELECT * FROM `merchandise_received` WHERE `title_id`=$tid");
                                                    while($cl = mysqli_fetch_array($cr)){
                                                        $ref = $cl["id"];
                                                        $ru = $cl["received_by"];
                                                        $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$ru");
                                                        $recvr = mysqli_fetch_array($ur);

                                                ?>
                                                <tr class="tr-shadow">

                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
                                                    <td class="desc"><?= $cl["descript"] ?></td>
                                                    <td><?= $recvr["fullname"] ?></td>
                                                    <td><?= $cl["received_on"] ?></td>
                                                    <td>
                                                        <span class="status--process"><?= $cl["status"] ?></span>
                                                    </td>
                                                    <td><?= $cl["quantity"] ?></td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <a href="merchandise.php?item_reference=<?= $ref ?>" class="item" data-toggle="tooltip" data-placement="top" title="More Details">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </a>
                                                            <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button>-->
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

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">Delivery Orders</strong>
                              </div>
                              <div class="card-body p-0">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-hover table-striped table-align-middle mb-0">
                                      <thead>
                                        <th>Merchandise</th>
                                        <th>Cinema</th>
                                        <th>Shipped Via</th>
                                        <th>AWB No.</th>
                                        <th>Shipped On</th>
                                        <th>Shipped By</th>
                                        <th></th>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tid = $tit["id"];

                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, "SELECT * FROM `delivery_orders` WHERE `title_id`=$tid")or die(mysqli_error($con));
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
                                        <tr>
                                            <td><?= $merch["descript"] ?></td>
                                            <td><?= $dest["cinema"] ?></td>
                                            <td><?= $cl["courier"] ?></td>
                                            <td><?= $cl["awb_no"] ?></td>
                                            <td><?= $cl["shipped_on"] ?></td>
                                            <td><?= $recvr["fullname"] ?></td>
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

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">ILPF Certification (Sijil A)</strong>
                              </div>
                              <div class="card-body p-0">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-hover table-striped table-align-middle mb-0">
                                      <thead>
                                        <th>Title</th>
                                        <th>App. No</th>
                                        <th>Applied On</th>
                                        <th>Report Due</th>
                                        <th>Status</th>
                                        <th>Decision</th>
                                        <th>Classification</th>
                                        <th></th>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tid = $tit["id"];

                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, "SELECT * FROM `sijila_cerfication_records` WHERE `title_id`=$tid")or die(mysqli_error($con));
                                            if(mysqli_num_rows($cr)){
                                                while($cl = mysqli_fetch_array($cr)){
                                                    $ref = $cl["id"];
                                        ?>
                                        <tr>
                                            <td><?= $cl["info"] ?></td>
                                            <td><?= $cl["appno"] ?></td>
                                            <td><?= $cl["applied_on"] ?></td>
                                            <td><?= $cl["expected_report"] ?></td>
                                            <td><?= $cl["status"] ?></td>
                                            <td><?= $cl["decision"] ?></td>
                                            <td><?= $cl["classification"] ?></td>
                                            <td>
                                                <a href="sijila_details.php?item_reference=<?= $ref ?>" class="btn btn-primary pull-right"><i class="fa fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            }else{
                                        ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No Sijil A Application Records For This Title</td>
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

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">ILPF Certification (Sijil B)</strong>
                              </div>
                              <div class="card-body p-0">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-hover table-striped table-align-middle mb-0">
                                      <thead>
                                        <th>Title</th>
                                        <th>App. No</th>
                                        <th>App. Date</th>
                                        <th>App. Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th></th>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tid = $tit["id"];

                                            $con = Dbcon();                                                 
                                            $cr = mysqli_query($con, "SELECT * FROM `sijilb_cerfication_records` WHERE `title_id`=$tid")or die(mysqli_error($con));
                                            if(mysqli_num_rows($cr)){
                                                while($cl = mysqli_fetch_array($cr)){
                                                    $ref = $cl["id"];
                                        ?>
                                        <tr>
                                            <td><?= $cl["info"] ?></td>
                                            <td><?= $cl["app_no"] ?></td>
                                            <td><?= $cl["app_date"] ?></td>
                                            <td><?= $cl["app_type"] ?></td>
                                            <td><?= $cl["status"] ?></td>
                                            <td><?= $cl["action"] ?></td>
                                            <td>
                                                <a href="sijilb_details.php?item_reference=<?= $ref ?>" class="btn btn-primary pull-right"><i class="fa fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            }else{
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No Sijil B Application Records For This Title</td>
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

                        <div class="col-md-12 m-t-25">
                            <div class="card">
                              <div class="card-header">
                                <strong class="card-title" v-if="headerText">Invoices</strong>
                              </div>
                              <div class="card-body p-0">
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-hover table-striped table-align-middle mb-0">
                                      <thead>
                                        <th>Invoice No</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date Due</th>
                                        <th>Date Generated</th>
                                        <th></th>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tid = $tit["id"];

                                            $con = Dbcon();                                                 
                                            $ir = mysqli_query($con, "SELECT * FROM `service_invoice` WHERE `title_id`=$tid")or die(mysqli_error($con));
                                            while($inv = mysqli_fetch_array($ir)){
                                                $ref = $inv["id"];
                                        ?>
                                        <tr style="color: white; background: #c8c6a8;">
                                            <td colspan="6"><?= $inv["service"] ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= $inv["invoice_no"] ?></td>
                                            <td><?= $inv["amount"] ?></td>
                                            <td><?= $inv["status"] ?></td>
                                            <td><?= $inv["due_date"] ?></td>
                                            <td><?= $inv["added"] ?></td>
                                            
                                            <td>
                                                <a href="service_invoice.php?item_reference=<?= $ref ?>" class="btn btn-primary pull-right"><i class="fa fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                            mysqli_close($con);
                                        ?>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <button data-toggle="modal" data-target="#invoiceModal" class="<?= $allow_act_class ?> btn btn-primary pull-right">Generate Invoice <i class="fa fa-print"></i></button>
                                            </td>
                                        </tr>
                                      </tfoot>
                                    </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!--/.col-->
                        
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
