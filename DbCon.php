<?php
function Dbcon(){
	$user = "alpsebahn";
	$pass = "alpsebahn";
	$host = "127.0.0.1";
	$db = "mega_bpa_db";

	//online
	/**$user = "risaaasp_risaa";
	$pass = "e";
	$host = "204.93.216.11";
	$db = "risaaasp_risaa";*/

	$link = mysqli_connect($host,$user,$pass,$db);

	if (!$link) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
	//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

	return $link;
}
?>
