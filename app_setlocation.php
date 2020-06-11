<?php
session_start();

print_r($_POST);
if(isset($_POST["location"])){
    print_r($_POST);
    $location = $_POST["location"];
    $address = $_POST["address"];

    $locs = explode("X", $location);
    $lat = $locs[0];
    $lon = $locs[1];

    $_SESSION["my_lat"] = $lat;
    $_SESSION["my_lon"] = $lon;
    $_SESSION["address"] = $address;
}

echo "Location Set to ".$lat." By ".$lon;
?>
