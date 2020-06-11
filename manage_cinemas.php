<?php 
include "main_header.php"; 
include "user_session.php"; 
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
                                    <!--<button class="<?= $allow_act_class ?>  au-btn au-btn-icon au-btn-add au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add cinema</button>-->
                                    <button class="<?= $allow_act_class ?>  btn btn-success" data-toggle="modal" data-target="#mediumModal">
                                        <i class="fa fa-clone"></i> &nbsp;&nbsp;&nbsp;Batch Upload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- modal medium -->
            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Upload Cinema By CSV/XLSX</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="main_action.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">Upload Cinema File</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" name="csv_file" class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="upload_cinema" class="btn btn-primary">Confirm</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal medium -->
            
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row  m-t-50">
                        <div class="col-lg-12">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-comment-text"></i>
                                        Cinemas
                                    </h3>
                                    <button class="<?= $allow_act_class ?> au-btn-plus au-btn-add">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div id="au-inbox-wrap" class="au-inbox-wrap js-inbox-wrap">
                                    <div class="au-message">
                                        <div class="au-message__noti">
                                            <p>Manage Cinema Records</p>
                                        </div>
                                        <div class="au-message-list">
                                            <?php  
                                                $con = Dbcon();                                                 
                                                $cr = mysqli_query($con, "SELECT * FROM `cinema_info`");
                                                while($cl = mysqli_fetch_array($cr)){
                                            ?>
                                            <div class="au-message__item unread">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap online">
                                                            <div class="avatar">
                                                                <img src="images/icon/cinema.png" alt="Mov">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name"><?= $cl["cinema"] ?></h5>
                                                            <p><?= $cl["address"] ?></p>
                                                            <small><?= $cl["email"] ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <div class="table-data-feature">
                                                            <button class="<?= $allow_act_class ?>  item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            <a href="manage_cinema.php?item_reference=<?= $cl["id"] ?>" class="<?= $allow_act_class ?> item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </a>
                                                            <a href="delivery_order_history.php?cinema_reference=<?= $cl["id"] ?>" class="item" data-toggle="tooltip" data-placement="top" title="Merchandize Delivery">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                                mysqli_close($con);
                                            ?>
                                            
                                        </div>
                                        <div class="au-message__footer">
                                            <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn-add au-btn--green">
                                                <i class="zmdi zmdi-plus"></i>add cinema
                                            </button>
                                            <a href="delivery_order_history.php" class="au-btn au-btn-icon btn-primary">
                                                <i class="zmdi zmdi-mail-send"></i>View All Mechandize Delivery
                                            </a>
                                        </div>
                                    </div>
                                    <div class="au-chat">
                                        <div class="au-chat__title">
                                            <div class="au-chat-info">
                                                <div class="avatar-wrap online">
                                                    <div class="avatar avatar--small">
                                                        <img src="images/icon/cinema.png" alt="John Smith">
                                                    </div>
                                                </div>
                                                <span class="nick">
                                                    <a href="#">New Cinema</a>
                                                </span>
                                            </div>
                                        </div>
                                        <form action="main_action.php" method="post" class="au-form-icon">
                                            <div class="au-chat__content">
                                                <div class="form-group">
                                                    <label for="nf-title" class=" form-control-label">Cinema Description</label>
                                                    <input type="text" required="" id="nf-title" name="cname" placeholder="Cinema Name.." class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="textarea-input" class=" form-control-label">Cinema Address</label>
                                                    <textarea name="cadd" id="textarea-input" rows="2" placeholder="Address..." class="form-control"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nf-title" class=" form-control-label">Cinema Manager Name</label>
                                                    <input type="text" required="" id="nf-cmanager" name="cmanager" placeholder="Manager Name.." class="form-control">
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="nf-title" class=" form-control-label">Cinema Mobile No.</label>
                                                        <input type="text" required="" id="nf-cmobile" name="cmobile" placeholder="Mobile No.." class="form-control">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="nf-title" class=" form-control-label">Cinema Email Address.</label>
                                                        <input type="text" required="" id="nf-cmobile" name="cemail" placeholder="Email Address.." class="form-control">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="au-chat-textfield">
                                                <button id="payment-button" type="submit" name="add_cinema" values="add_title" class="btn btn-lg btn-success btn-block">
                                                    <i class="fa fa-add fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Add Cinema</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
