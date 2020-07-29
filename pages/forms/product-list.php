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
      <!-- <script src="../../js/semantic.min.js"></script> -->
      <script src="../../js/popper.min.js"></script>
	<style>
		th, td{
			text-align: left; vertical-align: top; font-size: 15px;
		}
	</style>
</head>
<body>
  <div class="body-wrapper">
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
      <div class="mdc-toolbar__row">
		  <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
			  <div class="mdc-menu-anchor">
				<a href="javascript:history.go(-1)" title="Return to the previous page" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
					<i class="material-icons">arrow_back</i>
				</a>
			  </div>
			  <div class="mdc-menu-anchor">
                <a href="../../dashboard.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
                  <i class="material-icons">dashboard</i>
                </a>
              </div>
          </section>
        <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
          <div class="mdc-menu-anchor">
            <a href="selected-product-list.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
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
            <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
              <i class="material-icons">more_vert</i>
            </a>
            <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                    <a href="../../logout.php" style = "text-decoration:none; color:black;">
                  <li class="mdc-list-item" role="menuitem" tabindex="0">
                    <i class="material-icons mdc-theme--primary mr-1">power_settings_new</i>
                    Logout
                  </li></a>
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
					<h1 class="mdc-card__title mdc-card__title--large">Select Product :</h1>
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
                                                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Id.</th>
                				                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Name.</th>
                				                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Available Quantity.</th>
														<th style="text-align: center; vertical-align: inherit; font-size: 15px;">Quentity.</th>
														<th style="text-align: center; vertical-align: inherit; font-size: 15px;">TAKA No.</th>
														<th style="text-align: center; vertical-align: inherit; font-size: 15px;">Rate.</th>
                				                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Dealer name.</th>
														<th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
            				                        if(isset($_SESSION["user_name"])) {
            				                            include ("../../DBconfig.php");
            				                            $user_name = $_SESSION["user_name"];
            				                            $sql = "SELECT * FROM products where username = '$user_name';";
            				                            $result = mysqli_query($conn, $sql);
            				                            if (mysqli_num_rows($result) > 0){
            				                                while($row = mysqli_fetch_assoc($result)){
																$product_id = $row['product_id'];
																$sql_ = "SELECT SUM(quantity) quantity FROM bill_data where username = '$user_name' AND product_id = $product_id;";
																$result_ = mysqli_query($conn, $sql_);
		            				                            if (mysqli_num_rows($result_) > 0){
		            				                                $row_ = mysqli_fetch_assoc($result_);
																	echo "<tr>" .
            				                                        " <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\">$row[product_id]</td>" .
            				                                        " <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\">$row[product_name]</td>" .
            				                                        " <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\">" . (((float)$row['available_quantity'])-((float)$row_['quantity'])) . "</td>" .
																	" <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\"><input type='text' class='form-control' id='quantity' style='width:60px' placeholder='Quantity' onfocus='onfocus_fun(this);' onfocusout='onfocusout_fun(this);' name='quantity' value='0'></td>" .
																	" <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\"><input type='text' class='form-control' id='taka_no' style='width:60px' placeholder='TAKA No.' name='taka_no'></td>" .
																	" <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\"><input type='text' class='form-control' id='rate' style='width:60px' placeholder='Rate' name='quantity' value=" . $row['rate'] . "></td>" .
																	" <td style=\"text-align: left; vertical-align: inherit; font-size: 15px;\">$row[dealer_name]</td>" .
																	" <td><div id='demo-tf-box-wrapper'><div class='mdc-list-item mdc-drawer-item purchase-link' ><button onclick='addToCart(this)' class='mdc-button mdc-button--raised mdc-button--dense mdc-ripple-upgraded' data-mdc-auto-init='MDCRipple' style='--mdc-ripple-fg-size:44.925px;height:35px; width: 110px; --mdc-ripple-fg-scale:2.03509; --mdc-ripple-fg-translate-start:21.9125px, -4.86249px; --mdc-ripple-fg-translate-end:14.975px, -6.4625px;'>Add To Cart</button></div></div></td>" . "</tr>";
            				                                    }
															}
														}
            				                            mysqli_close($conn);
            				                        }
            				                        ?>
                                                </tbody>
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
              <section class="mdc-card__supporting-text">
                  <div class="mdc-layout-grid__inner">
                      <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                        <div class="template-demo">
                          <div id="demo-tf-box-wrapper">
                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                    <a href="selected-product-list.php">
                                    	<input type="button" style="width: 100px;" value="next" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                    </a>
                                </div>
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
</main>    </div>
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
	      <div class="modal-body" id="model_id">dvavsd
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script>
		function onfocus_fun(obj){
			if(obj.value == "0"){
				obj.value = "";
			}
		}
			function onfocusout_fun(obj){
				if(obj.value == ""){
					obj.value = "0";
				}
			}
		function addToCart(obj){
			var trObj = obj.parentNode.parentNode.parentNode.parentNode;
			var available_quantity = trObj.children[2];
			var quantity = trObj.children[3].children[0];
			var taka_no = trObj.children[4].children[0];
			var rate = trObj.children[5].children[0];
			var numx = /^[0-9.]+$/;
			var flag = false;
			if (quantity.value != "" && quantity.value != "0"){
	            if(numx.test(quantity.value) == false){
					document.getElementById('model_id').innerHTML="quantity must be in numbers only.";
		    		  $('#exampleModal').modal({
		    						  show : true
		    					  });
		    		  quantity.focus();
	            }
				else if(parseFloat(quantity.value) > parseFloat(available_quantity.innerHTML)){
					document.getElementById('model_id').innerHTML=quantity.value + " not available.";
		    		  $('#exampleModal').modal({
		    						  show : true
		    					  });
		    		  quantity.focus();
				}
				else if (rate.value != "" && rate.value != "0"){
		            if(numx.test(rate.value) == false){
						document.getElementById('model_id').innerHTML="Rate must be in numbers only.";
			    		  $('#exampleModal').modal({
			    						  show : true
			    					  });
			    		  rate.focus();
		            }
					else if((numx.test(taka_no.value) == false) && (taka_no.value != "")){
						document.getElementById('model_id').innerHTML="Taka number must be in numbers only.";
			    		  $('#exampleModal').modal({
			    						  show : true
			    					  });
			    		  taka_no.focus();
					}
					else{
						$.ajax({
							type: "POST",
							url: '../../DBOperation.php',
							data:{Message:'<?php echo $_SESSION["user_name"];?>', product_id: parseInt(trObj.children[0].innerHTML), quantity: quantity.value, rate: rate.value, taka_no: taka_no.value, log9: 1},
						  	success:function(html) {
								if(html==0){
									document.getElementById('model_id').innerHTML="Unable to add to cart.";
						    		  $('#exampleModal').modal({
						    						  show : true
						    					  });
								}
								else {
									document.getElementById('span_quantity').innerHTML = html;
									available_quantity.innerHTML = parseFloat(available_quantity.innerHTML) - parseFloat(quantity.value);
								}
							}
						});
					}
				}
				else{
					document.getElementById('model_id').innerHTML="Please enter rate.";
		    		  $('#exampleModal').modal({
		    						  show : true
		    					  });
		    		  rate.focus();
				}
	        }
			else {
				document.getElementById('model_id').innerHTML="Please enter quantity.";
	    		  $('#exampleModal').modal({
	    						  show : true
	    					  });
	    		  quantity.focus();
			}
		}
	</script>
    <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable();
			$('tr').hover(function () {
				$(this).css("background-color", "#EEEEEE");;
            },function () {
				$(this).css("background-color", "white");;
            }  );
        });
    </script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
	<script src="../../js/dialog.js"></script>
    <script src="../../js/material.js"></script>
</body>
</html>
