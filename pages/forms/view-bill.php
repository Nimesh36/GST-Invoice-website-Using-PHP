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
        .details{
            font-size: 14px;
        }
	</style>
</head>
<body onload="onload_fun()">
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
                     <h1 class="mdc-card__title mdc-card__title--large">Invoice No. <span id="invoice_no"></span></h1>
                   </section>
                 </div>
               </div>
			   <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                 <div class="mdc-card">
                   <section class="mdc-card__primary">
                     <h1 class="mdc-card__title mdc-card__title--large">Product details</h1>
                   </section>
				   <section class="mdc-card__supporting-text">
					   <div class="mdc-layout-grid__inner">
						   <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
							 <div class="template-demo">
							   <div id="demo-tf-box-wrapper">
			                <table class="table" style="width: 90%; margin: 0px 20px 0px 35px; ">
								<thead>
		  							<th style="text-align: left;">Description</th>
		  							<th>HSN</th>
		  							<th>Taka No.</th>
		  							<th>Quantity</th>
									<th>Rate</th>
 									<th>Amount</th>
  								</thead>
								<tbody>
											<?php
											include ("../../DBconfig.php");
											$sub_total = 0.0;
											$cust_id = 0;
											$qty_total = 0.0;
											$user_name = $_SESSION["user_name"];
											$sql = "SELECT * FROM bill_data WHERE username = '$user_name';";
							              	$result = mysqli_query($conn, $sql);
							              	if (mysqli_num_rows($result) > 0) {
							                  	while($row = mysqli_fetch_assoc($result)){
													$id = $row['product_id'];
													$sql = "SELECT product_name, hsn_no FROM products WHERE username = '$user_name' and product_id = $id;";
													$result_ = mysqli_query($conn, $sql);
													if (mysqli_num_rows($result_) > 0) {
									                  	$row_ = mysqli_fetch_assoc($result_);
													?>
													<tr>
														<td style="text-align: left;"><?php echo $row_['product_name'];?></td>
														<td><?php if($row_['hsn_no']){echo $row_['hsn_no'];}else{echo '-';}?></td>
														<td><?php if($row['taka_no']){echo $row['taka_no'];}else{echo '-';}?></td>
														<td><?php echo $row['quantity'];?></td>
														<td><?php echo $row['rate'];?></td>
														<td><?php echo floatval($row['quantity']) * floatval($row['rate']);?></td>
													</tr>
													<?php
													$sub_total+=(floatval($row['quantity']) * floatval($row['rate']));
													$qty_total+=floatval($row['quantity']);
													$cust_id = $row['cust_id'];
													}
												}
							              	}
											mysqli_close($conn);
											?>
								   		</tbody>
			                </table>
						</div>
					</div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>Sub Total : </b><span><?php $sub_total = round($sub_total, 2); echo $sub_total;?></span></p>
					</div>
				  </div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>Total quantity : </b><span><?php echo $qty_total;?></span></p>
					</div>
				  </div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>CGST(2.5%) : </b><span><?php $cgst = round($sub_total*0.025, 2); echo $cgst;?></span></p>
					</div>
				  </div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>SGST(2.5%) : </b><span><?php $sgst = round($sub_total*0.025, 2); echo $sgst; ?></span></p>
					</div>
				  </div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>Grand Total : </b><span><?php $grand_total = ($sub_total + $cgst + $sgst); $round_off = round($grand_total-round($grand_total), 2); $grand_total = round($grand_total); echo $grand_total; ?></span></p>
					</div>
				  </div>
				</div>
				<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
				  <div class="template-demo">
					<div id="demo-tf-box-wrapper">
						<p class="control-label col-sm-10 details"><b>Round off : </b><span><?php if($round_off<0){$round_off*=-1;}echo $round_off;?></span></p>
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
                     <h1 class="mdc-card__title mdc-card__title--large">Company details</h1>
                   </section>
                   <section class="mdc-card__supporting-text">
                       <div class="mdc-layout-grid__inner">
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Company Name : </b><span id="company_name"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Phone No. 1 : </b><span id="company_phone_no_1"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Phone No. 2 : </b><span id="company_phone_no_2"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Company Address : </b><span id="company_addr"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Email : </b><span id="company_email"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>GSTIN number : </b><span id="company_gstin_no"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>PAN number : </b><span id="company_pan_no"></span></p>
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
                     <h1 class="mdc-card__title mdc-card__title--large">Customer details</h1>
                   </section>
                   <section class="mdc-card__supporting-text">
                       <div class="mdc-layout-grid__inner">
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Customer Id : </b><span id="customer_id"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Customer Name : </b><span id="customer_name"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Phone No. : </b><span id="customer_phone_no"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Place of supply : </b><span id="place_of_supply"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Customer Address : </b><span id="customer_addr"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>GSTIN number : </b><span id="customer_gstin_no"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>PAN number : </b><span id="customer_pan_no"></span></p>
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
                     <h1 class="mdc-card__title mdc-card__title--large">Bank details</h1>
                   </section>
                   <section class="mdc-card__supporting-text">
                       <div class="mdc-layout-grid__inner">
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Bank Name : </b><span id="bank_name"></span></p>
                               </div>
                             </div>
                           </div>
						   <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Branch Name : </b><span id="branch_name"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>Account No. : </b><span id="account_no"></span></p>
                               </div>
                             </div>
                           </div>
                           <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                             <div class="template-demo">
                               <div id="demo-tf-box-wrapper">
                                   <p class="control-label col-sm-10 details"><b>IFSC Code : </b><span id="ifsc"></span></p>
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
                                    <a id="anchor_id" href="../../dashboard.php">
                                    <input type="button" id="next_button" style="width: 100px;" value="save" onclick="save();" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                    </a>
                                </div>
                          </div>
                      </div>
                      </div>
					  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                        <div class="template-demo">
                          <div id="demo-tf-box-wrapper">
                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                    <a id="view_id" target="_blank">
                                    <input type="button" id="next_button" style="width: 100px;" value="view" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                    </a>
                                </div>
                          </div>
                      </div>
                      </div>
					  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                        <div class="template-demo">
                          <div id="demo-tf-box-wrapper">
                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                    <a href="../../dashboard.php">
                                    <input type="button" id="cancel_button" style="width: 100px;" value="cancel" onclick="cancel();" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
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
	      <div class="modal-body" id="model_id">dvavsd
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script>
		function onload_fun(){
			var company_name = document.getElementById('company_name');
			var company_phone_no_1 = document.getElementById('company_phone_no_1');
			var company_phone_no_2 = document.getElementById('company_phone_no_2');
			var company_addr = document.getElementById('company_addr');
			var company_email = document.getElementById('company_email');
			var company_gstin_no = document.getElementById('company_gstin_no');
			var company_pan_no = document.getElementById('company_pan_no');
			var bank_name = document.getElementById('bank_name');
			var branch_name = document.getElementById('branch_name');
			var account_no = document.getElementById('account_no');
			var ifsc = document.getElementById('ifsc');
			var customer_id = document.getElementById('customer_id');
			var customer_name = document.getElementById('customer_name');
			var customer_phone_no = document.getElementById('customer_phone_no');
			var customer_addr = document.getElementById('customer_addr');
			var customer_gstin_no = document.getElementById('customer_gstin_no');
			var customer_pan_no = document.getElementById('customer_pan_no');
			var place_of_supply = document.getElementById('place_of_supply');
			var invoice_no = document.getElementById('invoice_no');
			<?php
				include ("../../DBconfig.php");
				$user_name = $_SESSION["user_name"];
				$sql = "SELECT * FROM user_detail WHERE username = '$user_name';";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					?>
					company_name.innerHTML = "<?php echo $row['company_name'];?>";
					company_phone_no_1.innerHTML = "<?php echo $row['phone_no_1'];?>";
					company_phone_no_2.innerHTML = "<?php echo $row['phone_no_2'];?>";
					company_addr.innerHTML = "<?php echo $row['addr'];?>";
					company_email.innerHTML = "<?php echo $row['email'];?>";
					company_gstin_no.innerHTML = "<?php echo $row['gstin_no'];?>";
					company_pan_no.innerHTML = "<?php echo $row['pan_no'];?>";
					bank_name.innerHTML = "<?php echo $row['bank_name'];?>";
					branch_name.innerHTML = "<?php echo $row['bank_branch_name'];?>";
					account_no.innerHTML = "<?php echo $row['bank_ac_number'];?>";
					place_of_supply.innerHTML = "<?php echo $_POST['place_of_supply'];?>";
					ifsc.innerHTML = "<?php echo $row['ifsc_code'];?>";
					if(place_of_supply.innerHTML==""){
						place_of_supply.innerHTML="-";
					}
					if(bank_name.innerHTML==""){
						bank_name.innerHTML="-";
					}
					if(branch_name.innerHTML==""){
						branch_name.innerHTML="-";
					}
					if(account_no.innerHTML==""){
						account_no.innerHTML="-";
					}
					if(ifsc.innerHTML==""){
						ifsc.innerHTML="-";
					}
					if(company_addr.innerHTML==""){
						company_addr.innerHTML="-";
					}
					if(company_phone_no_2.innerHTML==""){
						company_phone_no_2.innerHTML="-";
					}
					if(company_phone_no_1.innerHTML==""){
						company_phone_no_1.innerHTML="-";
					}
					if(company_email.innerHTML==""){
						company_email.innerHTML="-";
					}
					if(company_gstin_no.innerHTML==""){
						company_gstin_no.innerHTML="-";
					}
					if(company_pan_no.innerHTML==""){
						company_pan_no.innerHTML="-";
					}
					<?php
				}
				$sql = "SELECT * FROM customers WHERE username = '$user_name' and cust_id = '$cust_id';";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					?>
					customer_id.innerHTML = "<?php echo $cust_id;?>";
					customer_name.innerHTML = "<?php echo $row['customer_name'];?>";
					customer_phone_no.innerHTML = "<?php echo $row['phone_no'];?>";
					customer_addr.innerHTML = "<?php echo $row['addr'];?>";
					customer_gstin_no.innerHTML = "<?php echo $row['gstin_no'];?>";
					customer_pan_no.innerHTML = "<?php echo $row['pan_no'];?>";
					<?php
				}
			$sql = "SELECT MAX(invoice_no) invoice_no FROM bill_list WHERE username = '$user_name'; ";
			$invoice_no = "";
	        $result = mysqli_query($conn, $sql);
	        if (mysqli_num_rows($result) > 0) {
	            $row = mysqli_fetch_assoc($result);
	            if($row['invoice_no']==""){
	                $invoice_no = "AA001";
				}
	            else {
					$invoice_no = $row['invoice_no'];
					if(ord($invoice_no[4])!=ord('9')){
	                	$invoice_no = substr($invoice_no, 0, 4) . chr(ord($invoice_no[4])+1);
					}
					else if(ord($invoice_no[3])!=ord('9')){
						$invoice_no = substr($invoice_no, 0, 3) . chr(ord($invoice_no[3])+1) . '0';
					}
					else if(ord($invoice_no[2])!=ord('9')){
						$invoice_no = substr($invoice_no, 0, 2) . chr(ord($invoice_no[2])+1) . '00';
					}
					else if(ord($invoice_no[1])!=ord('Z')){
						$invoice_no = $invoice_no[0] . chr(ord($invoice_no[1])+1) . '000';
					}
					else if(ord($invoice_no[0])!=ord('Z')){
						$invoice_no = chr(ord($invoice_no[0])+1) . 'A000';
					}
					else{
						$invoice_no = "AA001";
					}
	            }
	        }
			mysqli_close($conn);
			?>
			invoice_no.innerHTML = "<?php echo $invoice_no;?>";
			document.getElementById('view_id').setAttribute("href", "create-bill.php?subtotal=<?php echo $sub_total;?>&grandtotal=<?php echo $grand_total;?>&roundoff=<?php echo $round_off;?>&invoice_no=<?php echo $invoice_no;?>&place_of_supply=<?php echo $_POST['place_of_supply'];?>");
		}
		function cancel(){
			$.ajax({
				type: "POST",
				url: '../../DBOperation.php',
				data:{Message:'<?php echo $_SESSION["user_name"];?>', log16: 1},
				success:function(html) {
					if(html!=''){
						document.getElementById('model_id').innerHTML="Unable to cancel";
						$('#exampleModal').modal({show : true});
					}
				}
			});
		}
		function save(){
			$.ajax({
				type: "POST",
				url: '../../DBOperation.php',
				data:{Message:'<?php echo $_SESSION["user_name"];?>', subtotal: '<?php echo $sub_total;?>', grandtotal: '<?php echo $grand_total;?>', roundoff: '<?php echo $round_off;?>', invoice_no: '<?php echo $invoice_no;?>', place_of_supply: '<?php echo $_POST['place_of_supply'];?>', log14: 1},
				success:function(html) {
					if(html!=''){
						document.getElementById('model_id').innerHTML="Unable to save";
						$('#exampleModal').modal({show : true});
					}
				}
			});
		}
	</script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
	<script src="../../js/dialog.js"></script>
    <script src="../../js/material.js"></script>
</body>
</html>
