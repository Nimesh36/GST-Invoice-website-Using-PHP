<?php
session_start();
unset($_SESSION["user_name"]);
$url = "index.php";
if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}
else if(isset($_GET["invalid_password"])){
	$url .= "?invalid_password=" . $_GET["invalid_password"];
}
else if(isset($_GET["invalid_user_name"])){
	$url .= "?invalid_user_name=" . $_GET["invalid_user_name"];
}
else if(isset($_GET["invalid_confirm_password"])){
	$url .= "?invalid_confirm_password=" . $_GET["invalid_confirm_password"];
}
else if(isset($_GET["invalid_error"])){
	$url .= "?invalid_error=" . $_GET["invalid_error"];
}
else if(isset($_GET["invalid_key"])){
	$url .= "?invalid_key=" . $_GET["invalid_key"];
}
header("Location:$url");
?>
