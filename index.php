<?php
session_start();
include ("DBconfig.php");
include("functions.php");
$message="";
if(isset($_GET["session_expired"])) {
	$message = "Login Session is Expired. Please Login Again";
}
else if(isset($_GET["invalid_password"])) {
	$message = "Invalid Username or Password!";
}
else if(isset($_GET["invalid_user_name"])){
    $message = 'Username already exist please try again.';
}
else if(isset($_GET["invalid_confirm_password"])){
    $message = 'Password and confirm password are note same please try again.';
}
else if(isset($_GET["invalid_error"])){
    $message = "ERROR: Could not able to execute! please try again.";
}
else if(isset($_GET["invalid_key"])){
    $message = "Invalid key";
}
?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="css/login.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="jquery.js"></script>
		<script src="js/jquery.min.js"></script>
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
        <script type="text/javascript">
            function show_signup(){
                $("#login_div").fadeOut('fast', function() {
                $("#register_div").fadeIn();
                });
            }
            function show_login(){
                $("#register_div").fadeOut('fast', function() {
                $("#login_div").fadeIn();
                });
            }
        </script>
	</head>
	<body>
            <div id="wrapper">
            <section id="login_div">
                <form action="login.php" method="post" >
                    <h1>LOG IN</h1>
                    <p><input name="user_name" required="required" type="text" placeholder="Enter Your Username"/></p>
                    <p><input name="password" required="required" type="password" placeholder="************" /></p>
                    <p><input type="submit" value="DO LOGIN"/></p>
                    <p class="change_link">Not a member yet ?<input type="button" onclick="show_signup();" value="Join us"></p>
                    <?php if($message!="") { ?>
        	            <p class="change_link" style="color: red;"><?php echo $message; ?></p>
                    <?php } ?>
                </form>
            </section>
            <section id="register_div">
                <form action="register.php" method="post" >
                    <h1>SIGN UP</h1>
                    <p><input name="user_name" required="required" type="text" placeholder="Enter Your Username"/></p>
                    <p><input name="email" required="required" type="email" placeholder="Enter Your Email"/></p>
                    <p><input name="password" required="required" type="password" placeholder="*********"/> </p>
                    <p><input name="password_confirm" required="required" type="password" placeholder="*********"/></p>
                    <p><input name="key" required="required" type="text" pattern="[A-Za-z0-9]{4}[-]{1}[A-Za-z0-9]{4}[-]{1}[A-Za-z0-9]{4}[-]{1}[A-Za-z0-9]{4}" placeholder="xxxx-xxxx-xxxx-xxxx" fo/></p>
                    <p><input type="submit" value="DO SIGN UP"/></p>
                    <p class="change_link">Already a member ?<input type="button" onclick="show_login();" value="Log in"></p>
                    <?php if($message!="") { ?>
                        <p class="change_link" style="color: red;"><?php echo $message; ?></p>
        			<?php } ?>
                </form>
            </section>
            </div>
	</body>
</html>
