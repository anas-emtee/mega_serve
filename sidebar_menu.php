<?php 
    $ut = $LOGGED_USER["usertype"];
    $ua = $LOGGED_USER["access"];
?>
<!-- MENU SIDEBAR-->
<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" style="max-width:200px;" alt="CoolAdmin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <!--<div class="image img-cir img-120">
                <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
            </div>-->
            <h4 class="name"><?= $LOGGED_USER["fullname"] ?> [<?= $CL_ID ?>]</h4>
            <a class="m-t-20 btn btn-small btn-block btn-danger text-white" href="signout.php">
                Sign out <i class="m-l-15 fa fa-lock"></i>
            </a>
            <div class="d-flex">
              <div class="p-2 flex-fill">
                <button type="button" class="btn btn-info btn-small text-white"  data-toggle="modal" data-target="#QRCodeModal" >
                    <i class=" fa fa-qrcode"></i>
                </button>
              </div>
              <div class="p-2 flex-fill">
                <button type="button" class="btn btn-info btn-small text-white"  data-toggle="modal" data-target="#BarCodeModal" >
                     <i class=" fa fa-barcode"></i>
                </button>
              </div>
            </div>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <?php //echo $ut; echo $ua; echo $allow_act_class; ?>
                <?php if($ut == "user" && $ua == "administrator"){ ?>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_titles.php">
                            <i class="fas fa-file-movie-o"></i>Movie Titles
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_clients.php">
                            <i class="fas fa-address-book"></i>Clients
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_cinemas.php">
                            <i class="fas fa-address-book"></i>Cinemas
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-clone"></i>Batch Operations
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="batch_delivery_orders.php">
                                    <i class="fas fa-square"></i>Delivery Order Status</a>
                            </li>
                            <!--<li>
                                <a href="batch_sijila.php">
                                    <i class="fas fa-square"></i>Import Cinema Records</a>
                            </li>-->
                            <li>
                                <a href="batch_sijila.php">
                                    <i class="fas fa-square"></i>Import ILFP SijilA</a>
                            </li>
                            <li>
                                <a href="batch_sijilb.php">
                                    <i class="fas fa-square"></i>Import ILFP SijilB</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="manage_cinemas.php">
                            <i class="fas fa-address-book"></i>Delivery Reports
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="system_users.php">
                            <i class="fas fa-user"></i>System Users
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                <?php } ?>

                <?php if($ut == "client" && $ua == "administrator"){ ?>
                    <li class="active">
                        <a href="clientboard.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="client_titles.php">
                            <i class="fas fa-file-movie-o"></i>Movie Titles
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-clone"></i>ILFP Certification
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="batch_sijila.php">
                                    <i class="fas fa-square"></i>ILPF SijilA
                                </a>
                            </li>
                            <li>
                                <a href="batch_sijilb.php">
                                    <i class="fas fa-square"></i>ILPF SijilB
                                </a>
                            </li>
                            <li>
                                <a href="ilpf_access.php">
                                    <i class="fas fa-square"></i>ILPF Access
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="manage_cinemas.php">
                            <i class="fas fa-address-book"></i>Delivery Reports
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="merchandise_history.php">
                            <i class="fas fa-address-book"></i>Merchandise Reports
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="invoice_history.php">
                            <i class="fas fa-address-book"></i>Invoice Reports
                            <span class="arrow">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </li>
                <?php } ?>
                <!--<li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="index.html">
                                <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                        </li>
                        <li>
                            <a href="index2.html">
                                <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                        </li>
                        <li>
                            <a href="index3.html">
                                <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                        </li>
                        <li>
                            <a href="index4.html">
                                <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="inbox.html">
                        <i class="fas fa-chart-bar"></i>Inbox</a>
                    <span class="inbox-num">3</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-basket"></i>eCommerce</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-trophy"></i>Features
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Pages
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="login.html">
                                <i class="fas fa-sign-in-alt"></i>Login</a>
                        </li>
                        <li>
                            <a href="register.html">
                                <i class="fas fa-user"></i>Register</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">
                                <i class="fas fa-unlock-alt"></i>Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-desktop"></i>UI Elements
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="button.html">
                                <i class="fab fa-flickr"></i>Button</a>
                        </li>
                        <li>
                            <a href="badge.html">
                                <i class="fas fa-comment-alt"></i>Badges</a>
                        </li>
                        <li>
                            <a href="tab.html">
                                <i class="far fa-window-maximize"></i>Tabs</a>
                        </li>
                        <li>
                            <a href="card.html">
                                <i class="far fa-id-card"></i>Cards</a>
                        </li>
                        <li>
                            <a href="alert.html">
                                <i class="far fa-bell"></i>Alerts</a>
                        </li>
                        <li>
                            <a href="progress-bar.html">
                                <i class="fas fa-tasks"></i>Progress Bars</a>
                        </li>
                        <li>
                            <a href="modal.html">
                                <i class="far fa-window-restore"></i>Modals</a>
                        </li>
                        <li>
                            <a href="switch.html">
                                <i class="fas fa-toggle-on"></i>Switchs</a>
                        </li>
                        <li>
                            <a href="grid.html">
                                <i class="fas fa-th-large"></i>Grids</a>
                        </li>
                        <li>
                            <a href="fontawesome.html">
                                <i class="fab fa-font-awesome"></i>FontAwesome</a>
                        </li>
                        <li>
                            <a href="typo.html">
                                <i class="fas fa-font"></i>Typography</a>
                        </li>
                    </ul>
                </li>-->
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->