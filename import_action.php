<?php
session_start();
include "DbCon.php";
include "MainFunctions.php";
include "Mailer.php";


if (isset($_REQUEST['upload_sijila'])) {
    $ok = true;
    $act = "add_new";
    $UPID = 0;
    $con = Dbcon(); 
    
    $client = $_REQUEST['client'];
    $file = $_FILES['csv_file']['tmp_name'];
    
    $handle = fopen($file, "r");
    if ($file == NULL) {
    	$INFO = 'Please select a file to import';
    } else {
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
			//print_r($filesop);
			$bill = mysqli_real_escape_string($con,$filesop[0]);
			$title = mysqli_real_escape_string($con,$filesop[1]);
			$app_no = mysqli_real_escape_string($con,$filesop[2]);
			$app_date = mysqli_real_escape_string($con,$filesop[3]);
			$rep_date = mysqli_real_escape_string($con,$filesop[4]);
			$status = mysqli_real_escape_string($con,$filesop[5]);
			$decision = mysqli_real_escape_string($con,$filesop[6]);
			$class = mysqli_real_escape_string($con,$filesop[7]);
			$action = mysqli_real_escape_string($con,$filesop[8]);

			$mt = explode(" (", $title)[0];
			$movtit = $mt;
			//mysqli_real_escape_string($con, $mt);

			if($action == ""){
				$action = "No Action";
			}

			$tid = 0;
			$cid = 0;


		    $mq = "SELECT * FROM `movie_titles` WHERE `title`='$movtit'";
		    $mr = mysqli_query($con, $mq);
		    $mc = mysqli_num_rows($mr);
		    if($mc > 0){
		        $tit = mysqli_fetch_array($mr);
		        $tid = $tit["id"];
				$cid = $tit["client_id"];
				$ok = true;
		    }else{
		    	$ok = false;
		    	if($title != "Tajuk"){
			    	$aqr = "INSERT INTO `movie_titles`(`title`, `client_id`) VALUES ('$movtit', '$client')";
				    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
				        $tid = mysqli_insert_id($con);
				        $cid = $client;
				        $ok = true;
				    }
				}
		    	//insert ???
		    }

		    //Check if this shit already exist
		    $sq = "SELECT `id` AS `upid` FROM `sijila_cerfication_records` WHERE `appno`='$app_no'";
		    $sr = mysqli_query($con, $sq);
		    $sc = mysqli_num_rows($sr);
		    if($sc > 0){
		    	echo "<br />exist already dont add<br />";
		    	//Do Not Add
		    	$r = mysqli_fetch_array($sr);
		    	print_r($r);
		    	$UPID = $r["upid"];
		    	$act = "update";
		    }

		    echo $UPID;
		    
			// If the tests pass we can insert it into the database.       
			if ($ok) {
				if($act == "add_new"){
					$addq = "INSERT INTO `sijila_cerfication_records` (`bill`, `title_id`, `title`, `info`, `appno`, `applied_on`, `expected_report`, `status`, `decision`, `classification`, `action`, `client_id`)".
					" VALUES ('$bill', '$tid', '$movtit', '$title', '$app_no', '$app_date', '$rep_date', '$status', '$decision', '$class', '$action', '$cid')";

					mysqli_query($con, $addq) or die(mysqli_error($con));
				}else if($act == "update" && $UPID != 0){
					echo "Update ".$UPID;
					$addq = "UPDATE `sijila_cerfication_records` SET `status`='$status', `decision`='$decision', `classification`='$class', `action`='$action' WHERE `appno`='$app_no'";

					mysqli_query($con, $addq) or die(mysqli_error($con));
				}
			}else{
				echo "<br />title not found or exist already<br />";
			}

		}
    }
    mysqli_close($con);

    header('Location: batch_sijila.php');
    exit();

}

if (isset($_REQUEST['upload_sijilb'])) {
    $ok = true;
    $act = "add_new";
    $UPID = 0;
    $con = Dbcon(); 
    
    $client = $_REQUEST['client'];
    $file = $_FILES['csv_file']['tmp_name'];
    
    $handle = fopen($file, "r");
    if ($file == NULL) {
    	$INFO = 'Please select a file to import';
    } else {
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
			//print_r($filesop);
			$bill = mysqli_real_escape_string($con,$filesop[0]);
			$app_no = mysqli_real_escape_string($con,$filesop[1]);
			$app_date = mysqli_real_escape_string($con,$filesop[2]);
			$title = mysqli_real_escape_string($con,$filesop[3]);
			$sijilano = mysqli_real_escape_string($con,$filesop[4]);
			$app_type = mysqli_real_escape_string($con,$filesop[5]);
			$status = mysqli_real_escape_string($con,$filesop[6]);			
			$action = mysqli_real_escape_string($con,$filesop[7]);

			$mt = explode(" (", $title)[0];
			$movtit = $mt;
			//mysqli_real_escape_string($con, $mt);

			if($action == ""){
				$action = "No Action";
			}

			$tid = 0;
			$cid = 0;


		    $mq = "SELECT * FROM `movie_titles` WHERE `title`='$movtit'";
		    $mr = mysqli_query($con, $mq);
		    $mc = mysqli_num_rows($mr);
		    if($mc > 0){
		        $tit = mysqli_fetch_array($mr);
		        $tid = $tit["id"];
				$cid = $tit["client_id"];
				$ok = true;
		    }else{
		    	$ok = false;
		    	if($title != "Tajuk"){
			    	$aqr = "INSERT INTO `movie_titles`(`title`, `client_id`) VALUES ('$movtit', '$client')";
				    if(mysqli_query($con, $aqr) or die(mysqli_error($con))){
				        $tid = mysqli_insert_id($con);
				        $cid = $client;
				        $ok = true;
				    }
				}
		    	//insert ???
		    }

		    //Check if this shit already exist
		    $sq = "SELECT `id` AS `upid` FROM `sijilb_cerfication_records` WHERE `app_no`='$app_no'";
		    $sr = mysqli_query($con, $sq);
		    $sc = mysqli_num_rows($sr);
		    if($sc > 0){
		    	echo "<br />exist already dont add<br />";
		    	//Do Not Add
		    	$r = mysqli_fetch_array($sr);
		    	print_r($r);
		    	$UPID = $r["upid"];
		    	$act = "update";
		    }

		    echo $UPID;
		    
			// If the tests pass we can insert it into the database.       
			if ($ok) {
				if($act == "add_new"){
					$addq = "INSERT INTO `sijilb_cerfication_records` (`bill`, `info`, `title_id`, `title`, `app_no`, `app_type`, `app_date`, `sijila_no`, `status`, `action`, `client_id`)".
					" VALUES ('$bill', '$title', '$tid', '$movtit', '$app_no', '$app_type', '$app_date', '$sijilano', '$status', '$action', '$cid')";
					echo $addq;
					mysqli_query($con, $addq) or die(mysqli_error($con));
				}else if($act == "update" && $UPID != 0){
					echo "Update ".$UPID;
					$addq = "UPDATE `sijilb_cerfication_records` SET `status`='$status', `action`='$action' WHERE `app_no`='$app_no'";

					mysqli_query($con, $addq) or die(mysqli_error($con));
				}
			}else{
				echo "<br />title not found or exist already<br />";
			}
		}
    }
    mysqli_close($con);

    header('Location: batch_sijilb.php');
    exit();

}
?>