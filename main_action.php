<?php
session_start();
include "DbCon.php";
include "MainFunctions.php";
include "Mailer.php";

if(isset($_POST["add_title"])){
    $title = $_POST["movtitle"];
    $client = $_POST["client"];
    $result = "dashboard.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `movie_titles`(`title`, `client_id`) VALUES ('$title', '$client')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
        $IID = mysqli_insert_id($con);
        $result = "manage_title.php?item_reference=".$IID."&message=New Title Added.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["add_client"])){
    print_r($_POST);
    $cname = $_POST["cname"];
    $cadd = $_POST["cadd"];
    $cemail = $_POST["cemail"];
    $cmobile = $_POST["cmobile"];
    $client_pass = $_POST["client_pass"];
    $hashed_password = password_hash($client_pass, PASSWORD_BCRYPT);
    $result = "manage_client.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `system_clients`(`cname`, `address`, `email`, `mobile`) VALUES ('$cname', '$cadd', '$cemail', '$cmobile')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
        $IID = mysqli_insert_id($con);
        $uqr = "INSERT INTO `system_accounts`(`fullname`, `usertype`, `username`, `password`, `access`, `client_id`) VALUES ('$cname', 'client', '$cemail', '$hashed_password', 'administrator', '$IID')";
        mysqli_query($con, $uqr) or die(mysqli_error($con));
        $result = "manage_clients.php?item_reference=".$IID."&message=New Title Added.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["add_cinema"])){
    print_r($_POST);
    $cname = $_POST["cname"];
    $cadd = $_POST["cadd"];
    $cemail = $_POST["cemail"];
    $cmobile = $_POST["cmobile"];
    
    $result = "manage_cinemas.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `cinema_info`(`cinema`, `address`, `mobile`, `email`) VALUES ('$cname', '$cadd', '$cmobile', '$cemail')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
        $IID = mysqli_insert_id($con);
        
        $result = "manage_cinemas.php?item_reference=".$IID."&message=New Cinema Added.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["add_user"])){
    print_r($_POST);
    $client = $_POST["client_id"];
    $fullname = $_POST["fullname"];
    $uemail = $_POST["uemail"];
    $utype = $_POST["utype"];
    $uaccess = $_POST["uaccess"];
    $user_pass = $_POST["user_pass"];
    $hashed_password = password_hash($user_pass, PASSWORD_BCRYPT);
    $result = "system_users.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `system_accounts`(`fullname`, `usertype`, `username`, `password`, `access`, `client_id`) VALUES ('$fullname', '$utype', '$uemail', '$hashed_password', '$uaccess', '$client')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
        $IID = mysqli_insert_id($con);
        
        $result = "system_users.php?item_reference=".$IID."&message=New Cinema Added.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["receive_incoming"])){
    print_r($_POST);
    $user = $_POST["user"];
    $client = $_POST["client"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $qty = $_POST["qty"];
    $mtype = $_POST["mtype"];
    
    $result = "merchandise.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `merchandise_received`(`title_id`, `client_id`, `merch_type`, `descript`, `quantity`, `received_by`) VALUES ('$title', '$client', '$mtype', '$descr', '$qty', '$user')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
        $IID = mysqli_insert_id($con);
        
        $result = "merchandise.php?item_reference=".$IID."&message=New Merchandize Added.";
    }
    
    header('Location: '.$result);
    exit();
}
//upload_merch_document

