<?php
function isLoginSessionExpired() {
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_name"]) and ((time() - $_SESSION['loggedin_time']) > 900))
		return true;
	return false;
}
?>
