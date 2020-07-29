<?php
session_start();
include("../../functions.php");
if(isset($_SESSION["user_name"])){
	if(isLoginSessionExpired()){
		header("Location:../../logout.php?session_expired=1");
	}
}
else{
	header("Location:../404.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="../../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../../css/login_form.css">
    <link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/style.css">
  	<script src="../../js/jquery.min.js"></script>
  	<script src="../../js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="../../css/semantic.min.css">
  	<link rel="stylesheet" href="../../css/dataTables.semanticui.min.css">
  	<script src="../../js/jquery.dataTables.min.js"></script>
  	<script src="../../js/dataTables.semanticui.min.js"></script>
  	<script src="../../js/popper.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/gijgo.min.js" type="text/javascript"></script>
    <link href="../../css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<style>
		th, td{
			text-align: left; vertical-align: top; font-size: 15px;
		}
	    .details{
	        font-size: 14px;
		}
		#example_processing{
			background-color: gray;
			color: #fff;
        }
	</style>

</head>
<body onload="onload_fun();">
  	<div class="body-wrapper">
    	<header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
      		<div class="mdc-toolbar__row">
		  		<section class="mdc-toolbar__section mdc-toolbar__section--align-start">
			  		<div class="mdc-menu-anchor">
						<a href="javascript:history.go(-1)" title="Return to the previous page" style="text-decoration: none;" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
							<i class="material-icons">arrow_back</i>
						</a>
			  		</div>
			  		<div class="mdc-menu-anchor">
                		<a href="../../dashboard.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" style="text-decoration: none;" data-mdc-auto-init="MDCRipple">
                  			<i class="material-icons">dashboard</i>
                		</a>
              		</div>
          		</section>
        		<section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
          			<div class="mdc-menu-anchor">
            			<a href="selected-product-list.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" style="text-decoration: none;" data-mdc-auto-init="MDCRipple">
              				<i class="material-icons">shopping_cart</i>
              				<span class="dropdown-count" id="span_quantity">
							<?php
							include ("../../DBconfig.php");
							$user_name = $_SESSION["user_name"];
							$sql = "SELECT COUNT(id) count FROM bill_data WHERE username = '$user_name';";
			              	$result = mysqli_query($conn, $sql);
			              	if (mysqli_num_rows($result) > 0) {
			                  	$row = mysqli_fetch_assoc($result);
			                  	echo $row["count"];
			              	}else {
			                  	echo "0";
			              	}
							mysqli_close($conn);
							?>
					  		</span>
            			</a>
          			</div>
          			<div class="mdc-menu-anchor mr-1">
            			<a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" style="text-decoration: none;" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
              				<i class="material-icons">more_vert</i>
            			</a>
            			<div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                			<ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                    			<a href="../../logout.php" style = "text-decoration:none; color:black;">
                  					<li class="mdc-list-item" role="menuitem" tabindex="0">
                    					<i class="material-icons mdc-theme--primary mr-1">power_settings_new</i>
                    					Logout
                  					</li>
								</a>
                			</ul>
            			</div>
          			</div>
        		</section>
      		</div>
    	</header>
    	<div class="page-wrapper mdc-toolbar-fixed-adjust">
        	<div class="mdc-layout-grid">
          		<div class="mdc-layout-grid__inner">
			  		<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
						<div class="mdc-card">
				  			<section class="mdc-card__primary">
								<h1 class="mdc-card__title mdc-card__title--large">Selected  bills :</h1>
				  			</section>
						</div>
			  		</div>
            		<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              			<div class="mdc-card">
                			<section class="mdc-card__supporting-text">
                    			<div class="mdc-layout-grid__inner">
                        			<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                          				<div class="template-demo">
                            				<div id="demo-tf-box-wrapper">
                                				<div class="container">
                                    				<table id="example" class="ui celled table" style="width:100%">
                                        				<thead>
                                            				<tr>
																<th style="text-align: center; vertical-align: inherit; font-size: 15px;">Bill Id.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Invoice No.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Customer Name.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Customer Address.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Sub Total.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Grand Total.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Date.</th>
															    <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Time.</th>
																<th></th>
                                            				</tr>
                                        				</thead>
                                    				</table>
                                				</div>
                            				</div>
                          				</div>
                        			</div>
                    			</div>
                			</section>
            			</div>
        			</div>
					<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
		  				<div class="mdc-card">
							<section class="mdc-card__primary">
			  					<h1 class="mdc-card__title mdc-card__title--large">Select date</h1>
							</section>
							<section class="mdc-card__supporting-text">
								<div class="mdc-layout-grid__inner">
									<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
					  					<div class="template-demo">
											<div id="demo-tf-box-wrapper">
												<p class="control-label col-sm-10 details"><b>From</b></p>
											</div>
					  					</div>
									</div>
									<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
					  					<div class="template-demo">
											<div id="demo-tf-box-wrapper">
												<p class="control-label col-sm-10 details"><b>To</b></p>
											</div>
					  					</div>
									</div>
									<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
					  					<div class="template-demo">
											<div id="demo-tf-box-wrapper">
												<p class="control-label col-sm-10 details"><input id="datepicker_from"  width="276" readonly onchange="change_event();"/></p>
											</div>
					  					</div>
									</div>
									<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
					  					<div class="template-demo">
											<div id="demo-tf-box-wrapper">
												<p class="control-label col-sm-10 details"><input id="datepicker_to" width="276" readonly onchange="change_event();" /></p>
											</div>
					  					</div>
									</div>
								</div>
							</section>
		  				</div>
					</div>
    			</div>
			</div>
			<main class="content-wrapper">
	    	<?php include("../../partials/_footer.php"); ?>
			</main>
	    </div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel">oops!</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<div class="modal-body" id="model_id"></div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
	  	</div>
	</div>
	<script>
	function delete_onclick(obj) {
		id = obj.parentNode.parentNode.parentNode.parentNode.children[0].innerHTML;
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', id: id, log22: 1},
			success:function(html) {
				if(html!=""){
					document.getElementById('model_id').innerHTML="Unable to delete.";
					$('#exampleModal').modal({ show : true });
				}
				else {
					change_event();
				}
			}
		});
	}
	function open_onclick(obj) {
		id = obj.parentNode.parentNode.parentNode.parentNode.children[0].innerHTML;
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', id: id, log21: 1},
			success:function(html) {
				if(html){
					window.open(html, "_blanck");
				}else {
					document.getElementById('model_id').innerHTML="Unable to open.";
					$('#exampleModal').modal({ show : true });
				}
			}
		});
	}
	function onload_fun() {
		obj = document.getElementById('datepicker_to');
		var fullDate = new Date()
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
		obj.value = currentDate;
		var obj_ = document.getElementById('datepicker_from');
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', log17: 1},
			success:function(html) {
				if(html!=""){
					obj_.value = html;
				}
				else {
					obj_.value = currentDate;
				}
			}
		});
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', log18: 1},
			success:function(html) {
				if(html=='No data found'){
					$('#example').dataTable().fnClearTable();
				}
				else {
					$('#example').DataTable().ajax.url( '../../json/json_file.json' ).load();
				}
			}
		});
	}
	</script>
    <script>
        $(document).ready(function(){
			$('#example').DataTable({
                  processing: true,
				 "columns"     :     [
					  {     "data"     :     "bill_id"     },
					  {     "data"     :     "invoice_no"},
					  {     "data"     :     "customer_name"     },
					  {     "data"     :     "addr"},
					  {     "data"     :     "sub_total"     },
					  {     "data"     :     "grand_total"},
					  {     "data"     :     "date"     },
					  {     "data"     :     "time"},
					  {     "data"     :     "data"}
				 ]
			});
			$('tr').hover(function(){
				$(this).css("background-color", "#EEEEEE");;
            },function () {
				$(this).css("background-color", "white");;
            });
        });
		function change_event() {
			var from_obj = document.getElementById('datepicker_from');
			var to_obj = document.getElementById('datepicker_to');
			$.ajax({
				type: "POST",
				url: '../../DBOperation.php',
				data:{Message:'<?php echo $_SESSION["user_name"];?>', from: from_obj.value, to: to_obj.value, log18: 1},
				success:function(html) {
					if(html=='No data found'){
						$('#example').dataTable().fnClearTable();
					}
					else {
						$('#example').DataTable().ajax.url( '../../json/json_file.json' ).load();
					}
				}
			});
		}
    </script>
	<script>
        $('#datepicker_from').datepicker({
            uiLibrary: 'bootstrap4',
			format: "dd/mm/yyyy"
        });
		$('#datepicker_to').datepicker({
            uiLibrary: 'bootstrap4',
			format: "dd/mm/yyyy"
        });
    </script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
	<script src="../../js/dialog.js"></script>
	<script src="../../js/material.js"></script>
	
</body>
</html>
