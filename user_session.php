<?php
$LOGGED = false;
$LT = false;
$my_lat = "0.0000";
$my_lon = "0.0000";
$my_adr = "Not Available";
$allow_act_class = "allow-act";
$CL_ID = "1";
if(isset($_SESSION["logged"])){
    $LOGGED = true;
    $LOGGED_USER = $_SESSION["active_account"];

   	$ut = $LOGGED_USER["usertype"];
    $ua = $LOGGED_USER["access"];
    $CL_ID = $LOGGED_USER["client_id"];

    $con = Dbcon(); 
    $lcr = mysqli_query($con, "SELECT * FROM `system_clients` WHERE `id`='$CL_ID'");
    $LOGGED_CLIENT = mysqli_fetch_array($lcr);
    mysqli_close($con);

    if($ut == "user" && $ua == "administrator"){
    	$allow_act_class = "allow-act";
    }else if($ut == "client" && $ua == "administrator"){
    	$allow_act_class = "disallow-act";
    }else if($ut == "user" && $ua == "operation"){
    	$allow_act_class = "disallow-act";
    }
}else{
    header("location:index.php");
    exit();
}

if(isset($_SESSION["my_lat"])){
	$my_lat = $_SESSION["my_lat"];
	$my_lon = $_SESSION["my_lon"];
	$my_adr = $_SESSION["address"];
}


?>