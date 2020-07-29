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
	<style>
		th, td{
			text-align: left; vertical-align: inherit; font-size: 15px;
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
					<h1 class="mdc-card__title mdc-card__title--large">Selected  Product :</h1>
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
                                <div class="container" >
                                    <table id="example" class="ui celled table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Id.</th>
                                                <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Product Id.</th>
                		                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Name.</th>
        				                        <th style="text-align: center; vertical-align: inherit; font-size: 15px;">Quantity.</th>
												<th style="text-align: center; vertical-align: inherit; font-size: 15px;">TAKA No.</th>
												<th style="text-align: center; vertical-align: inherit; font-size: 15px;">Rate.</th>
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
              <section class="mdc-card__supporting-text">
                  <div class="mdc-layout-grid__inner">
                      <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                        <div class="template-demo">
                          <div id="demo-tf-box-wrapper">
                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                    <a id="anchor_id">
                                    	<input type="button" style="width: 100px;" value="next" id="next_button" disabled class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                    </a>
                                </div>
                          </div>
                      </div>
                      </div>
					  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                        <div class="template-demo">
                          <div id="demo-tf-box-wrapper">
                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                    <a href="product-list.php">
                                    	<input type="button" style="width: 100px;" value="empty cart" onclick="empty_cart();" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
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
	function empty_cart() {
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', log16: 1},
			success:function(html) {
				if(html!=""){
					document.getElementById('model_id').innerHTML="Unable to clear.";
					$('#exampleModal').modal({show : true});
				}
			}
		});
	}
		function save_onclick(obj){
			var trObj = obj.parentNode.parentNode.parentNode.parentNode;
			var rate = trObj.children[5].children[0];
			var taka_no = trObj.children[4].children[0];
			var numx = /^[0-9.]+$/;
			if (rate.value != "" && rate.value != "0"){
		        if(numx.test(rate.value) == false){
					document.getElementById('model_id').innerHTML="rate must be in numbers only.";
					$('#exampleModal').modal({ show : true });
					rate.focus();
		        }
			    else if(numx.test(taka_no.value) == false && taka_no.value != ""){
					document.getElementById('model_id').innerHTML="Taka NO. must be in numbers only.";
					$('#exampleModal').modal({ show : true });
					taka_no.focus();
		        }
				else{
				    $.ajax({
						type: "POST",
						url: '../../DBOperation.php',
						data:{Message:'<?php echo $_SESSION["user_name"];?>', id: parseInt(trObj.children[0].innerHTML), rate: rate.value, taka_no: taka_no.value, log10: 1},
					  	success:function(html) {
                            if(html==0){
								document.getElementById('model_id').innerHTML="Unable to save.";
					    		$('#exampleModal').modal({show : true});
							}
							else{
                                trObj.children[5].innerHTML = rate.value;
								rate.remove();
								trObj.children[4].innerHTML = taka_no.value;
								taka_no.remove();
                            }
						}
					});
				}
            }
			else{
				document.getElementById('model_id').innerHTML="Please enter rate.";
				$('#exampleModal').modal({ show : true });
				rate.focus();
			}
	    }
        function delete_onclick(obj){
            var trObj = obj.parentNode.parentNode.parentNode.parentNode;
            $.ajax({
                type: "POST",
                url: '../../DBOperation.php',
                data:{Message:'<?php echo $_SESSION["user_name"];?>', id: parseInt(trObj.children[0].innerHTML), log11: 1},
                success:function(html) {
                    if(html==0){
					    document.getElementById('model_id').innerHTML="Unable to delete.";
						$('#exampleModal').modal({ show : true });
				   }
               }
           });
	   		$.ajax({
	   			type: "POST",
	   			url: '../../DBOperation.php',
	   			data:{Message:'<?php echo $_SESSION["user_name"];?>', log19: 1},
	   			success:function(html) {
	   				if(html=='0'){
	   					$('#example').dataTable().fnClearTable();
						document.getElementById('span_quantity').innerHTML = 0;
	   				}
					else if(html=='00'){
	   					$('#example').dataTable().fnClearTable();
						document.getElementById('span_quantity').innerHTML = 0;
	   				}
	   				else {
						document.getElementById('span_quantity').innerHTML = html;
	   					$('#example').DataTable().ajax.url( '../../json/json_file.json' ).load();
	   				}
	   			}
	   		});
      }
        function edit_onclick(obj){
            var trObj = obj.parentNode.parentNode.parentNode.parentNode;
            var rate = trObj.children[5].innerHTML;
			var taka_no = trObj.children[4].innerHTML;
            var numx = /^[0-9.]+$/;
            if(numx.test(rate)){
                trObj.children[5].innerHTML = "";
                var text = document.createElement("INPUT");
                text.type = "text";
                text.value = rate;
                text.className = "form-control";
                text.setAttribute("name", "rate");
                text.setAttribute("id", "rate");
                text.setAttribute("placeholder", "Rate");
                text.setAttribute("style", "width:60px");
                trObj.children[5].appendChild(text);

				trObj.children[4].innerHTML = "";
                var text = document.createElement("INPUT");
                text.type = "text";
                text.value = taka_no;
                text.className = "form-control";
                text.setAttribute("name", "taka_no");
                text.setAttribute("id", "taka_no");
                text.setAttribute("placeholder", "TAKA No");
                text.setAttribute("style", "width:60px");
                trObj.children[4].appendChild(text);
            }
        }
	</script>
	<script>
	function onload_fun() {
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', log15: 1},
			success:function(html) {
				if(html==""){
					$('#next_button').attr("disabled", false);
					$('#anchor_id').attr("href", "cust-list.php");
				}
			}
		});
		$.ajax({
			type: "POST",
			url: '../../DBOperation.php',
			data:{Message:'<?php echo $_SESSION["user_name"];?>', log19: 1},
			success:function(html) {
				if(html=='0'){
					$('#example').dataTable().fnClearTable();
					document.getElementById('span_quantity').innerHTML = 0;
				}
				else if(html=='00'){
					$('#example').dataTable().fnClearTable();
					document.getElementById('span_quantity').innerHTML = 0;
				}
				else {
					document.getElementById('span_quantity').innerHTML = html;
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
					  {     "data"     :     "id"     },
					  {     "data"     :     "product_id"},
					  {     "data"     :     "product_name"},
					  {     "data"     :     "quantity"     },
					  {     "data"     :     "taka_no"},
					  {     "data"     :     "rate"     },
					  {     "data"     :     "data"}
				 ]
			});
			$('tr').hover(function(){
				$(this).css("background-color", "#EEEEEE");;
            },function () {
				$(this).css("background-color", "white");;
            });
        });
    </script>
    <script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../js/misc.js"></script>
	<script src="../../js/dialog.js"></script>
    <script src="../../js/material.js"></script>
</body>
</html>
