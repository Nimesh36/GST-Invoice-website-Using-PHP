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
    if(isset($_SESSION["user_name"])) {
        include ("../../DBconfig.php");
        $user_name = $_SESSION["user_name"];
        $sql = "SELECT * FROM user_detail where username = '$user_name';";
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
  <link href="../../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../lib/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" href="../../css/login_form.css">
  <link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
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
      <main class="content-wrapper">
        <div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <div class="mdc-card">
                              <section class="mdc-card__supporting-text">
                                  <div class="mdc-layout-grid__inner">
                                      <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                                          <div id="demo-tf-box-wrapper">
                                                <a href="mod-product.php" style = "text-decoration:none; color:black;">
                                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                                    <input type="submit" style="width: 100px;" value="add new" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                                </div>
                                                </a>
                                          </div>
                                      </div>
                                  </div>
                              </section>
                          </div>
                         </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
							<div class="mdc-card">
								<section class="mdc-card__primary">
									<h1 class="mdc-card__title mdc-card__title--large">Products</h1>
								</section>
                <div class="template-demo">
                  <table class="table table-hoverable">
                    <thead>
                      <tr>
                        <th>Id.</th>
                        <th>Name.</th>
						<th>Quantity.</th>
                        <th>HSN No.</th>
						<th>Rate.</th>
                        <th>Dealer name.</th>
                        <th></th>
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
                            if (mysqli_num_rows($result) > 0)
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>" .
                                        " <td>$row[product_id]</td>" .
                                        " <td>$row[product_name]</td>" .
                                        " <td>$row[available_quantity]</td>" .
										" <td>$row[hsn_no]</td>" .
										" <td>$row[rate]</td>" .
                                        " <td>$row[dealer_name]</td>"?>
                                        <td style="text-align: right;">
                                            <a href="mod-product.php?product_id=<?php echo $row['product_id']?>">
                                            <button class="mdc-fab mdc-fab--mini material-icons">
                                                    <i class="material-icons">create</i>
                                                </button>
                                                </a>
                                        </td>
                                        <td style="text-align: left;">
                                            <a href="../../DBOperation.php?Message=<?php echo $_SESSION["user_name"];?>&product_id=<?php echo $row['product_id']?>&log7=1">
                                            <button class="mdc-fab mdc-fab--mini material-icons" data-mdc-auto-init="MDCRipple">
                                                <i class="material-icons">delete_sweep</i>
                                            </button>
                                            </a>
                                        </td>
                                        <?php
                                        echo "</tr>";
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
      </main>
    <?php include("../../partials/_footer.php"); ?>
    </div>
    </div>
	<script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
  	<script src="../../js/misc.js"></script>
  	<script src="../../js/material.js"></script>
</body>
</html>
