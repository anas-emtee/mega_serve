<?php
session_start();
include "DbCon.php";
include "MainFunctions.php";
include "Mailer.php";
require_once 'Mobile_Detect.php';
include "PC_Detect.php";

$detect = new Mobile_Detect;
$device = "";
$device_os = "";

if($detect->isMobile()) {
    $device = "Mobile";
}else{
    $device = "PC";
}

// Any tablet device.
if( $detect->isTablet()) {
    $device = "Tablet";
}

// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet()) {
  //echo "Exclude tablets";
}

// Check for a specific platform
if( $detect->isiOS()) {
    $device_os = "iOS";
}

if( $detect->isAndroidOS()) {
    $device_os = "Android";
}
if( $detect->isWindowsPhoneOS()) {
    $device_os = "Windows Phone";
}

if($device == "PC") {
   $device_os = getOS();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Tukur Anas">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>MegaServe System</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- JSPDF 
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <style type="text/css">
        .disallow-act{
            display: none !important;
        }
    </style>

</head>