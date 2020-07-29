<?php
session_start();
include ("DBconfig.php");
include("functions.php");
$message="";
if(count($_POST)>0) {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = test_input($_REQUEST['user_name']);
    $email = test_input($_REQUEST['email']);
    $pass = test_input($_REQUEST['password']);
    $pass_conf = test_input($_REQUEST['password_confirm']);
    $key = test_input($_REQUEST["key"]);
    if($pass == $pass_conf){
        $sql = "SELECT id_no FROM keys_ WHERE keys_.key_val='$key' AND keys_.valid!=0";
        if($res_key = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($res_key)){
                $sql = "SELECT * FROM users WHERE users.username='$uname'";
                if ($res = mysqli_query($conn, $sql)){
                    if (mysqli_num_rows($res) > 0){
                        header("Location:logout.php?invalid_user_name=1");}
                    else{
                        $id_no = mysqli_fetch_assoc($res_key)['id_no'];
                        $sql = "UPDATE keys_ SET valid = '0' WHERE keys_.id_no = $id_no;";
                        if ($res = mysqli_query($conn, $sql)){
                            $sql = "INSERT INTO users (username, email, pass, key_id) VALUES ('$uname', '$email', '$pass', $id_no);";
                            if ($res = mysqli_query($conn, $sql)){
                                $_SESSION["user_name"] = $_POST["user_name"];
                                $_SESSION['loggedin_time'] = time();
                            }
                            else{
                                header("Location:logout.php?invalid_error=1");}
                        }
                        else{
                            header("Location:logout.php?invalid_error=1");}
                    }
                }
                else{
                    header("Location:logout.php?invalid_error=1");}
            }
            else{
                header("Location:logout.php?invalid_key=1");}
        }
        else{
            header("Location:logout.php?invalid_error=1");}
    }
    else{
        header("Location:logout.php?invalid_confirm_password=1");}
}
    mysqli_close($conn);
    if(isset($_SESSION["user_name"])) {
    	if(!isLoginSessionExpired()) {
    		header("Location:login_form.php?Message={$_SESSION["user_name"]}");
    	} else {
    		header("Location:logout.php?session_expired=1");
    	}
    }
?>
