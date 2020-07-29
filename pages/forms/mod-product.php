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
<?php
    if(isset($_SESSION["user_name"])&&isset($_REQUEST["product_id"])) {
        include ("../../DBconfig.php");
        $user_name = $_SESSION["user_name"];
        $product_id = $_REQUEST["product_id"];
        $sql = "SELECT * FROM products where username = '$user_name' and product_id = $product_id ;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../../css/login_form.css">
    <link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/style.css">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</head>
<body onload="onload_fun();">
  <div class="body-wrapper">
	  <aside class="mdc-persistent-drawer mdc-persistent-drawer--open">
  	  	<nav class="mdc-persistent-drawer__drawer">
  	  		<div class="mdc-persistent-drawer__toolbar-spacer">
  	  			<a href="../../dashboard.php" style="text-decoration: none;" class="brand-logo">
  	  				<img src="../../images/logo.png" alt="logo">
  	  			</a>
  	  		</div>
  	  		<div class="mdc-list-group">
  	  			<nav class="mdc-list mdc-drawer-menu" style="max-height: none; padding-bottom: 153%;">
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="../../dashboard.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">desktop_mac</i>
  	  						Dashboard
  	  					</a>
  	  				</div>
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="product-list.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grid_on</i>
  	  						New bill
  	  					</a>
  	  				</div>
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="bill-checklist.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">assignment</i>
  	  						Bill checklist
  	  					</a>
  	  				</div>
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="basic-forms.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
  	  						Company details
  	  					</a>
  	  				</div>
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="customer-forms.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">person_outline</i>
  	  						Customer details
  	  					</a>
  	  				</div>
  	  				<div class="mdc-list-item mdc-drawer-item">
  	  					<a class="mdc-drawer-link" href="product-forms.php">
  	  						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">layers</i>
  	  						Available products
  	  					</a>
  	  				</div>
  	  			</nav>
  	  		</div>
  	  	</nav>
  	</aside>
   	<header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
  	  	<div class="mdc-toolbar__row">
  	  		<section class="mdc-toolbar__section mdc-toolbar__section--align-start">
  	  			<a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
  	  		</section>
  	  		<section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
  	  			<div class="mdc-menu-anchor">
  					<a href="selected-product-list.php" style="text-decoration: none;" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
  		              <i class="material-icons">shopping_cart</i>
  		                <span class="dropdown-count" id="span_quantity">
  		                <?php
  		                include ("../../DBconfig.php");
  		                $user_name = $_SESSION["user_name"];
  		                $sql_ = "SELECT COUNT(id) count FROM bill_data WHERE username = '$user_name';";
  		                $result_ = mysqli_query($conn, $sql_);
  		                if (mysqli_num_rows($result_) > 0) {
  		                    $row_ = mysqli_fetch_assoc($result_);
  		                    echo $row_["count"];
  		                }else {
  		                    echo "0";
  		                }
  		                ?>
  		                </span>
  		            </a>
  	  				<div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">
  	  					<ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
  	  						<li class="mdc-list-item" role="menuitem" tabindex="0">
  	  							<i class="material-icons mdc-theme--primary mr-1">email</i>
  	  							One unread message
  	  						</li>
  	  						<li class="mdc-list-item" role="menuitem" tabindex="0">
  	  							<i class="material-icons mdc-theme--primary mr-1">group</i>
  	  							One event coming up
  	  						</li>
  	  						<li class="mdc-list-item" role="menuitem" tabindex="0">
  	  							<i class="material-icons mdc-theme--primary mr-1">cake</i>
  	  							It's Aleena's birthday!
  	  						</li>
  	  					</ul>
  	  				</div>
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
  	  						</li></a>
  	  					</ul>
  	  				</div>
  	  			</div>
  	  		</section>
  	  	</div>
  	</header>
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
    <form action="../../DBOperation.php?Message=<?php
                                                echo $_SESSION["user_name"];
                                                if(isset($_REQUEST["product_id"]))
                                                    echo '&log6=1' . '&product_id=' . $_REQUEST["product_id"];
                                                else echo '&log5=1';?>" method="post">
      <main class="content-wrapper">
        <div class="mdc-layout-grid">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              <div class="mdc-card">
                <section class="mdc-card__primary">
                  <h1 class="mdc-card__title mdc-card__title--large">Product details</h1>
                </section>
                <section class="mdc-card__supporting-text">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                          <div class="template-demo">
                            <div id="demo-tf-box-wrapper">
                                <div class="form-group">
        						  <label class="control-label col-sm-10" for="product_name" >Product Name:<span id="requ">&nbsp*</span></label>
        						  <div class="col-sm-10">
        							<input type="text" class="form-control" id="product_name"  placeholder="Enter product Name." name="product_name">
        						  </div>
        						</div>
                            </div>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                          <div class="template-demo">
                            <div id="demo-tf-box-leading-wrapper">
                                <div class="form-group">
        						  <label class="control-label col-sm-10" for="available_quantity" >Quantity:</label>
        						  <div class="col-sm-10">
        							<input type="text" class="form-control" id="available_quantity" placeholder="Quantity." name="available_quantity">
        						  </div>
        						</div>
                            </div>
                          </div>
                        </div>
						<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                          <div class="template-demo">
                            <div id="demo-tf-box-leading-wrapper">
                                <div class="form-group">
        						  <label class="control-label col-sm-10" for="hsn" >HSN No:</label>
        						  <div class="col-sm-10">
        							<input type="text" class="form-control" id="hsn" placeholder="HSN No." name="hsn">
        						  </div>
        						</div>
                            </div>
                          </div>
                        </div>
						<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                        </div>
						<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                          <div class="template-demo">
                            <div id="demo-tf-box-leading-wrapper">
                                <div class="form-group">
        						  <label class="control-label col-sm-10" for="rate" >Rate:</label>
        						  <div class="col-sm-10">
        							<input type="text" class="form-control" id="rate" placeholder="Rate." name="rate">
        						  </div>
        						</div>
                            </div>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                          <div class="template-demo">
                            <div id="demo-tf-box-leading-wrapper">
                                <div class="form-group">
        						  <label class="control-label col-sm-10" for="dealer_name" >Dealer name:</label>
        						  <div class="col-sm-10">
        							<input type="text" class="form-control" id="dealer_name" placeholder="Enter dealer name number." name="dealer_name">
        						  </div>
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
                              <div id="demo-tf-box-wrapper">
                                    <div class="mdc-list-item mdc-drawer-item purchase-link">
                                        <input type="submit" style="width: 100px;" onclick="return check();" value="save" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                    </div>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
             </div>
            </div>
            </div>
      </main>
    </form>
    <?php include("../../partials/_footer.php"); ?>
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
    function check(){
        var product_name=document.getElementById("product_name");
        var available_quantity=document.getElementById("available_quantity");
  	  	var rate=document.getElementById("rate");
		var hsn=document.getElementById("hsn");
        var dealer_name=document.getElementById("dealer_name");
        var regx = /^[a-zA-Z ]+$/;
        var numx = /^[0-9]+$/;
        var gstx = /^[a-zA-Z0-9 ]+$/;
  	  	var ratex = /^[0-9.]+$/;
        if (product_name.value == ""){
  		  document.getElementById('model_id').innerHTML="Product name must be required.";
  		  $('#exampleModal').modal({
  						  show : true
  					  });
  		  product_name.focus();
            return false;
        }
  	  else if (product_name.value.length > 30){
  		document.getElementById('model_id').innerHTML="Please enter product name of less than 30 characters.";
  		$('#exampleModal').modal({
  						show : true
  					});
  		product_name.focus();
          return false;
  	  }
        else if(gstx.test(product_name.value) == false){
  		  document.getElementById('model_id').innerHTML="Product name must be in letters only.";
  		  $('#exampleModal').modal({
  						  show : true
  					  });
  		  product_name.focus();
            return false;
        }
        if (available_quantity.value != ""){
            if(ratex.test(available_quantity.value) == false){
  			  document.getElementById('model_id').innerHTML="Quantity must be in numbers only.";
  	  		  $('#exampleModal').modal({
  	  			show : true
  	 		  });
    		      available_quantity.focus();
                return false;
            }
            if(available_quantity.value.length > 10){
  			  document.getElementById('model_id').innerHTML="Please enter valid quantity.";
    			$('#exampleModal').modal({
    							show : true
    						});
    			available_quantity.focus();
                return false;
            }
        }
  	  	if (rate.value != ""){
            if(ratex.test(rate.value) == false){
  			  document.getElementById('model_id').innerHTML="Rate must be in numbers only.";
    			$('#exampleModal').modal({
    							show : true
    						});
    			rate.focus();
                return false;
            }
            if(rate.value.length > 10){
  			  document.getElementById('model_id').innerHTML="Please enter valid rate.";
    			$('#exampleModal').modal({
    							show : true
    						});
    			rate.focus();
                return false;
            }
        }
		if (hsn.value != ""){
              if(numx.test(hsn.value) == false){
    			document.getElementById('model_id').innerHTML="HSN No. must be in numbers only.";
      			$('#exampleModal').modal({
      							show : true
      						});
      			hsn.focus();
                  return false;
              }
              if(hsn.value.length > 10){
    			  document.getElementById('model_id').innerHTML="Please enter valid HSN No.";
      			$('#exampleModal').modal({
      							show : true
      						});
      			hsn.focus();
                  return false;
              }
        }
        if (dealer_name.value != ""){
            if(regx.test(dealer_name.value) == false){
  			  document.getElementById('model_id').innerHTML="Dealer name must be in letters only.";
    			$('#exampleModal').modal({
    							show : true
    						});
    			dealer_name.focus();
                return false;
            }
            if(dealer_name.value.length > 30){
  			  document.getElementById('model_id').innerHTML="Please enter valid dealer name.";
    			$('#exampleModal').modal({
    							show : true
    						});
    			dealer_name.focus();
                return false;
            }
        }
        return true;
    }
    function onload_fun(){
        var product_name=document.getElementById("product_name");
        var available_quantity=document.getElementById("available_quantity");
  	  	var rate=document.getElementById("rate");
		var hsn=document.getElementById("hsn");
        var dealer_name=document.getElementById("dealer_name");
          <?php if(isset($row)){ ?>
              	product_name.value = "<?php echo $row['product_name']; ?>";
              	available_quantity.value = "<?php echo $row['available_quantity']; ?>";
  				rate.value = "<?php echo $row['rate']; ?>";
				hsn.value = "<?php echo $row['hsn_no']; ?>";
              	dealer_name.value = "<?php echo $row['dealer_name']; ?>";
          <?php } ?>
    }
    </script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
    <script src="../../js/material.js"></script>
    <script src="../../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
</body>
</html>
