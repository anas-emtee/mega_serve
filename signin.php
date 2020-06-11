<!DOCTYPE HTML>
<?php 
session_start();
include "DbCon.php"; 
if(isset($_POST["login"])){
    print_r($_POST);
    $username = $_POST["userEmailField"];
    $password = $_POST["userPassField"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $IN_INFO = "Success";
    
    $con = Dbcon();
    $query =  "SELECT * FROM `system_accounts` WHERE `username`='$username'";
    
    if ($adds = mysqli_query($con, $query)){
        $count = mysqli_num_rows($adds);
        if($count > 0){
            $account = mysqli_fetch_array($adds);
            print_r($account);
            $pass_check = $account["password"];
            if(strlen($pass_check) > 60){$pass_check = substr( $pass_check, 0, 60 );}
            echo $pass_check;
            echo "<br>";
            echo $hashed_password;

            if(password_verify($password, $pass_check) || $hashed_password == $pass_check){
                $ut = $account["usertype"];
                $ua = $account["access"];
                $_SESSION["active_account"] = $account;
                $_SESSION["logged"] = date("Y-m-d H:i:s");

                if($ut == "user" && $ua == "administrator"){
                    $goto = "dashboard.php";
                }else if($ut == "user" && $ua == "general"){
                    $goto = "userboard.php";
                }else if($ut == "client"){
                    $goto = "clientboard.php";
                }else{
                    $goto = "homeboard.php";
                }
                
            }else{
                $IN_INFO = "Wrong Username or Password. Please try again.";
                $goto = "index.php?info=".$IN_INFO;
            }
        }else{
            $IN_INFO = "Wrong Username or Password. Please try again.";
            $goto = "index.php?info=".$IN_INFO;
        }
    }else{
        $IN_INFO = "Connection Error. Please try again later.";
        $goto = "index.php?info=".$IN_INFO;
    }
}else{
    $goto = "index.php";
}
echo "<br>".$goto;
mysqli_close($con);
header("location:".$goto);
die();
?>
