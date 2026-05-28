<?php include "includes/home_header.php"; ?>

<?php
// =========================
// SAFE SESSION VALUE
// =========================
$fullname = $_SESSION['fullname'] ?? null;

$cart_items = [];
$total = 0;

// =========================
// ONLY RUN QUERY IF USER EXISTS
// =========================
if ($fullname) {

    $stmt = $pdo->prepare("
        SELECT 
            product_name,
            price,
            quantity,
            amount
        FROM cart 
        WHERE customer_name = :customer_name 
        AND payment_status = 'Pending'
    ");

    $stmt->execute([
        ':customer_name' => $fullname
    ]);

    // Fetch all at once (buffered, faster rendering)
    $cart_items = $stmt->fetchAll();

    foreach ($cart_items as $item) {
        $total += (float)$item['amount'];
    }
}
?>

<!-- Preloader -->
<div id="preloader">
  <div class="spinner-grow text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Dark mode switching -->
<div class="dark-mode-switching">
  <div class="d-flex w-100 h-100 align-items-center justify-content-center">
    <div class="dark-mode-text text-center">
      <i class="bi bi-moon"></i>
      <p class="mb-0">Switching to dark mode</p>
    </div>
    <div class="light-mode-text text-center">
      <i class="bi bi-brightness-high"></i>
      <p class="mb-0">Switching to light mode</p>
    </div>
  </div>
</div>

<!-- RTL mode switching -->
<div class="rtl-mode-switching">
  <div class="d-flex w-100 h-100 align-items-center justify-content-center">
    <div class="rtl-mode-text text-center">
      <i class="bi bi-text-right"></i>
      <p class="mb-0">Switching to RTL mode</p>
    </div>
    <div class="ltr-mode-text text-center">
      <i class="bi bi-text-left"></i>
      <p class="mb-0">Switching to default mode</p>
    </div>
  </div>
</div>

<!-- Header -->
<div class="header-area" id="headerArea">
  <div class="container">
    <div class="header-content position-relative d-flex align-items-center justify-content-between">

      <div class="back-button">
        <a href="shop.php">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <div class="page-heading">
        <h6 class="mb-0">Invoice</h6>
      </div>

      <div class="setting-wrapper">
        <div class="setting-trigger-btn" id="settingTriggerBtn">
          <i class="bi bi-gear"></i>
          <span></span>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="page-content-wrapper py-3">
  <div class="container">
    <div class="card invoice-card shadow">
      <div class="card-body">

        <!-- Invoice Info -->
        <div class="invoice-info text-end mb-4">
          <h5 class="mb-1 fz-14">
            <img src="img/electrisol-img/Logo%206.png" width="100px">
          </h5>

          <p><em>Innovating Energy for Africa...</em></p>
          <hr><br>

          <h5 class="mb-1 fz-14">
            Customer Name: <?= htmlspecialchars($fullname ?? '') ?>
          </h5>

          <h6 class="fz-12">
            Invoice No. #<?= rand(1000000, 9999999) ?>
          </h6>

          <p class="mb-0 fz-12">
            <b>Date:</b> <?= date("l, F j, Y") ?>
          </p>
        </div>

        <!-- Invoice Table -->
        <div class="invoice-table">
          <div class="table-responsive">
            <table class="table table-bordered caption-top">

              <caption>Product List</caption>

              <thead class="table-light">
                <tr>
                  <th>Description</th>
                  <th>Unit</th>
                  <th>Q.</th>
                  <th>Total</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($cart_items as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td>&#8358;<?= number_format($row['price'], 2) ?></td>
                    <td><?= (int)$row['quantity'] ?></td>
                    <td>&#8358;<?= number_format($row['amount'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

              <tfoot class="table-light">
                <tr>
                  <td class="text-end" colspan="3">Total:</td>
                  <td class="text-end">&#8358;<?= number_format($total, 2) ?></td>
                </tr>

                <tr>
                  <td class="text-end" colspan="3">VAT (7.5%):</td>
                  <td class="text-end">Included in Total</td>
                </tr>

                <tr>
                  <td class="text-end" colspan="3">Grand Total:</td>
                  <td class="text-end">&#8358;<?= number_format($total, 2) ?></td>
                </tr>
              </tfoot>

            </table>
          </div>
        </div>

        <p class="mb-0">Notice: This is auto generated invoice.</p>

      </div>
    </div>
  </div>
</div>

<?php include "includes/home_footer_nav.php"; ?>