if(isset($_POST["upload_merch_document"])){
    print_r($_POST);
    $user = $_POST["user"];
    $docid = $_POST["docid"];
    $merchid = $_POST["merchid"];
    $title = $_POST["doctitle"];

    $nameString = str_replace(" ","",$title);
    $nameString = strtolower($nameString);
    $fileName = $_FILES["file"]["name"]; //the original file name
    $splitName = explode(".", $fileName); //split the file name by the dot
    $fileExt = end($splitName); //get the file extension
    $newFileName  = $nameString.'.'.$fileExt; //join file name and ext.
    $pimg = "documents/$newFileName";

    move_uploaded_file($_FILES["file"]["tmp_name"], $pimg);
    $result = "system_users.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `merchandise_uploads`(`document`, `merch_id`, `document_src`) VALUES ('$docid', '$merchid', '$pimg')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $result = "merchandise.php?item_reference=".$merchid."&message=Document Uploaded Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["upload_sijila_document"])){
    print_r($_POST);
    $user = $_POST["user"];
    $docid = $_POST["docid"];
    $sc_id = $_POST["sc_id"];
    $sc_type = $_POST["sc_type"];
    $title = $_POST["doctitle"];

    $nameString = str_replace(" ","",$title);
    $nameString = strtolower($nameString);
    $fileName = $_FILES["file"]["name"]; //the original file name
    $splitName = explode(".", $fileName); //split the file name by the dot
    $fileExt = end($splitName); //get the file extension
    $newFileName  = $nameString.'.'.$fileExt; //join file name and ext.
    $pimg = "documents/$newFileName";

    move_uploaded_file($_FILES["file"]["tmp_name"], $pimg);
    $result = "sijila_details.php?item_reference=".$sc_id;

    $con = Dbcon();
    $aqr = "INSERT INTO `sijil_uploads`(`document`, `sc_id`, `sc_type`, `document_src`) VALUES ('$docid', '$sc_id', '$sc_type', '$pimg')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $result = "sijila_details.php?item_reference=".$sc_id."&message=Document Uploaded Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["upload_sijilb_document"])){
    print_r($_POST);
    $user = $_POST["user"];
    $docid = $_POST["docid"];
    $sc_id = $_POST["sc_id"];
    $sc_type = $_POST["sc_type"];
    $title = $_POST["doctitle"];

    $nameString = str_replace(" ","",$title);
    $nameString = strtolower($nameString);
    $fileName = $_FILES["file"]["name"]; //the original file name
    $splitName = explode(".", $fileName); //split the file name by the dot
    $fileExt = end($splitName); //get the file extension
    $newFileName  = $nameString.'.'.$fileExt; //join file name and ext.
    $pimg = "documents/$newFileName";

    move_uploaded_file($_FILES["file"]["tmp_name"], $pimg);
    $result = "sijilb_details.php?item_reference=".$sc_id;

    $con = Dbcon();
    $aqr = "INSERT INTO `sijil_uploads`(`document`, `sc_id`, `sc_type`, `document_src`) VALUES ('$docid', '$sc_id', '$sc_type', '$pimg')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $result = "sijilb_details.php?item_reference=".$sc_id."&message=Document Uploaded Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["delivery_order"])){
    print_r($_POST);
    $user = $_POST["user"];
    $client = $_POST["client"];
    $merch = $_POST["merch"];
    $merch_type = $_POST["merch_type"];
    $title = $_POST["title"];
    $quantity = $_POST["quantity"];
    $destination = $_POST["destination"];
    $courier = $_POST["courier"];
    $awbno = $_POST["awbno"];
    $retdate = $_POST["retdate"];

    $result = "system_users.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `delivery_orders`(`client_id`, `title_id`, `merch_id`, `merch_type`, `quantity`, `destination`, `courier`, `awb_no`, `shipped_by`, `return_on`) VALUES ('$client', '$title', '$merch', '$merch_type', '$quantity', '$destination', '$courier', '$awbno', '$user', '$retdate')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $result = "merchandise.php?item_reference=".$merch."&message=Delivery Order Added Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}
//generate_invoice
if(isset($_POST["generate_invoice"])){
    print_r($_POST);
    $user = $_POST["user"];
    $client = $_POST["client"];
    $title = $_POST["title"];
    $invoice = $_POST["invoice_no"];
    $amount = $_POST["amount"];
    $due = $_POST["due_date"];
    $sdesc = $_POST["sdesc"];

    $nameString = str_replace(" ","",$invoice);
    $nameString = strtolower($nameString);
    $fileName = $_FILES["file"]["name"]; //the original file name
    $splitName = explode(".", $fileName); //split the file name by the dot
    $fileExt = end($splitName); //get the file extension
    $newFileName  = $nameString.'.'.$fileExt; //join file name and ext.
    $pimg = "documents/$newFileName";

    move_uploaded_file($_FILES["file"]["tmp_name"], $pimg);
    $result = "system_users.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `service_invoice`(`title_id`, `client_id`, `invoice_no`, `invoice_doc`, `amount`, `due_date`, `generated_by`, `service`) VALUES ('$title', '$client', '$invoice', '$pimg', '$amount', '$due', '$user', '$sdesc')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $IID = mysqli_insert_id($con);
        $result = "service_invoice.php?item_reference=".$IID."&message=Invoice Generated Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["new_od_status"])){
    print_r($_POST);
    $user = $_POST["user"];
    $doid = $_POST["doid"];
    $merch = $_POST["merch"];
    $stat_id = $_POST["stat_id"];
    $stat_val = $_POST["stat_val"];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $adr = $_POST["adr"];
    $remark = $_POST["remark"];
    if($remark == ""){$remark = "No Remark";}
    $result = "delivery_order_details.php";

    $con = Dbcon();
    $aqr = "INSERT INTO `merch_do_status`(`do_id`, `stat_id`, `stat_val`, `updated_by`, `remark`, `lat`, `lng`, `loc`) VALUES ('$doid', '$stat_id', '$stat_val', '$user', '$remark', '$lat', '$lon', '$adr')";
    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){        
        $IID = mysqli_insert_id($con);
        $result = "delivery_order_details.php?item_reference=".$doid."&message=Invoice Generated Succesfully.";
    }
    
    header('Location: '.$result);
    exit();
}

