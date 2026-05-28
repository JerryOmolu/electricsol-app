<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

<?php
/* =========================================================
   ULTRA-FAST PDO NOTIFICATION SYSTEM
   - Fully PDO optimized
   - Reduced SQL load
   - Faster execution
   - Lower memory usage
========================================================= */

try {

    /* =========================================================
       LOW STOCK PRODUCTS
    ========================================================= */
    $lowStockSQL = "
        SELECT 
            product_name,
            product_number,
            stock_level
        FROM product
        WHERE stock_level <= :stock_level
        ORDER BY stock_level ASC
        LIMIT 10
    ";

    $lowStockStmt = $pdo->prepare($lowStockSQL);
    $lowStockStmt->bindValue(':stock_level', 5, PDO::PARAM_INT);
    $lowStockStmt->execute();

    $lowStockProducts = $lowStockStmt->fetchAll(PDO::FETCH_ASSOC);

    /* =========================================================
       UNHANDLED DISCO REQUESTS
    ========================================================= */
    $discoSQL = "
        SELECT COUNT(*) 
        FROM disco 
        WHERE status = :status
    ";

    $discoStmt = $pdo->prepare($discoSQL);
    $discoStmt->bindValue(':status', 'Unhandled', PDO::PARAM_STR);
    $discoStmt->execute();

    $number_of_disco = (int)$discoStmt->fetchColumn();

    /* =========================================================
       TODAY REGISTERED USERS
    ========================================================= */
    $today = date('Y-m-d');

    $userSQL = "
        SELECT COUNT(*)
        FROM register
        WHERE DATE(date) = :today
    ";

    $userStmt = $pdo->prepare($userSQL);
    $userStmt->bindValue(':today', $today, PDO::PARAM_STR);
    $userStmt->execute();

    $number_of_user = (int)$userStmt->fetchColumn();

} catch (PDOException $e) {

    $lowStockProducts = [];
    $number_of_disco = 0;
    $number_of_user = 0;
}
?>

      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="home.php">
            <img src="img/electrisol-img/Logo%206.png" class="mr-2" alt="logo"/>
        </a>

        <a class="navbar-brand brand-logo-mini" href="home.php">
            <img src="img/electrisol-img/Icon%206.png" alt="logo"/>
        </a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

          <!-- NOTIFICATION DROPDOWN -->
          <li class="nav-item dropdown">

            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>

              <?php if (!empty($lowStockProducts) || $number_of_disco > 0 || $number_of_user > 0): ?>
                  <span class="count"></span>
              <?php endif; ?>
            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">

              <p class="mb-0 font-weight-normal float-left dropdown-header">
                  Notifications
              </p>

              <!-- LOW STOCK PRODUCTS -->
              <a class="dropdown-item preview-item">

                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>

                <div class="preview-item-content">

                  <h6 class="preview-subject font-weight-normal">
                      Item(s) to Restock
                  </h6>

                  <?php if (!empty($lowStockProducts)): ?>

                      <?php foreach ($lowStockProducts as $product): ?>

                          <p class="font-weight-light small-text mb-0 text-muted">
                              <?= htmlspecialchars($product['product_name']) ?>
                              -(<?= htmlspecialchars($product['product_number']) ?>)
                          </p>

                          <p class="font-weight-light small-text mb-0 text-muted">
                              Stock Level - <?= (int)$product['stock_level'] ?>
                          </p>

                          <hr>

                      <?php endforeach; ?>

                  <?php else: ?>

                      <p class="font-weight-light small-text mb-0 text-muted">
                          No low stock items found.
                      </p>

                  <?php endif; ?>

                </div>
              </a>

              <!-- DISCO REQUESTS -->
              <a class="dropdown-item preview-item">

                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>

                <div class="preview-item-content">

                  <h6 class="preview-subject font-weight-normal">
                      Contact Disco
                  </h6>

                  <?php if ($number_of_disco > 0): ?>

                      <p class="font-weight-light small-text mb-0 text-muted">
                          You have <?= $number_of_disco ?> Unhandled requests.
                          <br>Please Check
                      </p>

                  <?php else: ?>

                      <p class="font-weight-light small-text mb-0 text-muted">
                          No pending requests.
                      </p>

                  <?php endif; ?>

                </div>
              </a>

              <!-- NEW USERS -->
              <a class="dropdown-item preview-item">

                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>

                <div class="preview-item-content">

                  <h6 class="preview-subject font-weight-normal">
                      New user registration
                  </h6>

                  <p class="font-weight-light small-text mb-0 text-muted">
                      You have <?= $number_of_user ?> Users registered today.
                  </p>

                </div>
              </a>

            </div>
          </li>

          <!-- PROFILE -->
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