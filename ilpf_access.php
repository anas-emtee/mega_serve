<?php 
include "main_header.php"; 
include "user_session.php"; 

$cl = $LOGGED_CLIENT;
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
                                            <li class="list-inline-item">ILPF Access</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->
            <?php //print_r($cl) ?>
            <div class="section__content section__content--p30" style="min-height: 75vh;">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12  m-t-25">
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35">ILPF Report Access</h3>

                            <div class="panel panel-default">
                              <div class="panel-heading resume-heading">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3">
                                      <figure>
                                        <img class="img-circle img-responsive" style="width:100%;" src="images/ilpf.png">
                                      </figure>
                                      
                                    </div>
                                    <div class="col-xs-12 col-sm-9">
                                      <ul class="list-group">
                                        <li class="list-group-item bg-primary text-white">Please Follow The Instructions Below To Access ILPF Website</li>
                                        <li class="list-group-item"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; ILPF Username : <?= $cl["ilpf_username"] ?></li>
                                        <li class="list-group-item"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; ILPF Password :  <?= $cl["ilpf_password"] ?></li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  Click On this link to access the <a target="_blank" href="https://ilpf.moha.gov.my">ILPF Site</a> </li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  Login with the above Username and Password</li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  More Instructions....</li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  More Instructions....</li>
                                        <!--<li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  john@example.com</li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  john@example.com</li>
                                        <li class="list-group-item"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;  john@example.com</li>
                                        <li class="list-group-item"><i class="fa fa-ellipsis-h"></i>&nbsp;&nbsp;&nbsp;  <a href="#"  data-toggle="modal" data-target="#myModal">Click here for more instructions</a></li>-->
                                      </ul>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 thumbnail">
                            <img src="images/ilpf_1.png" class="img-responsive">
                            
                        </div>
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
