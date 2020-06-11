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
                                    <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn-add au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->
            <!--<div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row m-t-25">
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c1">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-account-o"></i>
                                        </div>
                                        <div class="text">
                                            <h2>10368</h2>
                                            <span>members online</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c2">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                        </div>
                                        <div class="text">
                                            <h2>388,688</h2>
                                            <span>items solid</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c3">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2>1,086</h2>
                                            <span>this week</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-money"></i>
                                        </div>
                                        <div class="text">
                                            <h2>$1,060,386</h2>
                                            <span>total earnings</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas id="widgetChart4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row  m-t-50">
                        <div class="col-lg-12">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-comment-text"></i>
                                        Movie Titles
                                    </h3>
                                    <button class="<?= $allow_act_class ?>  au-btn-plus au-btn-add">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div id="au-inbox-wrap" class="au-inbox-wrap js-inbox-wrap">
                                    <div class="au-message">
                                        <div class="au-message__noti">
                                            <p>Manage Movie Titles</p>
                                        </div>
                                        <div class="au-message-list">
                                            
                                            <?php  
                                                $cl = $LOGGED_CLIENT;
                                                $con = Dbcon(); 
                                                $mq = "SELECT * FROM `movie_titles` WHERE `client_id`=$CL_ID";
                                                if($mr = mysqli_query($con, $mq)){
                                                    while($tit = mysqli_fetch_array($mr)){
                                            ?>
                                            <div class="au-message__item unread">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap online">
                                                            <div class="avatar">
                                                                <img src="images/icon/movie.png" alt="Mov">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name"><?= $tit["title"] ?></h5>
                                                            <p><?= $cl["cname"] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <div class="table-data-feature">
                                                            <a href="manage_title.php?item_reference=<?= $tit["id"] ?>" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                                mysqli_close($con);
                                            ?>
                                            
                                        </div>
                                        <div class="au-message__footer">
                                            <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn-add au-btn--green">
                                                <i class="zmdi zmdi-plus"></i>add item
                                            </button>
                                        </div>
                                    </div>
                                    <div class="au-chat">
                                        <div class="au-chat__title">
                                            <div class="au-chat-info">
                                                <div class="avatar-wrap online">
                                                    <div class="avatar avatar--small">
                                                        <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                    </div>
                                                </div>
                                                <span class="nick">
                                                    <a href="#">New Movie Title</a>
                                                </span>
                                            </div>
                                        </div>
                                        <form action="main_action.php" method="post" class="au-form-icon">
                                            <div class="au-chat__content">
                                                <div class="form-group">
                                                    <label for="nf-title" class=" form-control-label">Movie Title</label>
                                                    <input type="text" required="" id="nf-title" name="movtitle" placeholder="Movie Title.." class="form-control">
                                                    <span class="help-block">Please enter movie Title</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nf-client" class=" form-control-label">Select Client</label>
                                                    <select name="client" id="select" required class="form-control">
                                                        <option value="">Please select</option>
                                                        <?php  
                                                            $con = Dbcon(); 
                                                            $stq = "SELECT * FROM `system_clients` WHERE `ctype`='customer'";
                                                            if($str = mysqli_query($con, $stq)){
                                                                while($stud = mysqli_fetch_array($str)){
                                                                    $swid = $stud["id"];
                                                        ?>
                                                                    <option value="<?= $swid ?>"><?= $stud["cname"]; ?></option>
                                                        <?php
                                                                }
                                                            }
                                                            mysqli_close($con);
                                                        ?>
                                                        
                                                    </select>
                                                    <span class="help-block">Please Select Client For New Title</span>
                                                </div>
                                            </div>
                                            <div class="au-chat-textfield">
                                                <button id="payment-button" type="submit" name="add_title" values="add_title" class="btn btn-lg btn-success btn-block">
                                                    <i class="fa fa-add fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Add Title</span>
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
