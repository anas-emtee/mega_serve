<?php

function randomString($length, $from, $col = "passcode") {
    $str = "";
    $characters = array_merge(range('A','Z'), range('0','9'), range('a','z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    
    if(checkCode($str, $from, $col)){
        return $str;
    }else{
        return randomString($length, $from);
    }
}

function checkCode($code, $from, $col) {
    $str = false;
    $con = Dbcon();
    $evpqr = "SELECT * FROM `".$from."` WHERE `".$col."`='$code'";
    
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) <= 0){
           $str = true;
        }else{ $str = false; }
    }else{ $str = false; }
    return $str;
}

function finalCheck($myArray, $myUk){
    $ret = TRUE;
    foreach($myArray as $win => $reciept) {
        //echo "<br> Final Checkin Key=" . $win . ", Value=" . $reciept;
        $ag = explode("-", $win)[2];
        $ag1 = explode("-", $myUk)[2];
        if($ag == $ag1){
            $ret = $ret && FALSE;
        }
    }
    return $ret;
}

function dayToday(){
    $t=time();
    $day = date('D', $t);
    
    return $day;
}

function dateToday(){
    $t=time();
    $day = date('Y-m-d', $t);
    
    return $day;
}

function timeNow(){
    $day = date("H:i:s");
    
    return $day;
}

function minutesToTimeFormat($diff){
    $ret = "";
 
    $days = floor($diff / (60*60*24)); 
    if($days != 0){ $ret = $ret."".$days." days "; }
    
    $hours = floor(($diff - $days*60*60*24) / (60*60));
    if($hours != 0){ $ret = $ret."".$hours." hrs "; }
    
    $minutes = floor(($diff - $days*60*60*24  - $hours*60*60) / 60);  
    if($minutes != 0){ $ret = $ret."".$minutes." mins "; }
    
    $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes * 60));  
    if($seconds != 0){ $ret = $ret."".$seconds." secs "; }
      
    // Print the result 
    /**printf("%d years, %d months, %d days, %d hours, "
         . "%d minutes, %d seconds", $years, $months, 
                 $days, $hours, $minutes, $seconds);**/
    //$ret = $hours." hrs ".$minutes." mins ".$seconds." secs";
    $ret = $hours." : ".$minutes." : ".$seconds;

    return $ret;  
}

function toTimeFormat($diff){
    $ret = "";
 
    $days = floor($diff / (60*60*24)); 
    if($days != 0){ $ret = $ret."".$days." days "; }
    
    $hours = floor(($diff - $days*60*60*24) / (60*60));
    if($hours != 0){ $ret = $ret."".$hours." hrs "; }
    
    $minutes = floor(($diff - $days*60*60*24  - $hours*60*60) / 60);  
    if($minutes != 0){ $ret = $ret."".$minutes." mins "; }
    
    $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes * 60));  
    if($seconds != 0){ $ret = $ret."".$seconds." secs "; }
      
    // Print the result 
    /**printf("%d years, %d months, %d days, %d hours, "
         . "%d minutes, %d seconds", $years, $months, 
                 $days, $hours, $minutes, $seconds);**/
    //$ret = $hours." hrs ".$minutes." mins ".$seconds." secs";
    //$ret = $hours." : ".$minutes." : ".$seconds;

    return $ret;  
}

function calculateAmount($charge, $unit){
    $t=time();
    $day = date('D', $t);
    
    return $day;
}

function getPeriod($vfor, $vu){
    /*$end = NULL;
    if($vu == "hours"){
        $end = date('Y-m-d', strtotime('+'.$vfor.' hours'));
    }else if($vu == "days"){
        $end = date('Y-m-d', strtotime('+5 days'));
    }else if($vu == "months"){
        $end = date('Y-m-d', strtotime('+5 months'));
    }else if($vu == "years"){
        $end = date('Y-m-d', strtotime('+5 years'));
    }*/
    $end = date('Y-m-d H:i:s', strtotime('+'.$vfor.' '.$vu));
    
    return $end;
}

function daysBetween($start, $end){
    $from = strtotime($start);
    $to = strtotime($end);
    $datediff = $to - $from;

    $days = round($datediff / (60 * 60 * 24));

    return $days;
}

function arrayOfPossibilities($n){
    $aop = array();
    for ($i = 0; $i < $n; $i++) {
        $aop[$i] = "Dummy_Deal#".$i;
    }

    return $aop;
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

?>