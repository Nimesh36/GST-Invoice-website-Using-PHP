<?php
session_start();
include("functions.php");
if(isset($_SESSION["user_name"])){
	if(isLoginSessionExpired()){
		header("Location:logout.php?session_expired=1");
	}
}
else{
	header("Location:pages/404.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
  	<link rel="stylesheet" href="node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="shortcut icon" href="images/favicon.png" />
  	<!-- <link rel="stylesheet" href="css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> -->
</head>
<body>
  	<div class="body-wrapper">
      	<?php include("partials/_sidebar.php"); ?>
      	<?php include("partials/_header.php"); ?>
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
      	<main class="content-wrapper">
        	<div class="mdc-layout-grid">
          		<div class="mdc-layout-grid__inner">
            		<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              			<div class="mdc-layout-grid__inner w-100">
                			<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                  				<div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
									<a href="pages/forms/product-list.php" style = "text-decoration:none; color:black;">
                    					<div class="mdc--tile mdc--tile-danger rounded">
                      						<i class="mdi mdi-account-settings text-white icon-md"></i>
                    					</div>
									</a>
	                    			<div class="text-wrapper pl-1">
	                      				<h3 class="mdc-typography--display1 font-weight-bold mb-1">New bill</h3>
	                      				<p class="font-weight-normal mb-0 mt-0"></p>
	                    			</div>
                  				</div>
                			</div>
                			<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
	                  			<div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
	                    			<div class="mdc--tile mdc--tile-success rounded">
	                      				<i class="mdi mdi-basket text-white icon-md"></i>
	                    			</div>
		                    		<div class="text-wrapper pl-1">
		                      			<h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php
							  				include ("DBconfig.php");
								 			$user_name = $_SESSION['user_name'];
								 			$date = date('Y-m-d');
								 			$date2 = date('Y-m-d', strtotime('-30 days'));
								 			$sql = "SELECT SUM(grand_total) amount FROM bill_list WHERE username = '$user_name' AND date <= '$date' AND date >= '$date2';";
								 			$result = mysqli_query($conn, $sql);
								 			if (mysqli_num_rows($result) > 0){
									 			$row = mysqli_fetch_assoc($result);
									 			echo "₹" . $row['amount'];
								 			}
								 			mysqli_close($conn);?></h3>
		                      			<p class="font-weight-normal mb-0 mt-0">Total Sales in last 30 days</p>
		                    		</div>
		                  		</div>
		                	</div>
		                	<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
		                  		<div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
									<a href="pages/forms/bill-checklist.php" style = "text-decoration:none; color:black;">
		                    			<div class="mdc--tile mdc--tile-warning rounded">
		                      				<i class="mdi mdi-ticket text-white icon-md"></i>
		                    			</div>
									</a>
		                    		<div class="text-wrapper pl-1">
		                      			<h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php
						  				include ("DBconfig.php");
						  				$user_name = $_SESSION['user_name'];
						  				$sql = "SELECT COUNT(bill_id) count FROM bill_list WHERE username = '$user_name';";
			              				$result = mysqli_query($conn, $sql);
			              				if (mysqli_num_rows($result) > 0){
			                  				$row = mysqli_fetch_assoc($result);
							  				echo $row['count'];
						  				}
						  				mysqli_close($conn);
						  				?></h3>
		                      			<p class="font-weight-normal mb-0 mt-0">Open Bills</p>
		                    		</div>
		                  		</div>
		                	</div>
		                	<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
		                  		<div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
									<a href="pages/forms/basic-forms.php" style = "text-decoration:none; color:black;">
		                    			<div class="mdc--tile mdc--tile-primary rounded">
		                      				<i class="mdi mdi-account-star text-white icon-md"></i>
		                    			</div>
									</a>
		                    		<div class="text-wrapper pl-1">
									<?php
			  					  		include ("DBconfig.php");
			  					  		$user_name = $_SESSION["user_name"];
			  					  		$sql = "SELECT email, company_name FROM user_detail where username = '$user_name';";
			  					  		$result = mysqli_query($conn, $sql);
			  					  		if (mysqli_num_rows($result) > 0){
			  						  		$row = mysqli_fetch_assoc($result); ?>
									<h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php echo $row["company_name"]?></h3>
			                      	<p class="font-weight-normal mb-0 mt-0">
										<?php
											echo $row['email'];
						          		}else{
											die(mysqli_error($conn));
										}
										mysqli_close($conn); ?></p>
	                    			</div>
                  				</div>
                			</div>
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
		                  		<div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
									<a href="pages/forms/bill-checklist.php" style = "text-decoration:none; color:black;">
		                    			<div class="mdc--tile mdc--tile-primary rounded" style="background: #633974;">
		                      				<i class="mdi mdi-check-all text-white icon-md"></i>
		                    			</div>
									</a>
		                    		<div class="text-wrapper pl-1">
		                      			<h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php
							  				include ("DBconfig.php");
								 			$user_name = $_SESSION['user_name'];
								 			$date = date('Y-m-d');
								 			$date2 = date('Y-m-d', strtotime('-30 days'));
								 			$sql = "SELECT bill_id FROM bill_list WHERE username = '$user_name' AND date <= '$date' AND date >= '$date2';";
								 			$result = mysqli_query($conn, $sql);
								 			if (mysqli_num_rows($result) > 0){
									 			$quantity = 0.0;
												while($row = mysqli_fetch_assoc($result)){
													$bill_id = $row['bill_id'];
													$sql_ = "SELECT quantity FROM billdetail WHERE bill_id = $bill_id;";
										 			$result_ = mysqli_query($conn, $sql_);
										 			if (mysqli_num_rows($result_) > 0){
											 			while($row_ = mysqli_fetch_assoc($result_)){
															$quantity += floatval($row_['quantity']);
														}
													}
												}
												echo round($quantity);
								 			}
								 			mysqli_close($conn);?>
										</h3>
		                      			<p class="font-weight-normal mb-0 mt-0">Total Product Seles in last 30 days</p>
		                    		</div>
		                  		</div>
		                	</div>
              			</div>
            		</div>
        		</div>
        	</div>
      	</main>
        <?php include("partials/_footer.php"); ?>
    </div>
  	</div>
  	<script src="node_modules/material-components-web/dist/material-components-web.min.js"></script>
  	<script src="node_modules/jquery/dist/jquery.min.js"></script>
  	<script src="js/misc.js"></script>
  	<script src="js/material.js"></script>
  	<script src="js/dashboard.js"></script>
</body>
</html>
