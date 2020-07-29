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
    $pass = test_input($_REQUEST['password']);
    $sql = "SELECT * FROM users WHERE users.username='$uname' AND users.pass='$pass'";
    if ($res = mysqli_query($conn, $sql))
        if (mysqli_num_rows($res) > 0){
            $_SESSION["user_name"] = $_POST["user_name"];
    		$_SESSION['loggedin_time'] = time();
        }
        else
            header("Location:logout.php?invalid_password=1");
    else
        header("Location:logout.php?invalid_error=1");
}
mysqli_close($conn);
if(isset($_SESSION["user_name"])) {
	if(!isLoginSessionExpired()) {
		header("Location:dashboard.php");
	} else {
		header("Location:logout.php?session_expired=1");
	}
}
else{
    header("Location:logout.php?invalid_password=1");
}
?>
