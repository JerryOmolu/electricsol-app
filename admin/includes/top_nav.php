<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="home.php"><img src="img/electrisol-img/Logo%206.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="home.php"><img src="img/electrisol-img/Icon%206.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
          
        
        
        <ul class="navbar-nav navbar-nav-right">
            
    <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Item(s) to Restock</h6>
                     <?php  
                     $query = "SELECT * FROM product WHERE stock_level <= 5";
                $view_products = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_products)){
                    $product_id = escape($row['product_id']);
                    $product_name = escape($row['product_name']);
                    $product_details = escape($row['product_details']);
                    $product_number = escape($row['product_number']);
                    $category = escape($row['category']);
                    $price = escape($row['price']);
                    $keywords = escape($row['keywords']);
                    $image_one = escape($row['image_one']);
                    $image_two = escape($row['image_two']);
                    $image_three = escape($row['image_three']);
                    $stock_level = escape($row['stock_level']);
                    $added_on = escape($row['added_on']);
                    $added_by = escape($row['added_by']);
                    
                    echo "<p class='font-weight-light small-text mb-0 text-muted'>
                   {$product_name}-({$product_number})
                  </p>";
                    echo "<p class='font-weight-light small-text mb-0 text-muted'>
                   Stock Level - {$stock_level}
                  </p>";
                    echo "<hr>";

                    }  

                    ?>
                </div>
              </a>
                
            <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Contact Disco</h6>
                <?php 
                $query = "SELECT * FROM disco WHERE status = 'Unhandled'";
                $view_disco = mysqli_query($connection, $query);
                $number_of_disco = mysqli_num_rows($view_disco);
          if ($number_of_disco > 0 ){
              echo "<p class='font-weight-light small-text mb-0 text-muted'>
                   You have {$number_of_disco} Unhandled requests. <br>Please Check
                  </p>";
          }
                    
                ?>    
                </div>
              </a>
                
<!--
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
-->
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <?php 
                $today = date("Y-m-d");
                $query = "SELECT * FROM register WHERE date = $today";
                $view_user = mysqli_query($connection, $query);
                $number_of_user = mysqli_num_rows($view_user);
         echo "<p class='font-weight-light small-text mb-0 text-muted'>
                   You have $number_of_user Users registered today.
                 </p>";
                    
                ?>
                </div>
              </a>
            </div>
          </li>        
            
            
            
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="img/electrisol-img/profile.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="profile">
                <i class="ti-user text-primary"></i>
                Profile
              </a>  
            <a class="dropdown-item" href="password_change">
                <i class="ti-key text-primary"></i>
                Change Password
              </a>
              <a class="dropdown-item" href="logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>