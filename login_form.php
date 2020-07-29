<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="js/bootstrap.min.js"></script>
		<script src="lib/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="css/login_form.css">
		<script>
		function check(){
			var company_name=document.forms["RegForm"]["company_name"];
			var phone_no_1=document.forms["RegForm"]["phone_no_1"];
			var phone_no_2=document.forms["RegForm"]["phone_no_2"];
			var gstin_no=document.forms["RegForm"]["gstin_no"];
			var pan_no=document.forms["RegForm"]["pan_no"];
			var email=document.forms["RegForm"]["email"];
			var bank_name=document.forms["RegForm"]["bank_name"];
			var bank_branch_name=document.forms["RegForm"]["bank_branch_name"];
			var bank_ac_number=document.forms["RegForm"]["bank_ac_number"];
			var ifsc_code=document.forms["RegForm"]["ifsc_code"];
			var regx = /^[a-zA-Z ]+$/;
			var numx = /^[0-9]+$/;
			var gstx = /^[A-Z0-9]+$/;
			if(regx.test(company_name.value) == false){
				document.getElementById('model_id').innerHTML="Company name must be in letters only";
				$('#exampleModal').modal({
								show : true
							});
				company_name.focus();
				return false;
			}
			if (email.value != ""){
				if (email.value.indexOf("@", 0) < 0){
					window.alert("Please enter a valid e-mail address.");
					email.focus();
					return false;
				}
				if (email.value.indexOf(".", 0) < 0){
					window.alert("Please enter a valid e-mail address.");
					email.focus();
					return false;
				}
			}
			if (phone_no_1.value != ""){
				if(numx.test(phone_no_1.value) == false){
					alert("Phone number must be in numbers only in 10 digits");
					phone_no_1.focus();
					return false;
				}
				if(phone_no_1.value.length != 10){
					alert("Please enter valid phone number.");
					phone_no_1.focus();
					return false;
				}
			}
			if (phone_no_2.value != ""){
				if(numx.test(phone_no_2.value) == false){
					alert("Phone number must be in numbers only in 10 digits");
					phone_no_2.focus();
					return false;
				}
				if(phone_no_2.value.length != 10){
					alert("Please enter valid phone number.");
					phone_no_2.focus();
					return false;
				}
			}
			if (gstin_no.value != ""){
				if(gstx.test(gstin_no.value) == false){
					alert("GSTIN number not in valid form.");
					gstin_no.focus();
					return false;
				}
			}
			if (pan_no.value != ""){
				if(gstx.test(pan_no.value) == false){
					alert("PAN number not in valid form.");
					pan_no.focus();
					return false;
				}
			}
			if (bank_name.value != ""){
				if(regx.test(bank_name.value) == false){
					alert("Bank name not in valid form.");
					bank_name.focus();
					return false;
				}
			}
			if (bank_branch_name.value != ""){
				if(regx.test(bank_branch_name.value) == false){
					alert("Bank branch name not in valid form.");
					bank_branch_name.focus();
					return false;
				}
			}
			if (bank_ac_number.value != ""){
				if(numx.test(bank_ac_number.value) == false){
					alert("Please enter valid bank account number.");
					bank_ac_number.focus();
					return false;
				}
			}
			if (ifsc_code.value != ""){
				if(gstx.test(ifsc_code.value) == false){
					alert("Please enter valid bank IFSC number.");
					ifsc_code.focus();
					return false;
				}
			}
			return true;
		}
		</script>
	</head>
	<body>
		<div class="container contact">
			<div class="row">
				<div class="col-md-2">
					<div class="contact-info">
						<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
						<h3><?php if(!empty($_REQUEST['Message']))
									echo $_REQUEST['Message']; ?></h3>
					</div>
				</div>
				<div class="col-md-9">
				<form class="" action="DBOperation.php?Message=<?php echo $_REQUEST['Message']?>&log1=1" method="post" onsubmit="return check()" name="RegForm">
					<div class="contact-form">
						<div class="form-group">
						  <label class="control-label col-sm-10" for="company_name" >Company Name:<span id="requ">&nbsp*</span></label>
						  <div class="col-sm-10">
							<input type="text" required class="form-control" id="company_name"  placeholder="Enter Company Name." name="company_name">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="addr">Company Address:<span id="requ">&nbsp*</span></label>
						  <div class="col-sm-10">
							<textarea class="form-control" required placeholder="Enter company address." rows="5" id="addr" name="addr"></textarea>
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="phone_no_1" >Phone No. 1:<span id="requ">&nbsp*</span></label>
						  <div class="col-sm-10">
							<input type="text" required class="form-control" id="phone_no_1" placeholder="Phone number." name="phone_no_1">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="phone_no_2" >Phone No. 2:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="phone_no_2" placeholder="Phone number." name="phone_no_2">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="gstin_no" >GSTIN number:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="gstin_no" placeholder="Enter GSTIN number." name="gstin_no">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="pan_no" >PAN number:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="pan_no" placeholder="Enter PAN number." name="pan_no">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" for="email">Email:</label>
						  <div class="col-sm-10">
							<input type="email" class="form-control" id="email" placeholder="Enter email." name="email">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="bank_name">Bank name:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="bank_name" placeholder="Enter bank name." name="bank_name">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="bank_branch_name">Bank branch name:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="bank_branch_name" placeholder="Enter bank branch name." name="bank_branch_name">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="bank_ac_number">Bank A/C No:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="bank_ac_number" placeholder="Enter bank A/C no," name="bank_ac_number">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-10" for="ifsc_code.">Bank IFSC code:</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" id="ifsc_code" placeholder="Enter Bank IFSC code." name="ifsc_code">
						  </div>
						</div>
						<div class="form-group">
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Submit</button>
						  </div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>

</body>
</html>