if(isset($_POST["batch_do_status"])){
    print_r($_POST);
    $user = $_POST["user"];
    $stat_id = $_POST["stat_id"];
    $stat_val = $_POST["stat_val"];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $adr = $_POST["adr"];
    $remark = "Batch Status Update";
    $result = "batch_delivery_orders.php";
    $dords = $_POST["dords"];

    foreach ($dords as $dord) {
        $dm = explode("_", $dord);
        $doid = $dm[0];
        $merch = $dm[1];
    
    
        $con = Dbcon();
        $aqr = "INSERT INTO `merch_do_status`(`do_id`, `stat_id`, `stat_val`, `updated_by`, `remark`, `lat`, `lng`, `loc`) VALUES ('$doid', '$stat_id', '$stat_val', '$user', '$remark', '$lat', '$lon', '$adr')";
        echo $aqr;

        mysqli_query($con, $aqr) or die(mysqli_error($con));
    }
    mysqli_close($con);
    $result = "batch_delivery_orders.php?message=Updated Succesfully.";
    header('Location: '.$result);
    exit();
}

if(isset($_POST["batch_sijila_status"])){
    print_r($_POST);
    $user = $_POST["user"];
    $stat_id = $_POST["stat_id"];
    $stat_val = $_POST["stat_val"];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $adr = $_POST["adr"];
    $remark = "Batch Status Update";
    $result = "batch_sijila.php";
    $dords = $_POST["dords"];

    foreach ($dords as $scid) {    
        $con = Dbcon();
        $aqr = "INSERT INTO `sijil_certification_status`(`sc_id`, `sc_type`, `stat_id`, `stat_val`, `updated_by`, `remark`, `lat`, `lng`, `loc`) VALUES ('$scid', 'A', '$stat_id', '$stat_val', '$user', '$remark', '$lat', '$lon', '$adr')";
        echo $aqr;

        if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
            $addq = "UPDATE `sijila_cerfication_records` SET `status`='$stat_val' WHERE `id`='$scid'";
            mysqli_query($con, $addq) or die(mysqli_error($con));
        }
    }
    mysqli_close($con);
    $result = "batch_sijila.php?message=Updated Succesfully.";
    header('Location: '.$result);
    exit();
}

if(isset($_POST["batch_sijilb_status"])){
    print_r($_POST);
    $user = $_POST["user"];
    $stat_id = $_POST["stat_id"];
    $stat_val = $_POST["stat_val"];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $adr = $_POST["adr"];
    $remark = "Batch Status Update";
    $result = "batch_delivery_orders.php";
    $dords = $_POST["dords"];

    foreach ($dords as $scid) {    
        $con = Dbcon();
        $aqr = "INSERT INTO `sijil_certification_status`(`sc_id`, `sc_type`, `stat_id`, `stat_val`, `updated_by`, `remark`, `lat`, `lng`, `loc`) VALUES ('$scid', 'A', '$stat_id', '$stat_val', '$user', '$remark', '$lat', '$lon', '$adr')";
        echo $aqr;

        if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
            $addq = "UPDATE `sijilb_cerfication_records` SET `status`='$stat_val' WHERE `id`='$scid'";
            mysqli_query($con, $addq) or die(mysqli_error($con));
        }
    }
    mysqli_close($con);
    $result = "batch_sijilb.php?message=Updated Succesfully.";
    header('Location: '.$result);
    exit();
}
?>
