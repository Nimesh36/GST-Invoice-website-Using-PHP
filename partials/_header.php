<header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
  <div class="mdc-toolbar__row">
    <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
      <a class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
    </section>
    <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
      <div class="mdc-menu-anchor">
          <a href="pages/forms/selected-product-list.php" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
            <i class="material-icons">shopping_cart</i>
              <span class="dropdown-count" id="span_quantity">
              <?php
              include ("DBconfig.php");
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
                <a href="logout.php" style = "text-decoration:none; color:black;">
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
