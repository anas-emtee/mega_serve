<?php include "main_header.php";
include "user_session.php"; 

if(isset($_REQUEST["item_reference"])){
    $item = $_REQUEST["item_reference"];

    $con = Dbcon(); 
    $invq = "SELECT * FROM `service_invoice`  WHERE `id`='$item'";
    if($invr = mysqli_query($con, $invq)){
        $invoice = mysqli_fetch_array($invr);
    }

    $cid = $invoice["client_id"];
    $cr = mysqli_query($con, "SELECT * FROM `system_clients` WHERE `id`='$cid'");
    $cl = mysqli_fetch_array($cr);

    $tid = $invoice["title_id"];
    $tr = mysqli_query($con, "SELECT * FROM `movie_titles` WHERE `id`='$tid'");
    $title = mysqli_fetch_array($tr);

    $ru = $invoice["generated_by"];
    $ur = mysqli_query($con, "SELECT * FROM `system_accounts` WHERE `id`=$ru");
    $gen = mysqli_fetch_array($ur);
}
?>
<style type="text/css">
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
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
                                            <li class="list-inline-item">Service Invoice</li>
                                        </ul>
                                    </div>
                                    <button class="<?= $allow_act_class ?> au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>Update Status</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <div id="invoice" class="">
                <div class="toolbar hidden-print">
                    <div class="text-right">
                        <button id="printInvoice" onclick="CreatePDFfromHTML();" class="btn btn-info"><i class="fa fa-print"></i> Print This Invoice</button>
                        <a href="<?= $invoice["invoice_doc"] ?>" target="_blank" download="" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Download Original Invoice </a>
                        <a href="manage_title.php?item_reference=<?= $tid ?>" class="btn btn-danger"><i class="fa fa-times"></i> Close </a>
                    </div>
                    <hr>
                </div>
                <div class="invoice overflow-auto html-content">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="#">
                                        <img src="images/icon/logo.png" data-holder-rendered="true" alt="Mega Filem" />
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        Mega Filem Enterprise Sdn Bhd
                                    </h2>
                                    <!-- B-06-05, B-06-06, B-06-07  -->
                                    <div>Block VOX Southgate Commercial Center, Jalan Dua,<br /> Off Jalan Chan Sow Lin, 55200 Kuala Lumpur</div>
                                    <div>60392221192</div>
                                    <div>company@megafilem.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to"><?= $cl["cname"] ?></h2>
                                    <div class="address"><?= $cl["address"] ?></div>
                                    <div class="email"><a href="mailto:<?= $cl["email"] ?>"><?= $cl["email"] ?></a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE <?= $invoice["invoice_no"] ?></h1>
                                    <div class="date">Date of Invoice: <?= explode(" ", $invoice["added"])[0] ?></div>
                                    <div class="date">Due Date: <?= $invoice["due_date"] ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="margin-bottom: 20px;" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-left">DESCRIPTION</th>
                                                <!--<th class="text-right">HOUR PRICE</th>
                                                <th class="text-right">HOURS</th>-->
                                                <th class="text-right">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="no">01</td>
                                                <td class="text-left">
                                                    <h3><?= $title["title"] ?></h3>
                                                    <?= $invoice["service"] ?>
                                                </td>
                                                
                                                <td class="total">$ <?= $invoice["amount"] ?></td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">SUBTOTAL</td>
                                                <td>$ <?= $invoice["amount"] ?></td>
                                            </tr>
                                            <!--<tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">TAX 25%</td>
                                                <td>$1,300.00</td>
                                            </tr>-->
                                            <tr>
                                                <td colspan="2">GRAND TOTAL</td>
                                                <td>$ <?= $invoice["amount"] ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t-75">
                                    <div class="thanks">Thank you!</div>
                                    <div class="notices">
                                        <div>NOTICE:</div>
                                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
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
    <script type="text/javascript">
        /*$('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
        $('#printInvoice').click(
            CreatePDFfromHTML()
        );*/
        //Create PDf from HTML...
        function CreatePDFfromHTML() {
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($(".html-content")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("<?= $invoice["invoice_no"] ?>.pdf");
                //$(".html-content").hide();
            });
        }
    </script>
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
